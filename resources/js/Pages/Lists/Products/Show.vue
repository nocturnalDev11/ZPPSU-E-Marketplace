<script setup>
import { Head } from '@inertiajs/vue3';
import SellerLayout from '../../../Layouts/SellerLayout.vue';
import Delete from '../Products/Partials/Delete.vue';
import Edit from '../Products/Partials/Edit.vue';

const props = defineProps({
    product: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <SellerLayout>
        <div class="p-6 max-w-4xl mx-auto bg-white shadow-lg rounded-lg">

            <Head :title="product.prod_name" />

            <div v-if="product.prod_picture" class="w-full mb-4">
                <img :src="product.prod_picture" alt="Product Image"
                    class="w-full h-80 object-cover rounded-lg shadow-md" />
            </div>

            <div class="mt-4">
                <h1 class="text-2xl font-bold text-gray-800">{{ product.prod_name }}</h1>
                <p class="text-gray-600 text-sm mt-1">{{ product.prod_category }}</p>

                <div class="flex items-center mt-4">
                    <span class="select-none rounded-full px-3 py-1 text-xs"
                        :class="product.prod_status === 'In Stock' ? 'bg-teal-200 text-green-500' : 'bg-red-200 text-red-500'">
                        {{ product.prod_status }}
                    </span>
                </div>

                <p class="text-xl font-semibold text-gray-900 mt-4">₱{{ product.prod_price }}</p>
                <p class="text-gray-700 mt-4">{{ product.prod_description }}</p>

                <Delete :productId="product.id" />
                <Edit :product="product" />

            </div>
        </div>
    </SellerLayout>
</template>
