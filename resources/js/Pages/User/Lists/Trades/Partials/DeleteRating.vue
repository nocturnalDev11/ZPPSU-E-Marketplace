<script setup>
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps(['ratingId']);
const showModal = ref(false);
const selectedRatingId = ref(null);
const form = useForm({});

const confirmDeleteRating = (id) => {
    selectedRatingId.value = id;
    showModal.value = true;
};

const deleteRating = () => {
    form.delete(route('trades.ratings.destroy', selectedRatingId.value), {
        onSuccess: () => {
            showModal.value = false;
            selectedRatingId.value = null;
        },
    });
};

const closeModal = () => {
    showModal.value = false;
    selectedRatingId.value = null;
};
</script>

<template>
    <button @click="confirmDeleteRating(props.ratingId)"
        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
        type="button">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
            <path fill-rule="evenodd"
                d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                clip-rule="evenodd" />
        </svg>
        <span class="sr-only">Delete Rating</span>
    </button>

    <Modal :show="showModal" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Are you sure?</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-200">This action cannot be undone. Do you really want to delete
                this rating?</p>

            <div class="mt-4 flex justify-end">
                <button @click="closeModal"
                    class="px-4 py-2 bg-gray-200 dark:bg-gray-800 text-gray-700 dark:text-gray-100 rounded mr-2">Cancel</button>
                <button @click="deleteRating" class="px-4 py-2 bg-red-600 text-white rounded">Confirm</button>
            </div>
        </div>
    </Modal>
</template>
