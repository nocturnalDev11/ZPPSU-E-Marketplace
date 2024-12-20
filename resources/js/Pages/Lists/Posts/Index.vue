<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import AuthAdminLayout from '@/Layouts/AuthAdminLayout.vue';
import AuthUsersLayout from '@/Layouts/AuthUsersLayout.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Create from './Partials/Create.vue';
import Modal from '@/Components/Modal.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    posts: {
        type: Array,
        default: () => [],
    },
    isAuthorized: {
        type: Boolean,
        default: false,
    }
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

    <Head title="All posts" />

    <template v-if="isAuthorized">
        <AuthAdminLayout v-if="$page.props.auth.user.role_id === 1">
            <div class="container w-full mx-auto pt-4">
                <div
                    class="block justify-between items-center p-4 mx-4 mt-4 mb-6 bg-white dark:bg-gray-950/50 rounded-2xl shadow-xl shadow-gray-200 dark:shadow-gray-800 lg:p-5 sm:flex">
                    <div class="mb-1 w-full">
                        <div class="mb-4">
                            <nav class="flex mb-5" aria-label="Breadcrumb">
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
                                                aria-current="page">Posts</span>
                                        </div>
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="text-xl font-semibold text-gray-900 dark:text-gray-100 sm:text-2xl">All posts
                            </h1>
                        </div>
                        <div class="block items-center sm:flex md:divide-x md:divide-gray-100 dark:md:divide-gray-700">
                            <form class="mb-4 sm:pr-3 sm:mb-0">
                                <label for="posts-search" class="sr-only">Search</label>
                                <div class="relative mt-1 sm:w-64 xl:w-96">
                                    <input type="text" id="posts-search" v-model="searchTerm"
                                        placeholder="Search for posts"
                                        class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-900/50 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="grid h-full w-full grid-cols-3 gap-4 px-2 md:h-auto xl:grid-cols-5 pt-44 lg:p-5">
                    <template v-if="filteredPosts.length > 0">
                        <div v-for="post in filteredPosts" :key="post.id"
                            class="mb-6 w-full select-none cursor-pointer">
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
        </AuthAdminLayout>

        <AuthUsersLayout>
            <div class="container w-full mx-auto pt-4">
                <div
                    class="block justify-between items-center p-4 mx-4 mt-4 mb-6 bg-white dark:bg-gray-950/50 rounded-2xl shadow-xl shadow-gray-200 dark:shadow-gray-800 lg:p-5 sm:flex">
                    <div class="mb-1 w-full">
                        <div class="mb-4">
                            <nav class="flex mb-5" aria-label="Breadcrumb">
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
                                                aria-current="page">Posts</span>
                                        </div>
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="text-xl font-semibold text-gray-900 dark:text-gray-100 sm:text-2xl">All posts
                            </h1>
                        </div>
                        <div class="block items-center sm:flex md:divide-x md:divide-gray-100 dark:md:divide-gray-700">
                            <form class="mb-4 sm:pr-3 sm:mb-0">
                                <label for="posts-search" class="sr-only">Search</label>
                                <div class="relative mt-1 sm:w-64 xl:w-96">
                                    <input type="text" id="posts-search" v-model="searchTerm"
                                        placeholder="Search for posts"
                                        class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-900/50 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50" />
                                </div>
                            </form>
                            <div class="flex items-center w-full sm:justify-end">
                                <Create
                                    v-if="$page.props.auth.user.role_id === 2 || $page.props.auth.user.role_id === 3"
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
                        <div v-for="post in filteredPosts" :key="post.id"
                            class="mb-6 w-full select-none cursor-pointer">
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
        </AuthUsersLayout>
    </template>

    <template v-else>
        <GuestLayout>
            <div class="container w-full mx-auto py-36">
                <div
                    class="block justify-between items-center p-4 mx-4 mt-4 mb-6 bg-white dark:bg-gray-950/50 rounded-2xl shadow-xl shadow-gray-200 dark:shadow-gray-800 lg:p-5 sm:flex">
                    <div class="mb-1 w-full">
                        <div class="mb-4">
                            <nav class="flex mb-5" aria-label="Breadcrumb">
                                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                                    <li class="inline-flex items-center">
                                        <Link :href="route('landing.page')"
                                            class="inline-flex items-center text-gray-700 hover:text-gray-900 dark:text-gray-200 dark:hover:text-gray-100">
                                        <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                            </path>
                                        </svg>
                                        Landing page
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
                                                aria-current="page">Posts</span>
                                        </div>
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="text-xl font-semibold text-gray-900 dark:text-gray-100 sm:text-2xl">All posts
                            </h1>
                        </div>
                        <div class="block items-center sm:flex md:divide-x md:divide-gray-100 dark:md:divide-gray-700">
                            <form class="mb-4 sm:pr-3 sm:mb-0">
                                <label for="posts-search" class="sr-only">Search</label>
                                <div class="relative mt-1 sm:w-64 xl:w-96">
                                    <input type="text" id="posts-search" v-model="searchTerm"
                                        placeholder="Search for posts"
                                        class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-900/50 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50" />
                                </div>
                            </form>
                            <div class="flex items-center w-full sm:justify-end">
                                <SecondaryButton @click="showModal = true"
                                    class="inline-flex items-center text-center dark:text-white sm:ml-auto">
                                    <svg class="mr-2 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Add posts
                                </SecondaryButton>
                                <Modal :show="showModal" @close="closeModal">
                                    <div class="p-6">
                                        <p class="text-sm text-gray-600 dark:text-gray-300">Please log in to inquire
                                            about this post.</p>

                                        <div class="flex gap-3 py-2">
                                            <Link :href="route('verification')"
                                                class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">
                                            Verify email
                                            </Link>
                                            <Link :href="route('campus.login')"
                                                class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800">
                                            Log in
                                            </Link>
                                        </div>
                                    </div>
                                </Modal>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid h-full w-full grid-cols-3 gap-4 px-2 md:h-auto xl:grid-cols-5 pt-44 lg:p-5">
                    <template v-if="filteredPosts.length > 0">
                        <div v-for="post in filteredPosts" :key="post.id"
                            class="mb-6 w-full select-none cursor-pointer">
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
        </GuestLayout>
    </template>
</template>
