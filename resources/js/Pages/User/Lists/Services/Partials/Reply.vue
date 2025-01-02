<script setup>
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    parentId: {
        type: Number,
        required: true
    },
    serviceId: {
        type: Number,
        required: true
    },
    userId: {
        type: Number,
        required: true
    },
    replies: {
        type: Array,
        required: true,
        default: () => []
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
        second: '2-digit',
    });
}

const form = useForm({
    rating_text: '',
    services_id: props.serviceId,
    user_id: props.userId,
    parent_id: props.parentId
});

const submitReply = () => {
    console.log(form);
    form.post(route('services.reply'), {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <article class="p-6 mb-3 ml-6 lg:ml-12 text-base bg-white rounded-lg dark:bg-gray-900">

        <form @submit.prevent="submitReply" class="w-full mx-auto mb-4">
            <div class="relative">
                <TextInput v-model="form.rating_text"
                    class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Write a reply..." required />
                <SecondaryButton type="submit" class="absolute end-2 bottom-2 top-2 text-sm px-4 py-2">
                    Reply
                </SecondaryButton>
            </div>
        </form>

        <div v-for="reply in replies" :key="reply.id" class="mb-4">
            <footer class="flex justify-between items-center mb-2">
                <div class="flex items-center">
                    <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                        <div
                            class="mr-3 w-8 h-8 rounded-full flex-shrink-0 relative inline-flex items-center justify-center shadow-lg shadow-amber-300 dark:shadow-amber-800/70 overflow-hidden bg-amber-400 dark:bg-amber-500">
                            <span class="p-2 font-medium text-lg text-gray-300 dark:text-gray-100">
                                {{ reply.user.name.charAt(0).toUpperCase() || '?' }}
                            </span>
                        </div>
                        <p>{{ reply.user.name }}</p>
                    </div>
                    <time class="text-xs text-gray-600 dark:text-gray-400">
                        {{ formatDate(reply.created_at) }}
                    </time>
                </div>
                <button id="dropdownComment2Button" data-dropdown-toggle="dropdownComment2"
                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-40 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    type="button">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 16 3">
                        <path
                            d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                    </svg>
                    <span class="sr-only">Comment settings</span>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownComment2"
                    class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownMenuIconHorizontalButton">
                        <li>
                            <a href="#"
                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                        </li>
                    </ul>
                </div>
            </footer>
            <p class="text-gray-500 dark:text-gray-400">{{ reply.rating_text }}</p>
        </div>
    </article>
</template>
