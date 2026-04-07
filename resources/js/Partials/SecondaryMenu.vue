<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link, usePage } from "@inertiajs/vue3";

const page = usePage();
const primaryMenus = page.props.menu?.secondaryMenu || [];
</script>

<template>
    <div class="sticky top-0 z-50 bg-orange-500 dark:bg-neutral-800 dark:border-b dark:border-neutral-700">
        <div class="flex items-center px-4 sm:px-6 lg:px-16 py-1">
            <!-- LEFT: Logo -->
            <div>
                <ApplicationLogo />
            </div>

            <!-- CENTER: Search -->
            <div class="flex-1 flex justify-center">
                <div class="relative w-full max-w-md">
                    <svg
                        class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                    >
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.3-4.3" />
                    </svg>

                    <input
                        type="text"
                        placeholder="Search products ..."
                        class="w-full rounded-lg py-2.5 pl-10 pr-4 text-tiny border dark:bg-neutral-700 dark:text-neutral-300 border-orange-500 dark:border-neutral-800 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:focus:ring-neutral-800 focus:border-transparent"
                    />
                </div>
            </div>

            <!-- RIGHT: Navigation -->
            <nav class="flex items-center gap-2">
                <template v-for="(menu, index) in primaryMenus" :key="index">
                    <Link
                        v-if="menu && menu.menu_type === 'link'"
                        :href="menu.route"
                        class="px-2 py-2 rounded-md text-tiny text-white hover:text-black hover:bg-white dark:hover:text-neutral-200 dark:text-neutral-300 dark:hover:bg-neutral-700 transition"
                    >
                        {{ menu.name }}
                    </Link>
                </template>
            </nav>
        </div>
    </div>
</template>
