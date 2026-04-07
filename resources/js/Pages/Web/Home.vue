<script setup>
import BaseTheme from '@/Layouts/Web/BaseTheme.vue';
import { Head, Link } from '@inertiajs/vue3'

const props = defineProps({
    featuredProducts: Array,
    categories: Array,
})
</script>

<template>
    <Head title="Home - ShopEasy" />

    <BaseTheme>
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="text-center">
                    <h1 class="text-5xl font-bold mb-6">
                        Welcome to ShopEasy
                    </h1>
                    <p class="text-xl mb-8 text-indigo-100">
                        Discover amazing products at unbeatable prices
                    </p>
                    <Link
                        :href="route('shop')"
                        class="inline-block bg-white text-indigo-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-100 transition"
                    >
                        Start Shopping
                    </Link>
                </div>
            </div>
        </div>

        <!-- Categories Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h2 class="text-3xl font-bold mb-8">Shop by Category</h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <Link
                    v-for="category in categories"
                    :key="category.id"
                    :href="route('category', category.slug)"
                    class="group"
                >
                    <div class="bg-gray-100 rounded-lg p-8 text-center hover:bg-indigo-50 transition">
                        <div class="text-4xl mb-4">📦</div>
                        <h3 class="font-semibold text-lg group-hover:text-indigo-600">
                            {{ category.name }}
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">
                            {{ category.products_count }} products
                        </p>
                    </div>
                </Link>
            </div>
        </div>

        <!-- Featured Products Section -->
        <div class="bg-gray-50 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold">Featured Products</h2>
                    <Link
                        :href="route('shop')"
                        class="text-indigo-600 hover:text-indigo-800 font-semibold"
                    >
                        View All →
                    </Link>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <Link
                        v-for="product in featuredProducts"
                        :key="product.id"
                        :href="route('product.show', product.slug)"
                        class="group bg-white border rounded-lg overflow-hidden hover:shadow-xl transition"
                    >
                        <!-- Product Image -->
                        <div class="aspect-square bg-gray-100 relative overflow-hidden">
                            <img
                                v-if="product.images[0]"
                                :src="product.images[0].image"
                                :alt="product.name"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-300"
                            />
                            <div v-else class="w-full h-full flex items-center justify-center text-gray-400">
                                <span class="text-6xl">📷</span>
                            </div>

                            <!-- Discount Badge -->
                            <span
                                v-if="product.discount_percent > 0"
                                class="absolute top-3 right-3 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold"
                            >
                                -{{ product.discount_percent }}%
                            </span>

                            <!-- Featured Badge -->
                            <span
                                class="absolute top-3 left-3 bg-indigo-600 text-white px-3 py-1 rounded-full text-xs font-bold"
                            >
                                FEATURED
                            </span>
                        </div>

                        <!-- Product Info -->
                        <div class="p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">
                                {{ product.category.name }}
                            </p>
                            <h3 class="font-semibold text-lg mb-2 group-hover:text-indigo-600 transition line-clamp-2">
                                {{ product.name }}
                            </h3>

                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-2xl font-bold text-indigo-600">
                                    ${{ product.price }}
                                </span>
                                <span
                                    v-if="product.compare_price"
                                    class="text-sm text-gray-400 line-through"
                                >
                                    ${{ product.compare_price }}
                                </span>
                            </div>

                            <!-- Stock Status -->
                            <div class="flex items-center justify-between">
                                <span
                                    v-if="product.stock > 0"
                                    class="text-xs text-green-600 font-semibold"
                                >
                                    ✓ In Stock ({{ product.stock }})
                                </span>
                                <span
                                    v-else
                                    class="text-xs text-red-600 font-semibold"
                                >
                                    Out of Stock
                                </span>
                            </div>
                        </div>
                    </Link>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="text-5xl mb-4">🚚</div>
                    <h3 class="font-semibold text-xl mb-2">Free Shipping</h3>
                    <p class="text-gray-600">On orders over $100</p>
                </div>
                <div class="text-center">
                    <div class="text-5xl mb-4">🔒</div>
                    <h3 class="font-semibold text-xl mb-2">Secure Payment</h3>
                    <p class="text-gray-600">100% secure transactions</p>
                </div>
                <div class="text-center">
                    <div class="text-5xl mb-4">↩️</div>
                    <h3 class="font-semibold text-xl mb-2">Easy Returns</h3>
                    <p class="text-gray-600">30-day return policy</p>
                </div>
            </div>
        </div>
    </BaseTheme>
</template>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
