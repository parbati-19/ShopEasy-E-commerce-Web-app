<script setup>
import Footer from '@/Partials/Footer.vue';
import Header from '@/Partials/Header.vue';


</script>

<template>
    <div class="min-h-screen dark:bg-neutral-800 dark:text-neutral-200">
        <Header />
        <main>
            <slot />
        </main>
        <Footer />
    </div>
</template>
