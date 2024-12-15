<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import AuthAdminLayout from '../../Layouts/AuthAdminLayout.vue';

// Access props from Inertia
const { props } = usePage();
const {
    totalUsers,
    totalCampusUser,
    totalProducts,
    totalServices,
    totalPosts,
    totalTrades,
    newUsersThisWeek,
    newServicesThisWeek,
    newPostsThisWeek,
    newTradesThisWeek,
    newProductsThisWeek,
    newCampusUsersThisWeek,
    postPercentage,
    tradePercentage,
    productPercentage,
    servicePercentage,
    percentageChange,
    percentageChangeInCampusUsers,
} = props;
</script>

<template>
    <AuthAdminLayout>

        <Head title="Admin Dashboard" />

        <div class="dashboard p-6">
            <h1 class="text-2xl font-bold mb-4 dark:text-gray-50">Admin Dashboard</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                <!-- Total users -->
                <div
                    class="flex items-center justify-between px-5 py-4 bg-white dark:bg-gray-800/60 shadow-xl shadow-gray-200 dark:shadow-gray-800/30 rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <div>
                        <h2 class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase">
                            All Users: <span :class="newUsersThisWeek >= 0 ? 'text-green-500' : 'text-red-500'">+{{
                                newUsersThisWeek }}</span>
                        </h2>
                        <div class="flex flex-wrap gap-3 py-2">
                            <p class="text-3xl font-bold text-gray-800 dark:text-gray-200">{{ totalUsers }}</p>
                            <p class="text-gray-400 dark:text-gray-300 text-base"><span class="text-sm">Total
                                    users</span>
                            </p>
                        </div>
                        <p class="text-sm" :class="percentageChange >= 0 ? 'text-green-500' : 'text-red-500'">
                            {{ percentageChange }}% since last week
                        </p>
                    </div>
                    <div
                        class="bg-red-100 text-red-600 dark:bg-red-500 dark:text-red-100 rounded-full shadow-lg shadow-gray-200 dark:shadow-red-900 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                    </div>
                </div>

                <!-- New Users Card -->
                <div
                    class="flex items-center justify-between px-5 py-4 bg-white dark:bg-gray-800/60 shadow-xl shadow-gray-200 dark:shadow-gray-800/30 rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <div>
                        <h2 class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase">
                            New Users
                        </h2>
                        <div class="flex flex-wrap gap-3 py-2">
                            <p class="text-3xl font-bold text-gray-800 dark:text-gray-200">{{ newUsersThisWeek }}</p>
                            <p class="text-gray-400 dark:text-gray-300 text-base"><span class="text-sm">Total new
                                    users</span>
                            </p>
                        </div>
                        <p class="text-sm" :class="percentageChange >= 0 ? 'text-green-500' : 'text-red-500'">
                            {{ percentageChange }}% since last week
                        </p>
                    </div>
                    <div
                        class="bg-green-100 text-green-600 dark:bg-green-500 dark:text-green-100 rounded-full shadow-lg shadow-gray-200 dark:shadow-green-900 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>

                    </div>
                </div>

                <!-- Total campus users -->
                <div
                    class="flex items-center justify-between px-5 py-4 bg-white dark:bg-gray-800/60 shadow-xl shadow-gray-200 dark:shadow-gray-800/30 rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <div>
                        <h2 class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase">
                            Campus user: <span
                                :class="newCampusUsersThisWeek >= 0 ? 'text-green-500' : 'text-red-500'">+{{
                                newCampusUsersThisWeek }}</span>
                        </h2>
                        <div class="flex flex-wrap gap-3 py-2">
                            <p class="text-3xl font-bold text-gray-800 dark:text-gray-200">{{ totalCampusUser }}</p>
                            <p class="text-gray-400 dark:text-gray-300 text-base"><span class="text-sm">Total campus
                                    users</span>
                            </p>
                        </div>
                        <p class="text-sm"
                            :class="percentageChangeInCampusUsers >= 0 ? 'text-green-500' : 'text-red-500'">
                            {{ percentageChangeInCampusUsers }}% since last week
                        </p>
                    </div>
                    <div
                        class="bg-yellow-100 text-yellow-600 dark:bg-yellow-600 dark:text-yellow-100 rounded-full shadow-lg shadow-gray-200 dark:shadow-yellow-900 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </div>
                </div>

                <!-- Total Products -->
                <div
                    class="flex items-center justify-between px-5 py-4 bg-white dark:bg-gray-800/60 shadow-xl shadow-gray-200 dark:shadow-gray-800/30 rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <div>
                        <h2 class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase">
                            Total Products: <span
                                :class="newProductsThisWeek >= 0 ? 'text-green-500' : 'text-red-500'">+{{
                                newProductsThisWeek }}</span>
                        </h2>
                        <div class="flex flex-wrap gap-3 py-2">
                            <p class="text-3xl font-bold text-gray-800 dark:text-gray-200">{{ totalProducts }}</p>
                            <p class="text-gray-400 dark:text-gray-300 text-base"><span class="text-sm">Total
                                    products</span></p>
                        </div>
                        <p class="text-sm" :class="productPercentage >= 0 ? 'text-green-500' : 'text-red-500'">
                            {{ productPercentage }}% since last week
                        </p>
                    </div>
                    <div
                        class="bg-orange-100 text-orange-600 dark:bg-orange-400 dark:text-orange-100 rounded-full shadow-lg shadow-gray-200 dark:shadow-orange-900 p-3">
                        <svg class="size-6.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                        </svg>
                    </div>
                </div>

                <!-- Total services -->
                <div
                    class="flex items-center justify-between px-5 py-4 bg-white dark:bg-gray-800/60 shadow-xl shadow-gray-200 dark:shadow-gray-800/30 rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <div>
                        <h2 class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase">
                            Total Services: <span
                                :class="newServicesThisWeek >= 0 ? 'text-green-500' : 'text-red-500'">+{{
                                newServicesThisWeek }}</span>
                        </h2>
                        <div class="flex flex-wrap gap-3 py-2">
                            <p class="text-3xl font-bold text-gray-800 dark:text-gray-200">{{ totalServices }}</p>
                            <p class="text-gray-400 dark:text-gray-300 text-base"><span class="text-sm">Total
                                    services</span></p>
                        </div>
                        <p class="text-sm" :class="servicePercentage >= 0 ? 'text-green-500' : 'text-red-500'">
                            {{ servicePercentage }}% since last week
                        </p>
                    </div>
                    <div
                        class="bg-orange-100 text-cyan-600 dark:bg-cyan-600 dark:text-cyan-100 rounded-full shadow-lg shadow-gray-200 dark:shadow-cyan-900 p-3">
                        <svg class="size-6.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.079 6.839a3 3 0 0 0-4.255.1M13 20h1.083A3.916 3.916 0 0 0 18 16.083V9A6 6 0 1 0 6 9v7m7 4v-1a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1Zm-7-4v-6H5a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h1Zm12-6h1a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-1v-6Z" />
                        </svg>
                    </div>
                </div>

                <!-- Total posts -->
                <div
                    class="flex items-center justify-between px-5 py-4 bg-white dark:bg-gray-800/60 shadow-xl shadow-gray-200 dark:shadow-gray-800/30 rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <div>
                        <h2 class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase">
                            Total Posts: <span :class="newPostsThisWeek >= 0 ? 'text-green-500' : 'text-red-500'">+{{
                                newPostsThisWeek }}</span>
                        </h2>
                        <div class="flex flex-wrap gap-3 py-2">
                            <p class="text-3xl font-bold text-gray-800 dark:text-gray-200">{{ totalPosts }}</p>
                            <p class="text-gray-400 dark:text-gray-300 text-base"><span class="text-sm">Total
                                    posts</span></p>
                        </div>
                        <p class="text-sm" :class="postPercentage >= 0 ? 'text-green-500' : 'text-red-500'">
                            {{ postPercentage }}% since last week
                        </p>
                    </div>
                    <div
                        class="bg-orange-100 text-cyan-600 dark:bg-cyan-600 dark:text-cyan-100 rounded-full shadow-lg shadow-gray-200 dark:shadow-cyan-900 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="24" height="24" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                        </svg>
                    </div>
                </div>

                <!-- Total trades -->
                <div
                    class="flex items-center justify-between px-5 py-4 bg-white dark:bg-gray-800/60 shadow-xl shadow-gray-200 dark:shadow-gray-800/30 rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <div>
                        <h2 class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase">
                            Total Trades: <span :class="newTradesThisWeek >= 0 ? 'text-green-500' : 'text-red-500'">+{{
                                newTradesThisWeek }}</span>
                        </h2>
                        <div class="flex flex-wrap gap-3 py-2">
                            <p class="text-3xl font-bold text-gray-800 dark:text-gray-200">{{ totalTrades }}</p>
                            <p class="text-gray-400 dark:text-gray-300 text-base"><span class="text-sm">Total
                                    trades</span></p>
                        </div>
                        <p class="text-sm" :class="tradePercentage >= 0 ? 'text-green-500' : 'text-red-500'">
                            {{ tradePercentage }}% since last week
                        </p>
                    </div>
                    <div
                        class="bg-orange-100 text-cyan-600 dark:bg-cyan-600 dark:text-cyan-100 rounded-full shadow-lg shadow-gray-200 dark:shadow-cyan-900 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" width="24" height="24" class="size-6.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </AuthAdminLayout>
</template>
