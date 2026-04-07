<script setup>
import { Link, usePage } from '@inertiajs/vue3';
const page = usePage();
const primaryMenus = page.props.menu?.primaryMenu || [];
</script>

<template>
    <div class="px-4 sm:px-6 lg:px-16 py-2">
        <nav class="flex items-center gap-4">
            <template v-for="(menu, index) in primaryMenus" :key="index">
                <Link
                    v-if="menu && menu.menu_type === 'link'"
                    :href="menu.route"
                    class="px-2 py-2 rounded-md text-tiny text-gray-700 hover:bg-gray-100"
                >
                    {{ menu.name }}
                </Link>

            </template>
        </nav>
    </div>

</template>
