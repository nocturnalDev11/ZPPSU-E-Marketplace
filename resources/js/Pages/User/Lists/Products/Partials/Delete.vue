<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';

const props = defineProps(['productId']);
const showModal = ref(false);
const selectedProductId = ref(null);
const form = useForm({});

const confirmDeleteProduct = (id) => {
    selectedProductId.value = id;
    showModal.value = true;
};

const deleteProduct = () => {
    form.delete(route('products.destroy', selectedProductId.value), {
        onSuccess: () => {
            showModal.value = false;
            selectedProductId.value = null;
        },
    });
};

const closeModal = () => {
    showModal.value = false;
    selectedProductId.value = null;
};
</script>

<template>
    <DangerButton @click="confirmDeleteProduct(props.productId)">
        Delete
    </DangerButton>

    <div v-if="showModal" class="z-[100] fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg max-w-sm">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Are you sure?</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-200">This action cannot be undone. Do you really want to delete
                this product?
            </p>

            <div class="mt-4 flex justify-end">
                <button @click="closeModal"
                    class="px-4 py-2 bg-gray-200 dark:bg-gray-800 text-gray-700 dark:text-gray-100 rounded mr-2">Cancel</button>
                <button @click="deleteProduct" class="px-4 py-2 bg-red-600 text-white rounded">Confirm</button>
            </div>
        </div>
    </div>
</template>
