<script setup>
import GuestLayout from '../../../Layouts/GuestLayout.vue';
import AuthUsersLayout from '../../../Layouts/AuthUsersLayout.vue';
import AuthAdminLayout from '../../../Layouts/AuthAdminLayout.vue';
import Create from '../Products/Partials/Create.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    products: {
        type: Array,
        default: () => [],
    },
    isAuthorized: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>

    <Head title="All products" />

    <template v-if="isAuthorized">
        <!-- Auth admin layout -->
        <AuthAdminLayout v-if="$page.props.auth.user.role_id === 1">
            <div class="grid h-full w-full grid-cols-1 gap-4 px-2 md:h-auto xl:grid-cols-5 py-20">
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
                                            <a class="hover:underline dark:text-gray-200" href="#">
                                                {{ product.prod_category }}</a>
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
                                            class="btn-link flex items-center text-xs text-indigo-600 dark:text-indigo-300 hover:underline">
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
        </AuthAdminLayout>

        <!-- Auth user layout-->
        <AuthUsersLayout v-else-if="$page.props.auth.user.role_id === 2 || $page.props.auth.user.role_id === 3">
            <Create />
            <div class="grid h-full w-full grid-cols-1 gap-4 px-2 md:h-auto xl:grid-cols-5 py-20">
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
        </AuthUsersLayout>
    </template>

    <!-- Guest layout -->
    <template v-else>
        <GuestLayout>
            <div class="grid h-full w-full grid-cols-1 gap-4 px-2 md:h-auto xl:grid-cols-5 pt-44">
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
        </GuestLayout>
    </template>
</template>
