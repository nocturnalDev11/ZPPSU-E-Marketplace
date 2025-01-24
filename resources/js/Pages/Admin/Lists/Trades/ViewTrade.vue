<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import DeleteTrade from './Partials/DeleteTrade.vue';
import Rating from '../../../User/Lists/Trades/Partials/Rating.vue';

const  props = defineProps({
    user: {
        type: Object,
        required: true
    },
    trade: {
        type: Object,
        required: true
    },
    relatedTrades: {
        type: Array,
        default: () => [],
    }
});

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });
}
</script>

<template>

    <Head :title="trade.trade_title" />

    <AdminLayout>
        <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="grid lg:grid-cols-3 gap-y-8 lg:gap-y-0 lg:gap-x-6">
                <!-- Content -->
                <div class="lg:col-span-2">
                    <div class="lg:pe-8">
                        <div class="space-y-5 lg:space-y-8">
                            <Link
                                class="inline-flex items-center gap-x-1.5 text-sm text-gray-600 decoration-2 hover:underline focus:outline-none focus:underline dark:text-blue-500"
                                :href="route('user-trade.index')">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="m15 18-6-6 6-6" />
                            </svg>
                            Back to list
                            </Link>

                            <h2 class="text-3xl font-bold lg:text-5xl dark:text-white">
                                {{ trade.trade_title }}
                            </h2>
                            <p class="text-xs sm:text-sm text-gray-800 dark:text-gray-200">
                                {{ formatDate(trade.created_at) }}
                            </p>

                            <div class="flex items-center gap-x-5">
                                <a class="inline-flex items-center gap-1.5 py-1 px-3 sm:py-2 sm:px-4 rounded-full text-xs sm:text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-800 dark:focus:bg-gray-800"
                                    href="#">
                                    {{ trade.trade_status }}
                                </a>
                                <a class="inline-flex items-center gap-1.5 py-1 px-3 sm:py-2 sm:px-4 rounded-full text-xs sm:text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-800 dark:focus:bg-gray-800"
                                    href="#">
                                    {{ trade.trade_type }}
                                </a>
                            </div>

                            <figure
                                class="sm:h-[450px] bg-white shadow-lg shadow-gray-300 dark:shadow-none dark:bg-gray-800 rounded-lg">
                                <img class="w-full max-h-full object-contain object-top rounded-xl"
                                    :src="trade.trade_picture" :alt="trade.trade_title">
                            </figure>

                            <div class="space-y-3">
                                <h3 class="text-2xl font-semibold dark:text-white">Trade description</h3>
                                <p class="text-lg text-gray-800 dark:text-gray-200">
                                    {{ trade.trade_description }}
                                </p>
                            </div>

                            <div class="space-y-3">
                                <h3 class="text-2xl font-semibold dark:text-white">Conditions</h3>
                                <p class="text-lg text-gray-800 dark:text-gray-200">
                                    {{ trade.trade_conditions }}
                                </p>
                            </div>
                        </div>
                        <Rating v-if="trade && $page.props.auth.admin" :trade="trade" :ratings="trade.ratings"
                            :user_id="user.id" />
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 lg:w-full lg:h-full dark:from-gray-800">
                    <div class="sticky top-0 start-0 py-8 lg:ps-8">
                        <div
                            class="group flex items-center gap-x-3 border-b border-gray-200 pb-8 mb-8 dark:border-gray-700">
                            <a class="block shrink-0 focus:outline-none" href="#">
                                <img class="size-10 rounded-full"
                                    src="https://images.unsplash.com/photo-1669837401587-f9a4cfe3126e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
                                    alt="Avatar">
                            </a>

                            <a class="group grow block focus:outline-none" href="">
                                <h5
                                    class="group-hover:text-gray-600 group-focus:text-gray-600 text-sm font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:group-focus:text-gray-400 dark:text-gray-200">
                                    {{ trade.user.name }}
                                </h5>
                                <p v-if="$page.props.trade.user.role_id === 1 || $page.props.trade.user.role_id === 2"
                                    class="text-sm text-gray-500 dark:text-gray-500">
                                    {{ trade.user.department }} department
                                </p>
                                <p v-if="$page.props.trade.user.role_id === 3"
                                    class="text-sm text-gray-500 dark:text-gray-500">
                                    {{ trade.user.email }}
                                </p>
                            </a>

                            <div class="grow">
                                <div class="flex justify-end">
                                    <DeleteTrade :tradeId="trade.id" />
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <h3 class="text-2xl font-semibold dark:text-white">Related trades</h3>
                            <Link :href="route('user-trade.show', relatedTrade.id)"
                                v-for="relatedTrade in relatedTrades" :key="relatedTrade.id"
                                class="group flex items-center gap-x-6 focus:outline-none">
                            <div class="shrink-0 relative rounded-lg overflow-hidden size-20">
                                <img v-if="relatedTrade.trade_picture"
                                    class="size-full absolute top-0 start-0 object-cover rounded-lg"
                                    :src="relatedTrade.trade_picture" alt="trade Image" />
                                <img v-else src="https://via.placeholder.com/320" alt="Default Image"
                                    class="size-full absolute top-0 start-0 object-cover rounded-lg" />
                            </div>

                            <div class="grow">
                                <span
                                    class="text-sm font-bold text-gray-800 group-hover:text-blue-600 group-focus:text-blue-600 dark:text-gray-200 dark:group-hover:text-blue-500 dark:group-focus:text-blue-500">
                                    {{ relatedTrade.trade_title }}
                                </span>
                                <br />
                                <span
                                    class="text-xs font-medium italic text-gray-800 group-hover:text-blue-600 group-focus:text-blue-600 dark:text-gray-200 dark:group-hover:text-blue-500 dark:group-focus:text-blue-500">
                                    {{ relatedTrade.trade_description }}
                                </span>
                            </div>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
