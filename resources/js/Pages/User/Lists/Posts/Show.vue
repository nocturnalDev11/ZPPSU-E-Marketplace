<script setup>
import { ref, computed } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import Edit from './Partials/Edit.vue';
import Delete from './Partials/Delete.vue';
import Modal from '@/Components/Modal.vue';
import Comment from './Partials/Comment.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import TextArea from '@/Components/TextArea.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const { props } = usePage();

defineProps({
    user: {
        type: Object,
        required: true,
        default: null,
    },
    post: {
        type: Object,
        required: true,
    },
    message: {
        type: Object,
        required: true,
    },
    relatedPosts: {
        type: Array,
        default: () => [],
    },
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

const showModal = ref(false);

const closeModal = () => {
    showModal.value = false;
    form.clearErrors();
    form.reset();
};

const isAdmin = computed(() => props.auth?.admin || false);
const currentLayout = computed(() => {
    if (isAdmin.value) return AdminLayout;
    return props.auth?.user ? AppLayout : GuestLayout;
});

</script>

<template>

    <Head :title="post.post_title" />
    <component :is="currentLayout">
        <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="grid lg:grid-cols-3 gap-y-8 lg:gap-y-0 lg:gap-x-6">
                <!-- Content -->
                <div class="lg:col-span-2">
                    <div class="py-8 lg:pe-8">
                        <div class="space-y-5 lg:space-y-8">
                            <Link
                                class="inline-flex items-center gap-x-1.5 text-sm text-gray-600 decoration-2 hover:underline focus:outline-none focus:underline dark:text-blue-500"
                                :href="route('posts.index')">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="m15 18-6-6 6-6" />
                            </svg>
                            Back to posts
                            </Link>

                            <h2 class="text-3xl font-bold lg:text-5xl dark:text-white">
                                {{ post.post_title }}
                            </h2>

                            <div class="flex items-center gap-x-5">
                                <a class="inline-flex items-center gap-1.5 py-1 px-3 sm:py-2 sm:px-4 rounded-full text-xs sm:text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                    href="#">
                                    {{ post.post_list_type }}
                                </a>
                                <p class="text-xs sm:text-sm text-gray-800 dark:text-neutral-200">
                                    {{ formatDate(post.created_at) }}
                                </p>
                            </div>

                            <figure
                                class="sm:h-[450px] bg-white shadow-lg shadow-gray-300 dark:shadow-none dark:bg-gray-800 rounded-lg">
                                <img class="w-full max-h-full object-contain object-top rounded-xl"
                                    :src="post.post_picture" alt="Blog Image">
                            </figure>

                            <div class="space-y-3">
                                <p class="text-lg text-gray-800 dark:text-neutral-200">
                                    {{ post.post_content }}
                                </p>
                            </div>
                        </div>
                        <Comment v-if="post && $page.props.auth.user" :post="post" :comments="post.comments"
                            :user_id="user.id" />
                    </div>
                </div>

                <div class="lg:col-span-1 lg:w-full lg:h-full dark:from-gray-800">
                    <div class="sticky top-0 start-0 py-8 lg:ps-8">
                        <div
                            class="group flex items-center gap-x-3 border-b border-gray-200 pb-8 mb-8 dark:border-neutral-700">
                            <div class="block shrink-0 focus:outline-none">
                                <div
                                    class="mr-3 w-8 h-8 rounded-full flex-shrink-0 relative inline-flex items-center justify-center shadow-lg shadow-red-300 dark:shadow-red-800/70 overflow-hidden bg-red-400 dark:bg-red-800">
                                    <span class="p-2 font-medium text-lg text-white dark:text-gray-100">
                                        {{ post.user.name.charAt(0).toUpperCase() || '?' }}
                                    </span>
                                </div>
                            </div>

                            <a class="group grow block focus:outline-none" href="">
                                <h5
                                    class="group-hover:text-gray-600 group-focus:text-gray-600 text-sm font-semibold text-gray-800 dark:group-hover:text-neutral-400 dark:group-focus:text-neutral-400 dark:text-neutral-200">
                                    {{ post.user.name }}
                                </h5>
                                <p class="text-sm text-gray-500 dark:text-neutral-500">
                                    {{ post.user.department }} department
                                </p>
                            </a>

                            <div class="grow">
                                <div class="flex justify-end" v-if="!props.user || post.user.id !== props.user.id">
                                    <SecondaryButton @click="showModal = true" class="inline-flex items-center gap-2">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                                        </svg>
                                        Message
                                    </SecondaryButton>

                                    <Modal :show="showModal" @close="closeModal">
                                        <div class="p-6">
                                            <template v-if="!$page.props.auth.user">
                                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                                    Please log in to inquire about this product.</p>
                                                <div class="flex gap-3 py-2">
                                                    <Link :href="route('login')"
                                                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800">
                                                    Log in
                                                    </Link>
                                                </div>
                                            </template>
                                            <template v-else>
                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 pb-3">
                                                    Inquire this post to {{ post.user.name }}</h2>

                                                <form @submit.prevent="submitMessage" class="space-y-4">
                                                    <input type="hidden" name="recipient_id" :value="form.recipient_id">
                                                    <input type="hidden" name="content_title"
                                                        :value="form.content_title">
                                                    <input type="hidden" name="content_link" :value="form.content_link">
                                                    <input type="hidden" name="content_link_image"
                                                        :value="form.content_link_image">
                                                    <input type="hidden" name="content_link_description"
                                                        :value="form.content_link_description">
                                                    <div>
                                                        <InputLabel for="content" value="Type a message" />
                                                        <TextArea id="content" v-model="form.content"
                                                            class="mt-1 block w-full" rows="3"
                                                            placeholder="Aa"></textarea>
                                                        <InputError :message="form.errors.content" class="mt-2" />
                                                    </div>

                                                    <div class="mt-6 flex justify-end">
                                                        <PrimaryButton @click="closeModal">Cancel</PrimaryButton>
                                                        <SecondaryButton class="ms-3"
                                                            :class="{ 'opacity-25': form.processing }"
                                                            :disabled="form.processing" type="submit">
                                                            Send
                                                        </SecondaryButton>
                                                    </div>
                                                </form>
                                            </template>
                                        </div>
                                    </Modal>
                                </div>

                                <div class="flex justify-end gap-2" v-if="props.user && post.user.id === props.user.id">
                                    <Edit :post="post" />
                                    <Delete :postId="post.id" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </component>
</template>
