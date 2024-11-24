<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import AuthAdminLayout from '@/Layouts/AuthAdminLayout.vue';
import AuthUsersLayout from '@/Layouts/AuthUsersLayout.vue';
import Create from './Partials/Create.vue';
import { Head, Link } from '@inertiajs/vue3';

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
</script>

<template>

    <Head title="All posts" />

    <template v-if="isAuthorized">
        <AuthAdminLayout v-if="$page.props.auth.user.role_id === 1">
            <div class="grid h-full w-full grid-cols-1 gap-4 px-2 md:h-auto xl:grid-cols-5 py-20">
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
        </AuthAdminLayout>

        <AuthUsersLayout v-else-if="$page.props.auth.user.role_id === 2 || $page.props.auth.user.role_id === 3">
            <Create />
            <div class="grid h-full w-full grid-cols-1 gap-4 px-2 md:h-auto xl:grid-cols-5 py-20">
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
        </AuthUsersLayout>
    </template>

    <template v-else>
        <GuestLayout>
            <div class="grid h-full w-full grid-cols-1 gap-4 px-2 md:h-auto xl:grid-cols-5 pt-44">
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
        </GuestLayout>
    </template>
</template>
