<script setup>
import { computed } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import UpdateProfilePicture from '../Profile/Partials/UpdateProfilePicture.vue';

const { props } = usePage();

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

const posts = computed(() => props.posts || []);
const trades = computed(() => props.trades || []);
const products = computed(() => props.products || []);
const services = computed(() => props.services || []);
const activities = computed(() => props.activities || []);
const user = computed(() => props.profileUser || {});
const loggedInUserId = computed(() => props.auth.user?.id || null);

</script>

<template>

    <Head title="Profile" />

    <AppLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Profile
            </h2>
        </template>

        <template #route>
            <nav class="flex">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <Link :href="route('home')"
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
                            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                                Profile
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>
        </template>

        <div class="flex transition-all h-full w-full mx-auto py-10">
            <div class="relative w-full overflow-y-auto">
                <div class="grid grid-cols-1 px-4 xl:grid-cols-3 xl:gap-6">
                    <div class="col-span-full xl:col-auto">
                        <div
                            class="bg-white shadow-lg shadow-gray-200 dark:shadow-gray-700/50 rounded-2xl p-4 mb-6 dark:bg-gray-800">
                            <div class="sm:flex-row xl:block sm:space-x-4 xl:space-x-0 ">
                                <div class="flex justify-between items-center">
                                    <div v-if="user?.profile_picture"
                                        class="relative inline-flex items-center justify-center rounded-2xl shadow-lg shadow-gray-300 dark:shadow-gray-700 mb-2 overflow-hidden bg-gray-200 dark:bg-gray-600 w-20 h-20">
                                        <img :src="user.profile_picture" alt="Profile Picture"
                                            class="object-cover w-full h-full" />
                                    </div>

                                    <div v-else
                                        class="relative inline-flex items-center justify-center rounded-2xl shadow-lg shadow-gray-300 dark:shadow-gray-700 mb-2 overflow-hidden bg-gray-200 dark:bg-gray-600 w-20 h-20">
                                        <span class="p-2 font-medium text-2xl text-gray-700 dark:text-gray-300">
                                            {{ user?.name?.charAt(0).toUpperCase() || '?' }}
                                        </span>
                                    </div>

                                    <UpdateProfilePicture v-if="loggedInUserId && loggedInUserId === user.id" />
                                </div>


                                <div>
                                    <h2 class="text-2xl font-bold dark:text-gray-200 py-2">{{ user?.name }}</h2>
                                    <ul class="space-y-1">
                                        <li
                                            class="flex items-center text-md font-normal text-gray-500 dark:text-gray-200">
                                            <svg class="mr-2 w-4 h-4 text-gray-900 dark:text-gray-200"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M4.5 3.75a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V6.75a3 3 0 0 0-3-3h-15Zm4.125 3a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Zm-3.873 8.703a4.126 4.126 0 0 1 7.746 0 .75.75 0 0 1-.351.92 7.47 7.47 0 0 1-3.522.877 7.47 7.47 0 0 1-3.522-.877.75.75 0 0 1-.351-.92ZM15 8.25a.75.75 0 0 0 0 1.5h3.75a.75.75 0 0 0 0-1.5H15ZM14.25 12a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H15a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5h3.75a.75.75 0 0 0 0-1.5H15Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span v-if="user?.department">{{ user.department }}</span>
                                            <span v-else>
                                                {{ user?.name || 'User' }} has not provided a department yet.</span>
                                        </li>
                                        <li
                                            class="flex items-center text-md font-normal text-gray-500 dark:text-gray-200">
                                            <svg class="mr-2 w-4 h-4 text-gray-900 dark:text-gray-200"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span v-if="user?.home_address">{{ user.home_address }}</span>
                                            <span v-else>
                                                {{ user?.name || 'User' }} has not provided a home address yet.</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mb-4 sm:flex xl:block">
                                    <div class="sm:flex-1">
                                        <address class="text-sm not-italic font-normal text-gray-500">
                                            <div class="mt-4 dark:text-gray-300">Email address</div>
                                            <div class="text-md font-medium text-gray-900 dark:text-gray-200">
                                                <span v-if="user?.email">{{ user.email }}</span>
                                                <span v-else>{{ user?.name || 'User' }} has not provided an email
                                                    yet.</span>
                                            </div>
                                            <div class="mt-4 dark:text-gray-300">Phone number</div>
                                            <div class="mb-2 text-md font-medium text-gray-900 dark:text-gray-200">
                                                <span v-if="user?.contact_number">{{ user.contact_number }}</span>
                                                <span v-else>{{ user?.name || 'User' }} has not provided a contact
                                                    number yet.</span>
                                            </div>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-white shadow-lg shadow-gray-200 dark:shadow-gray-700/50 rounded-2xl p-4 mb-6 dark:bg-gray-800">
                            <div class="flow-root">
                                <h3 class="text-xl font-bold dark:text-gray-200">General information</h3>
                                <ul class="mt-2 divide-y text-md text-gray-700 dark:text-white dark:divide-gray-600">
                                    <li class="flex py-2">
                                        <span class="font-semibold w-24">Gender:</span>
                                        <span class="text-gray-700 dark:text-gray-300">{{ user.gender }}</span>
                                    </li>
                                    <li class="flex py-2">
                                        <span class="font-semibold w-24">Birthday:</span>
                                        <span class="text-gray-700 dark:text-gray-300">{{ user.dob }}</span>
                                    </li>
                                    <li class="flex py-2">
                                        <span class="font-semibold w-24">Joined:</span>
                                        <span class="text-gray-700 dark:text-gray-300">
                                            {{ formatDate(user.created_at) }}
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div
                            class="bg-white shadow-lg shadow-gray-200 dark:shadow-gray-700/50 rounded-2xl p-4 mb-6 dark:bg-gray-800">
                            <div class="flow-root">
                                <h3 class="text-xl font-bold dark:text-gray-200">{{ user.name }}'s activity</h3>

                                <div class="relative px-4">
                                    <div v-if="activities.length === 0"
                                        class="flex items-center w-full my-6 justify-center">
                                        <p class="text-gray-400">No activities found.</p>
                                    </div>
                                    <div v-else>
                                        <div
                                            class="absolute h-full border-dashed border border-opacity-20 border-gray-600 dark:border-gray-200">
                                        </div>

                                        <div v-for="(activity, index) in activities" :key="index"
                                            class="flex items-center w-full my-6 -ml-1">
                                            <div class="w-1/12 z-10">
                                                <div class="w-2.5 h-2.5 bg-green-500 dark:bg-green-400 rounded-full">
                                                </div>
                                            </div>
                                            <div class="w-11/12">
                                                <p class="text-sm dark:text-white">
                                                    <span v-if="activity.type === 'Post'">
                                                        Post created: <a href="#"
                                                            class="text-green-400 dark:text-green-300 font-bold">{{
                                                            activity.title }}</a>
                                                    </span>
                                                    <span v-else-if="activity.type === 'Product'">
                                                        Product listed: <a href="#"
                                                            class="text-green-400 dark:text-green-300 font-bold">{{
                                                            activity.title }}</a>
                                                    </span>
                                                    <span v-else-if="activity.type === 'Service'">
                                                        Service offered: <a href="#"
                                                            class="text-green-400 dark:text-green-300 font-bold">{{
                                                            activity.title }}</a>
                                                    </span>
                                                    <span v-else-if="activity.type === 'Trade'">
                                                        Trade request: <a href="#"
                                                            class="text-green-400 dark:text-green-300 font-bold">{{
                                                            activity.title }}</a>
                                                    </span>
                                                    <span class="text-gray-400"> - {{ formatDate(activity.created_at)
                                                        }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <div v-for="product in products" :key="product.id"
                            class="flex flex-col lg:flex-row items-center bg-white shadow-lg shadow-gray-200 dark:shadow-gray-700/50 dark:bg-gray-800 rounded-2xl p-4 mb-6">
                            <img class="object-cover w-full lg:w-48 lg:h-48 rounded-lg" :src="product.image"
                                :alt="product.title">
                            <div class="flex flex-col w-full justify-between p-4 leading-normal">
                                <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ product.title }}
                                </h5>
                                <div class="my-2 space-x-2">
                                    <span
                                        class="inline-block bg-gray-100 text-gray-700 rounded-full px-3 py-1 text-sm font-semibold dark:bg-gray-600 dark:text-gray-300">
                                        {{ product.category }}
                                    </span>
                                    <span
                                        class="inline-block bg-gray-100 text-gray-700 rounded-full px-3 py-1 text-sm font-semibold dark:bg-gray-600 dark:text-gray-300">
                                        {{ product.status }}
                                    </span>
                                </div>
                                <p
                                    class="mb-3 font-normal text-justify whitespace-pre-wrap text-gray-700 dark:text-gray-400">
                                    {{ product.description }}
                                </p>
                                <p class="font-normal text-xs text-gray-500 dark:text-gray-400">
                                    Posted on: {{ formatDate(product.created_at) }}
                                </p>

                                <div class="flex items-center justify-between pb-3">
                                    <div>
                                        <div class="text-lg">
                                            <span class="font-medium text-green-600 dark:text-green-300">₱{{
                                                product.price }}</span>
                                        </div>
                                    </div>

                                    <div>
                                        <Link :href="product.route"
                                            class="btn-link flex items-center text-xs text-indigo-600 dark:text-indigo-300 hover:underline">
                                        View Product &rarr;
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-for="service in services" :key="service.id"
                            class="flex flex-col lg:flex-row items-center bg-white shadow-lg shadow-gray-200 dark:shadow-gray-700/50 dark:bg-gray-800 rounded-2xl p-4 mb-6">
                            <img class="object-cover w-full lg:w-48 lg:h-48 rounded-lg" :src="service.image"
                                :alt="service.title">
                            <div class="flex flex-col w-full justify-between p-4 leading-normal">
                                <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ service.title }}
                                </h5>
                                <div class="my-2 space-x-2">
                                    <span
                                        class="inline-block bg-gray-100 text-gray-700 rounded-full px-3 py-1 text-sm font-semibold dark:bg-gray-600 dark:text-gray-300">
                                        {{ service.category }}
                                    </span>
                                    <span
                                        class="inline-block bg-gray-100 text-gray-700 rounded-full px-3 py-1 text-sm font-semibold dark:bg-gray-600 dark:text-gray-300">
                                        {{ service.status }}
                                    </span>
                                </div>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    {{ service.description }}
                                </p>
                                <p class="font-normal text-xs text-gray-500 dark:text-gray-400">
                                    Posted on: {{ formatDate(service.created_at) }}
                                </p>

                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-lg">
                                            <span class="font-medium text-green-600 dark:text-green-300">₱{{
                                                service.fee }}</span>
                                        </div>
                                    </div>

                                    <div>
                                        <Link :href="service.route"
                                            class="btn-link flex items-center text-xs text-indigo-600 dark:text-indigo-300 hover:underline">
                                        View Service &rarr;
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-for="post in posts" :key="post.id"
                            class="flex flex-col lg:flex-row items-center bg-white shadow-lg shadow-gray-200 dark:shadow-gray-700/50 dark:bg-gray-800 rounded-2xl p-4 mb-6">
                            <img class="object-cover w-full lg:w-48 lg:h-48 rounded-lg" :src="post.image"
                                :alt="post.title">
                            <div class="flex flex-col w-full justify-between p-4 leading-normal">
                                <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ post.title }}
                                </h5>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    {{ post.description }}
                                </p>
                                <p class="font-normal text-xs text-gray-500 dark:text-gray-400">
                                    Posted on: {{ formatDate(post.created_at) }}
                                </p>

                                <div class="flex items-center justify-end">
                                    <div>
                                        <Link :href="post.route"
                                            class="btn-link flex items-center text-xs text-indigo-600 dark:text-indigo-300 hover:underline">
                                        View Post &rarr;
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-for="trade in trades" :key="trade.id"
                            class="flex flex-col lg:flex-row items-center bg-white shadow-lg shadow-gray-200 dark:shadow-gray-700/50 dark:bg-gray-800 rounded-2xl p-4 mb-6">
                            <img class="object-cover w-full lg:w-48 lg:h-48 rounded-lg" :src="trade.image"
                                :alt="trade.title">
                            <div class="flex flex-col w-full justify-between p-4 leading-normal">
                                <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ trade.title }}
                                </h5>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    {{ trade.description }}
                                </p>
                                <p class="font-normal text-xs text-gray-500 dark:text-gray-400">
                                    Posted on: {{ formatDate(trade.created_at) }}
                                </p>

                                <div class="flex items-center justify-end">
                                    <div>
                                        <Link :href="trade.route"
                                            class="btn-link flex items-center text-xs text-indigo-600 dark:text-indigo-300 hover:underline">
                                        View Trade &rarr;
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
