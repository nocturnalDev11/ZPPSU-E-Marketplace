<script setup>
import { computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import Search from '@/Components/Search.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    auth: {
        type: Object,
        default: () => ({ user: null }),
    },
    products: {
        type: Array,
        default: () => [],
    },
    // services: {
    //     type: Array,
    //     default: () => [],
    // },
    // trades: {
    //     type: Array,
    //     default: () => [],
    // },
    posts: {
        type: Array,
        default: () => [],
    }
});

const userName = computed(() => props.auth.user?.name || 'Guest');
</script>

<template>

    <Head title="Home" />

    <AppLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Home
            </h2>
        </template>

        <div class="block justify-between items-center mx-4 mb-6 pt-10 px-5 sm:flex">
            <div
                class="p-5 mb-1 w-full bg-white dark:bg-gray-950 rounded-2xl shadow-xl shadow-gray-200 dark:shadow-gray-900">
                <div class="mb-4">
                    <nav class="flex mb-5" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2">
                            <li class="inline-flex items-center">
                                <Link :href="route('home')"
                                    class="inline-flex items-center text-gray-400 hover:text-gray-900">
                                <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg>
                                Home
                                </Link>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="mb-4 text-xl font-semibold text-gray-900 dark:text-gray-100 sm:text-2xl">Welcome, {{
                        userName }}!</h1>
                </div>
                <div
                    class="block items-center sm:flex md:divide-x divide-gray-400 md:divide-gray-100 dark:divide-gray-700 dark:md:divide-gray-600">
                    <Search />
                    <div class="flex items-center w-full sm:justify-end">
                        <div class="hidden pl-2 space-x-1 md:flex">
                            <a href="#"
                                class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <a href="#"
                                class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <a href="#"
                                class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <a href="#"
                                class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                        <Link :href="route('profile.show')"
                            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800 sm:ml-auto">
                        <svg class="mr-2 -ml-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                clip-rule="evenodd" />
                        </svg>
                        Go to profile
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-4 md:px-10 mx-auto w-full">
            <!--Products -->
            <div class="container px-4 w-full mx-auto md:h-auto pb-24">
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

            <!-- Services -->
            <!-- <div class="container px-4 w-full mx-auto md:h-auto py-24">
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
            </div> -->

            <!-- Trades -->
            <!-- <div class="container px-4 w-full mx-auto md:h-auto py-24">
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
            </div> -->

            <!-- Posts -->
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
        </div>
    </AppLayout>
</template>
