<script setup>
import { ref, computed } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import Create from './Partials/Create.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const { props } = usePage();

defineProps({
    user: {
        type: Object,
        required: true,
        default: null,
    },
    trades: {
        type: Array,
        default: () => [],
    },
});

const searchTerm = ref('');

const filteredTrades = computed(() => {
    if (!searchTerm.value) return props.trades;
    return props.trades.filter(trade =>
        trade.trade_title.toLowerCase().includes(searchTerm.value.toLowerCase())
    );
});

const isAdmin = computed(() => props.auth?.admin || false);
const currentLayout = computed(() => {
    if (isAdmin.value) return AdminLayout;
    return props.auth?.user ? AppLayout : GuestLayout;
});

</script>

<template>

    <Head title="All trades" />

    <component :is="currentLayout">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Trades
            </h2>
        </template>

        <template #route>
            <nav class="flex">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <Link v-if="$page.props.auth.user" :href="route('home')"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Home
                        </Link>

                        <Link v-if="$page.props.auth.admin" :href="route('dashboard')"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Home
                        </Link>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-300">
                                Trades
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>
        </template>

        <div class="container w-full mx-auto pt-4">
            <div
                class="block justify-between items-center p-4 mx-4 mt-4 mb-6 bg-white dark:bg-gray-950/50 rounded-2xl shadow-xl shadow-gray-200 dark:shadow-gray-800 lg:p-5 sm:flex">
                <div class="mb-1 w-full">
                    <div class="mb-4">
                        <nav class="flex mb-5">
                            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                                <li class="inline-flex items-center">
                                    <Link :href="route('home')"
                                        class="inline-flex items-center text-gray-700 hover:text-gray-900 dark:text-gray-200 dark:hover:text-gray-100">
                                    <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                        </path>
                                    </svg>
                                    Home
                                    </Link>
                                </li>
                                <li>
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2"
                                            aria-current="page">Trades</span>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                        <h1 class="text-xl font-semibold text-gray-900 dark:text-gray-100 sm:text-2xl">All trades
                        </h1>
                    </div>
                    <div class="block items-center sm:flex md:divide-x md:divide-gray-100 dark:md:divide-gray-700">
                        <form class="mb-4 sm:pr-3 sm:mb-0">
                            <label for="trades-search" class="sr-only">Search</label>
                            <div class="relative mt-1 sm:w-64 xl:w-96">
                                <input type="text" id="trades-search" v-model="searchTerm"
                                    placeholder="Search for trades"
                                    class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-900/50 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50" />
                            </div>
                        </form>
                        <div class="flex items-center w-full sm:justify-end">
                            <!-- <div class="hidden pl-2 space-x-1 md:flex">
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
                                </div> -->
                            <Create v-if="$page.props.auth.user"
                                class="inline-flex items-center text-center dark:text-white sm:ml-auto">
                                <svg class="mr-2 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Add trades
                            </Create>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid h-full w-full grid-cols-3 gap-4 px-2 md:h-auto xl:grid-cols-5 pt-44 lg:p-5 ">
                <template v-if="filteredTrades.length > 0">
                    <template v-if="trades.length > 0">
                        <div v-for="trade in filteredTrades" :key="trade.id"
                            class="mb-6 w-full select-none cursor-pointer">
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
                </template>
            </div>
        </div>
    </component>
</template>
