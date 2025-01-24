<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Reply from '../Partials/Reply.vue';
import DeleteComment from './DeleteComment.vue';

const props = defineProps({
    post: {
        type: Object,
        required: true,
    },
    comments: {
        type: Array,
        required: true,
    },
    user_id: {
        type: Number,
        required: true,
    },
});

const form = useForm({
    comment_text: '',
    post_id: props.post.id,
    user_id: props.user_id,
});

const replyFormsVisibility = ref({});

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
    });
}

const submitComment = () => {
    form.post(route('posts.comment'), {
        onSuccess: () => {
            form.reset();
        },
    });
};

function toggleReplyForm(commentId) {
    replyFormsVisibility.value[commentId] = !replyFormsVisibility.value[commentId];
}

</script>

<template>
    <div class="py-4 lg:py-8 antialiased">
        <div class="max-w-[75rem] mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">
                    Comments
                </h2>
            </div>
            <form @submit.prevent="submitComment" class="mb-6">
                <div
                    class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <label for="comment" class="sr-only">Your comment</label>
                    <textarea id="comment" rows="4" v-model="form.comment_text"
                        class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                        placeholder="Write a comment..." required></textarea>
                </div>
                <SecondaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">
                    Post comment
                </SecondaryButton>
            </form>

            <div v-for="comment in comments.filter(c => c.parent_id === null)" :key="comment.id">
                <article class="p-6 text-base">
                    <footer class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <p
                                class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">

                            <div
                                class="mr-3 w-8 h-8 rounded-full flex-shrink-0 relative inline-flex items-center justify-center shadow-lg shadow-red-300 dark:shadow-red-800/70 overflow-hidden bg-red-400 dark:bg-red-800">
                                <span class="p-2 font-medium text-lg text-gray-50 dark:text-gray-100">
                                    {{ comment.user.name.charAt(0).toUpperCase() || '?' }}
                                </span>
                            </div>
                            {{ comment.user.name }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                <time>
                                    {{ formatDate(comment.created_at) }}
                                </time>
                            </p>
                        </div>

                    </footer>
                    <p class="text-gray-500 dark:text-gray-400">
                        {{ comment.comment_text }}
                    </p>
                    <div class="flex items-center mt-4 space-x-4">
                        <button type="button" @click="toggleReplyForm(comment.id)"
                            class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                            <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                            </svg>
                            Reply
                        </button>

                        <DeleteComment
                            v-if="comment && $page.props.auth.user?.id &&
                                ($page.props.auth.user.id === comment.user_id || $page.props.auth.user.id === comment.post?.user_id)"
                            :commentId="comment.id" />
                    </div>
                </article>

                <!-- Reply section -->
                <div v-if="replyFormsVisibility[comment.id]">
                    <Reply :parentId="comment.id" :postId="post.id" :userId="user_id"
                        :replies="comments.filter(reply => reply.parent_id === comment.id)" />
                </div>
            </div>
        </div>
    </div>
</template>
