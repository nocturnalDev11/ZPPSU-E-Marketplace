<script setup>
import { ref, computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import Create from './Partials/Create.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';

const props = defineProps({
    user: {
        type: Object,
        required: true,
        default: null,
    },
    posts: {
        type: Array,
        default: () => [],
    },
});

const searchTerm = ref('');

const filteredPosts = computed(() => {
    if (!searchTerm.value) return props.posts;
    return props.posts.filter(post =>
        post.post_title.toLowerCase().includes(searchTerm.value.toLowerCase())
    );
});

const showModal = ref(false);

const closeModal = () => {
    showModal.value = false;
    form.clearErrors();
    form.reset();
}
</script>

<template>

    <Head title="Posts" />

    <component :is="($page.props.auth.user ? AppLayout : GuestLayout)">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Posts
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
                                Posts
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>
        </template>

        <div class="container w-full mx-auto pt-4">
            <div
                class="block justify-between items-center p-4 mx-4 mt-4 mb-6 bg-gray-100 dark:bg-gray-950/50 rounded-2xl shadow-xl shadow-gray-200 dark:shadow-gray-800 lg:p-5 sm:flex">
                <div class="mb-1 w-full">
                    <div class="mb-4">
                        <nav class="xl:flex lg:flex md:hidden sm:hidden mb-5">
                            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                                <li class="inline-flex items-center">
                                    <Link :href="route('home')" v-if="$page.props.auth.user"
                                        class="inline-flex items-center text-gray-700 hover:text-gray-900 dark:text-gray-200 dark:hover:text-gray-100">
                                    <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                        </path>
                                    </svg>
                                    Home
                                    </Link>

                                    <Link v-else :href="route('landing.page')"
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
                                        <span class="ml-1 text-md font-medium text-gray-400 md:ml-2"
                                            aria-current="page">Posts</span>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="block items-center sm:flex md:divide-x md:divide-gray-100 dark:md:divide-gray-700">
                        <form class="mb-4 sm:pr-3 sm:mb-0">
                            <label for="posts-search" class="sr-only">Search</label>
                            <div class="relative mt-1 sm:w-64 xl:w-96">
                                <input type="text" id="posts-search" v-model="searchTerm" placeholder="Search for posts"
                                    class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-900/50 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50" />
                            </div>
                        </form>
                        <div class="flex items-center w-full sm:justify-end">
                            <Create v-if="$page.props.auth.user"
                                class="inline-flex items-center text-center dark:text-white sm:ml-auto">
                                <svg class="mr-2 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Add posts
                            </Create>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid h-full w-full grid-cols-3 gap-4 px-2 md:h-auto xl:grid-cols-5 pt-44 lg:p-5">
                <template v-if="filteredPosts.length > 0">
                    <div v-for="post in filteredPosts" :key="post.id" class="mb-6 w-full select-none cursor-pointer">
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

                                <div class="flex items-center justify-end px-4 pb-3">
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
    </component>
</template>
