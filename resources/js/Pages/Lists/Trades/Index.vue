<script setup>
import GuestLayout from '../../../Layouts/GuestLayout.vue';
import AuthAdminLayout from '../../../Layouts/AuthAdminLayout.vue';
import AuthUsersLayout from '../../../Layouts/AuthUsersLayout.vue';
import Create from './Partials/Create.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    trades: {
        type: Array,
        default: () => [],
    },
    isAuthorized: {
        type: Boolean,
        default: false,
    }
});
</script>

<template>

    <Head title="All tradings" />

    <template v-if="isAuthorized">
        <AuthAdminLayout v-if="$page.props.auth.user.role_id === 1">
            <div class="grid h-full w-full grid-cols-1 gap-4 px-2 md:h-auto xl:grid-cols-5 py-20">
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
        </AuthAdminLayout>

        <AuthUsersLayout v-else-if="$page.props.auth.user.role_id === 2 || $page.props.auth.user.role_id === 3">
            <Create />
            <div class="grid h-full w-full grid-cols-1 gap-4 px-2 md:h-auto xl:grid-cols-5 py-20">
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
        </AuthUsersLayout>
    </template>

    <template v-else>
        <GuestLayout>
            <div class="grid h-full w-full grid-cols-1 gap-4 px-2 md:h-auto xl:grid-cols-5 pt-44">
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
        </GuestLayout>
    </template>
</template>
