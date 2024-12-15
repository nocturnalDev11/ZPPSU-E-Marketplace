<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '../Layouts/GuestLayout.vue';

function asset(path) {
    return `${import.meta.env.BASE_URL}${path}`;
}

const props = defineProps({
    products: {
        type: Array,
        default: () => [],
    },
    services: {
        type: Array,
        default: () => [],
    },
    trades: {
        type: Array,
        default: () => [],
    },
    posts: {
        type: Array,
        default: () => [],
    }
});
</script>

<template>

    <Head title="LandingPage" />
    <GuestLayout>
        <div class="container px-4 md:px-10 mx-auto w-full h-screen py-44">
            <div class="flex flex-col justify-center mx-auto sm:py-12 lg:py-24 lg:flex-row lg:justify-between">
                <div
                    class="flex flex-col justify-center p-6 text-center rounded-sm lg:max-w-md xl:max-w-lg lg:text-left dark:text-gray-300">
                    <h1 class="text-5xl font-bold leading-none sm:text-6xl">ZPPSU<br>
                        <span class="light:text-violet-600">E-Marketplace</span>
                    </h1>
                    <p class="mt-6 mb-8 text-lg sm:mb-12">Empowering Innovation and Entrepreneurship at ZPPSU:
                        <br class="hidden md:inline lg:hidden">Discover the ZPPSU E-Marketplace - Your Hub for Student
                        Creativity and Marketable Solutions.
                    </p>
                </div>
                <div class="flex items-center justify-center p-6 mt-8 lg:mt-0 h-65 sm:h-80 lg:h-96 xl:h-112 2xl:h-128">
                    <img :src="asset('storage/images/front-page.svg')" alt="image">
                </div>
            </div>
        </div>

        <div class="container px-4 w-full mx-auto md:h-auto pt-32">
            <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
                <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Products</h2>
                <p class="mt-1 text-gray-600 dark:text-neutral-400">
                    Browse through a variety of products available for sale within the
                    university community.
                </p>
            </div>
            <div class="grid h-full grid-cols-3 gap-4 xl:grid-cols-5">
                <template v-if="products.length > 0">
                    <div v-for="product in products" :key="product.id" class="mb-6 w-full select-none">
                        <div class="relative pb-64">
                            <div class="cursor-pointer">
                                <img class="absolute h-full w-full cursor-pointer rounded-lg border-b object-cover shadow-md"
                                    :src="product.prod_picture || 'default-image-url'" alt="product name" />
                            </div>
                        </div>

                        <div class="relative -mt-16 px-4">
                            <div
                                class="rounded-lg border dark:border-none bg-white dark:bg-gray-800 shadow-lg shadow-gray-200 dark:shadow-none">
                                <div class="p-5">
                                    <div class="flex items-center justify-between">
                                        <div class="text-xs opacity-75">
                                            <a class="hover:underline dark:text-gray-200" href="#">{{
                                                product.prod_category }}</a>
                                        </div>

                                        <span
                                            class="select-none rounded-full bg-teal-100 text-green-500 dark:bg-teal-200 dark:text-green-700 px-3 py-1 text-xs">
                                            {{ product.prod_status }}
                                        </span>
                                    </div>

                                    <a class="mt-2 block truncate text-lg font-medium text-gray-800 dark:text-gray-100 hover:underline"
                                        href="#">
                                        {{ product.prod_name }}
                                    </a>
                                </div>

                                <div class="flex items-center justify-between px-4 pb-3">
                                    <div>
                                        <div class="text-lg">
                                            <span class="font-medium text-gray-800 dark:text-gray-100">₱{{
                                                product.prod_price }}</span>
                                        </div>
                                    </div>

                                    <div>
                                        <Link :href="route('products.show', product.id)"
                                            class="btn-link flex items-center text-xs text-indigo-600 dark:text-indigo-300 hover:underline"
                                            href="#">
                                        View Product &rarr;
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <div class="col-span-full text-center text-gray-600">
                        No products available.
                    </div>
                </template>
            </div>
        </div>

        <div class="container px-4 w-full mx-auto md:h-auto py-32">
            <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
                <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Services</h2>
                <p class="mt-1 text-gray-600 dark:text-neutral-400">
                    Discover a wide range of services offered by your peers and faculty.
                </p>
            </div>
            <div class="grid h-full grid-cols-3 gap-4 xl:grid-cols-5">
                <template v-if="services.length > 0">
                    <div v-for="service in services" :key="service.id" class="mb-6 w-full select-none">
                        <div class="relative pb-64">
                            <div class="cursor-pointer">
                                <img class="absolute h-full w-full cursor-pointer rounded-lg border-b object-cover shadow-md"
                                    :src="service.services_picture || 'default-image-url'" alt="service name" />
                            </div>
                        </div>

                        <div class="relative -mt-16 px-4">
                            <div
                                class="rounded-lg border dark:border-none bg-white dark:bg-gray-800 shadow-lg shadow-gray-200 dark:shadow-none">
                                <div class="p-5">
                                    <div class="flex items-center justify-between">
                                        <div class="text-xs opacity-75">
                                            <a class="hover:underline dark:text-gray-200" href="#">{{
                                                service.services_category }}</a>
                                        </div>

                                        <span
                                            class="select-none rounded-full bg-teal-100 text-green-500 dark:bg-teal-200 dark:text-green-700 px-3 py-1 text-xs">
                                            {{ service.services_status }}
                                        </span>
                                    </div>

                                    <a class="mt-2 block truncate text-lg font-medium text-gray-800 dark:text-gray-100 hover:underline"
                                        href="#">
                                        {{ service.services_title }}
                                    </a>
                                </div>

                                <div class="flex items-center justify-between px-4 pb-3">
                                    <div>
                                        <div class="text-lg">
                                            <span class="font-medium text-gray-800 dark:text-gray-100">₱{{
                                                service.services_fee }}</span>
                                        </div>
                                    </div>

                                    <div>
                                        <Link :href="route('services.show', service.id)"
                                            class="btn-link flex items-center text-xs text-indigo-600 dark:text-indigo-300 hover:underline"
                                            href="#">
                                        View service &rarr;
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <div class="col-span-full text-center text-gray-600">
                        No services available.
                    </div>
                </template>
            </div>
        </div>

        <div class="container px-4 w-full mx-auto md:h-auto py-32">
            <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
                <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Trades</h2>
                <p class="mt-1 text-gray-600 dark:text-neutral-400">
                    Facilitate trades of goods and services between students, staff, and faculty users
                    effortlessly.
                </p>
            </div>
            <div class="grid h-full grid-cols-3 gap-4 xl:grid-cols-5">
                <template v-if="trades.length > 0">
                    <div v-for="trade in trades" :key="trade.id" class="mb-6 w-full select-none cursor-pointer">
                        <div class="relative pb-64">
                            <div class="cursor-pointer">
                                <img class="absolute h-full w-full cursor-pointer rounded-lg object-cover shadow-md"
                                    :src="trade.trade_picture || 'default-image-url'" :alt="trade.trade_title" />
                            </div>
                        </div>

                        <div class="relative -mt-16 px-4">
                            <div
                                class="rounded-lg border dark:border-none bg-white dark:bg-gray-800 shadow-lg shadow-gray-200 dark:shadow-none">
                                <div class="p-5">
                                    <div class="flex items-center justify-between">
                                        <div class="text-xs opacity-75">
                                            <a class="hover:underline dark:text-gray-200" href="#">
                                                {{ trade.trade_category }}</a>
                                        </div>

                                        <span
                                            class="select-none rounded-full bg-teal-100 text-green-500 dark:bg-teal-200 dark:text-green-700 px-3 py-1 text-xs">
                                            {{ trade.trade_status }}
                                        </span>
                                    </div>

                                    <a class="mt-2 block truncate text-lg font-medium text-gray-800 dark:text-gray-100 hover:underline"
                                        href="#">
                                        {{ trade.trade_title }}
                                    </a>
                                </div>

                                <div class="flex items-center justify-between px-4 pb-3">
                                    <div class="text-lg">
                                        <span class="font-medium text-gray-800 dark:text-gray-100">{{
                                            trade.trade_type }}</span>
                                    </div>

                                    <Link :href="route('trades.show', trade.id)"
                                        class="btn-link flex items-center text-xs text-indigo-600 dark:text-indigo-300 hover:underline">
                                    View trade &rarr;
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <div class="col-span-full text-center text-gray-600">
                        No trades available.
                    </div>
                </template>
            </div>
        </div>

        <div class="container px-4 w-full mx-auto md:h-auto py-24">
            <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
                <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Posts</h2>
                <p class="mt-1 text-gray-600 dark:text-neutral-400">
                    Explore the latest list searching and announcements from fellow students,
                    staff, and faculty users.
                </p>
            </div>
            <div class="grid h-full grid-cols-3 gap-4 xl:grid-cols-5">
                <template v-if="posts.length > 0">
                    <div v-for="post in posts" :key="post.id" class="mb-6 w-full select-none cursor-pointer">
                        <div class="relative pb-64">
                            <div class="cursor-pointer">
                                <img class="absolute h-full w-full cursor-pointer rounded-lg border-b object-cover shadow-md"
                                    :src="post.post_picture || 'default-image-url'" alt="post name" />
                            </div>
                        </div>

                        <div class="relative -mt-16 px-4">
                            <div
                                class="rounded-lg border dark:border-none bg-white dark:bg-gray-800 shadow-lg shadow-gray-200 dark:shadow-none">
                                <div class="p-5">
                                    <div class="flex items-center justify-between">
                                        <div class="text-xs opacity-75">
                                            <a class="hover:underline dark:text-gray-200" href="#">
                                                {{ post.post_list_type }}</a>
                                        </div>
                                    </div>

                                    <a class="mt-2 block truncate text-lg font-medium text-gray-800 dark:text-gray-100 hover:underline"
                                        href="#">
                                        {{ post.post_title }}
                                    </a>
                                </div>

                                <div class="flex items-center justify-between px-4 pb-3">
                                    <Link :href="route('posts.show', post.id)"
                                        class="btn-link flex items-center text-xs text-indigo-600 dark:text-indigo-300 hover:underline">
                                    View Post &rarr;
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <div class="col-span-full text-center text-gray-600">
                        No posts available.
                    </div>
                </template>
            </div>
        </div>
    </GuestLayout>
</template>
