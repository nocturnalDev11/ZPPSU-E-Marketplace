<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';

const props = defineProps(['tradeId']);
const showModal = ref(false);
const selectedTradeId = ref(null);
const form = useForm({});

const confirmDeleteTrade = (id) => {
    if (id) {
        selectedTradeId.value = id;
        showModal.value = true;
    } else {
        console.error('No trade ID provided');
    }
};

const deleteTrade = () => {
    form.delete(route('trades.destroy', selectedTradeId.value), {
        onSuccess: () => {
            showModal.value = false;
            selectedTradeId.value = null;
        },
    });
};

const closeModal = () => {
    showModal.value = false;
    selectedTradeId.value = null;
};
</script>

<template>
    <DangerButton @click="confirmDeleteTrade(props.tradeId)">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
        </svg>
    </DangerButton>

    <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg max-w-sm">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Are you sure?</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-200">This action cannot be undone. Do you really want to delete
                this trade?
            </p>

            <div class="mt-4 flex justify-end">
                <button @click="closeModal"
                    class="px-4 py-2 bg-gray-200 dark:bg-gray-800 text-gray-700 dark:text-gray-100 rounded mr-2">Cancel</button>
                <button @click="deleteTrade" class="px-4 py-2 bg-red-600 text-white rounded">Confirm</button>
            </div>
        </div>
    </div>
</template>
