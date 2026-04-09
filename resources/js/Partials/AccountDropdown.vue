<script setup>
import Avatar from "@/Components/Avatar.vue";
import Switch from "@/Components/Switch.vue";
import { nextTick, onBeforeUnmount, onMounted, ref, watch } from "vue";

const props = defineProps({
    authUser: {
        type: Object,
        required: true,
    },
    app: {
        type: Object,
        required: true,
    },
});

const isOpen = ref(false);
const activeIndex = ref(-1);
const menuItems = ref([]);

function toggle() {
    isOpen.value = !isOpen.value;
}

function close() {
    isOpen.value = false;
}

function handleClickOutside(e) {
    if (
        !e.target.closest("#user-menu") &&
        !e.target.closest(".origin-top-right")
    ) {
        close();
    }
}

onMounted(() => {
    document.addEventListener("click", handleClickOutside);
});

onBeforeUnmount(() => {
    document.removeEventListener("click", handleClickOutside);
});

function handleEscapeKey(e) {
    if (e.key === "Escape") {
        close();
    }
    handleKeyNavigation(e);
}

watch(isOpen, (open) => {
    if (open) {
        document.addEventListener("keydown", handleEscapeKey);
    } else {
        document.removeEventListener("keydown", handleEscapeKey);
    }
});

function setItemref(el) {
    if (el && !menuItems.value.includes(el)) {
        menuItems.value.push(el);
        el.dataset.index = menuItems.value.length - 1;
    }
}

function handleKeyNavigation(e) {
    if (!isOpen.value || !menuItems.value.length) return;

    if (e.key === "ArrowDown") {
        e.preventDefault();
        activeIndex.value = (activeIndex.value + 1) % menuItems.value.length;
        focusItem();
    }

    if (e.key === "ArrowUp") {
        e.preventDefault();
        activeIndex.value =
            (activeIndex.value - 1 + menuItems.value.length) %
            menuItems.value.length;
        focusItem();
    }

    if (e.key === "Enter") {
        e.preventDefault();
        menuItems.value[activeIndex.value]?.click();
    }
}

function focusItem() {
    const el = menuItems.value[activeIndex.value];
    el?.focus();
}

watch(isOpen, async (val) => {
    if (val) {
        menuItems.value = [];
        activeIndex.value = -1;

        await nextTick(); // wait for DOM

        if (menuItems.value.length > 0) {
            activeIndex.value = 0;
            menuItems.value[0].focus();
        }
    }
});
</script>

<template>
    <div class="relative">
        <button
            class="flex items-center text-sm focus:outline-none"
            id="user-menu"
            aria-haspopup="true"
            type="button"
            @click="toggle()"
        >
            <Avatar :name="props.authUser.name" :size="'30'" />
        </button>

        <div
            v-if="isOpen"
            class="origin-top-right absolute right-0 mt-2 w-52 rounded-xl shadow-lg bg-white dark:bg-neutral-900 ring-1 ring-black/5"
        >
            <div class="py-1">
                <!-- User Info -->
                <div class="a border-b border-gray-200 dark:border-neutral-800">
                    <a
                        ref="setItemref"
                        tabindex="0"
                        href="#"
                        class="flex items-center gap-3 px-4 py-2 mx-1 mt-0 my-1 rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-800 transition-colors"
                        :class="{
                            'bg-gray-100 dark:bg-neutral-800':
                                Number($el?.dataset?.index) === activeIndex,
                        }"
                    >
                        <Avatar :name="props.authUser.name" :size="30" />
                        <div class="flex flex-col leading-tight">
                            <span
                                class="text-tiny font-medium text-gray-800 dark:text-neutral-200"
                            >
                                {{ props.authUser.name }}
                            </span>
                            <span
                                class="text-xs text-gray-500 dark:text-neutral-400 uppercase"
                            >
                                {{ props.app }}
                            </span>
                        </div>
                    </a>
                </div>

                <!-- My Account -->
                <a
                    ref="setItemref"
                    tabindex="0"
                    href="#"
                    class="b flex items-center gap-3 px-4 py-2 mx-1 my-1 text-tiny text-gray-700 dark:text-neutral-200 rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-800 transition-colors"
                    :class="{
                        'bg-gray-100 dark:bg-neutral-800':
                            Number($el?.dataset?.index) === activeIndex,
                    }"
                >
                    <svg
                        class="w-4 h-4 shrink-0"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"
                        />
                    </svg>
                    My account
                </a>

                <!-- Settings -->
                <a
                    ref="setItemref"
                    tabindex="0"
                    href="#"
                    class="c flex items-center gap-3 px-4 py-2 mx-1 my-1 text-tiny text-gray-700 dark:text-neutral-200 rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-800 transition-colors"
                    :class="{
                        'bg-gray-100 dark:bg-neutral-800':
                            Number($el?.dataset?.index) === activeIndex,
                    }"
                >
                    <svg
                        class="w-4 h-4 shrink-0"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.764-.384.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                        />
                    </svg>
                    Settings
                </a>

                <!-- Dark Mode -->
                <div
                    class="dflex items-center justify-between px-4 py-2 mx-1 my-0.5 border-t border-b border-gray-200 dark:border-neutral-800"
                >
                    <Switch :label="'Dark mode'" />
                </div>

                <!-- Sign Out -->
                <a
                    ref="setItemref"
                    tabindex="0"
                    href="#"
                    class="e flex items-center gap-3 px-4 py-2 mx-1 mb-0 my-1 text-tiny text-gray-700 dark:text-neutral-200 rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-800 transition-colors"
                    :class="{
                        'bg-gray-100 dark:bg-neutral-800':
                            Number($el?.dataset?.index) === activeIndex,
                    }"
                >
                    <svg
                        class="w-4 h-4 shrink-0"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15"
                        />
                    </svg>
                    Sign out
                </a>
            </div>
        </div>
    </div>
</template>
