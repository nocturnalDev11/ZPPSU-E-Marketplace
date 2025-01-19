<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Reply from '../Partials/Reply.vue';
import TextArea from '@/Components/TextArea.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

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

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
    ratings: {
        type: Array,
        required: true,
    },
    user_id: {
        type: Number,
        required: true,
    },
});

const emit = defineEmits(['update:ratings']);
const replyFormsVisibility = ref({});

const form = useForm({
    user_id: props.user_id,
    product_id: props.product.id,
    rating_value: '',
    rating_text: '',
});

const localRatings = ref([...props.ratings]);

watch(localRatings, (newRatings) => {
    emit('update:ratings', newRatings);
});

const submitRating = () => {
    form.post(route('products.rate'), {
        onSuccess: () => {
            form.reset('rating_value', 'rating_text');
        },
    });
};

function toggleReplyForm(ratingId) {
    replyFormsVisibility.value[ratingId] = !replyFormsVisibility.value[ratingId];
}
</script>

<template>
    <div class="max-w-4xl p-4">
        <!-- User Rating Section -->
        <div class="mb-6">
            <form @submit.prevent="submitRating">
                <p class="font-semibold mb-2">
                    Rate this product: <span class="text-red-500">*</span>
                </p>
                <div class="flex flex-row-reverse justify-end">
                    <template v-for="star in 5" :key="star">
                        <input type="radio" :id="'star' + star" name="rate" :value="6 - star" class="peer hidden"
                            v-model="form.rating_value" />
                        <label :for="'star' + star"
                            class="cursor-pointer text-2xl text-gray-400 hover:text-yellow-400 peer-checked:text-yellow-500 peer-hover:text-yellow-400">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="h-6 w-6 fill-current">
                                <path
                                    d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                            </svg>
                        </label>
                    </template>
                </div>

                <TextArea v-model="form.rating_text" rows="4" class="my-3" placeholder="Write a comment..."
                    required></TextArea>
                <SecondaryButton type="submit">
                    Rate
                </SecondaryButton>
            </form>
        </div>

        <!-- Reviews List -->
        <div class="space-y-4">
            <p class="font-semibold mb-2">Customer Reviews</p>
            <div v-for="rating in ratings.filter(c => c.parent_id === null)" :key="rating.id">
                <article class="p-6 text-base rounded-lg dark:bg-gray-900">
                    <footer class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <div
                                class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">

                                <div
                                    class="mr-3 w-8 h-8 rounded-full flex-shrink-0 relative inline-flex items-center justify-center shadow-lg shadow-red-300 dark:shadow-red-800/70 overflow-hidden bg-red-400 dark:bg-red-800">
                                    <span class="p-2 font-medium text-lg text-white dark:text-gray-100">
                                        {{ rating.user.name.charAt(0).toUpperCase() || '?' }}
                                    </span>
                                </div>

                                <div class="flex-row items-center justify-center">
                                    <div class="flex gap-4">
                                        <p>
                                            {{ rating.user.name }}
                                        </p>
                                        <time class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ formatDate(rating.created_at) }}
                                        </time>
                                    </div>
                                    <!-- Render dynamic stars -->
                                    <div class="flex">
                                        <template v-for="star in 5" :key="star">
                                            <svg v-if="star <= rating.rating_value" class="w-3 fill-[#facc15]"
                                                viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg v-else class="w-3 fill-[#e5e7eb]" viewBox="0 0 14 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <p class="text-gray-500 dark:text-gray-400">
                        {{ rating.rating_text }}
                    </p>
                    <div class="flex items-center mt-4 space-x-4">
                        <button type="button" @click="toggleReplyForm(rating.id)"
                            class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                            <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                            </svg>
                            Reply
                        </button>
                    </div>
                </article>

                <!-- Reply section -->
                <div v-if="replyFormsVisibility[rating.id]">
                    <Reply :parentId="rating.id" :productId="product.id" :userId="user_id"
                        :replies="ratings.filter(reply => reply.parent_id === rating.id)" />
                </div>
            </div>
        </div>
    </div>
</template>
