<script setup>
import { ref, computed } from 'vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import Rating from '../../../User/Lists/Products/Partials/Rating.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const { props } = usePage();

defineProps({
    user: {
        type: Object,
        required: true,
        default: null,
    },
    product: {
        type: Object,
        required: true
    },
    message: {
        type: Object,
        required: true,
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

const activeTab = ref('description');
</script>

<template>

    <Head :title="product.prod_name" />

    <AdminLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Product
            </h2>
        </template>

        <div class="p-8 tracking-wide max-lg:max-w-2xl mx-auto">
            <div>
                <Link :href="route('user-product.index')"
                    class="inline-flex items-center gap-x-1.5 text-sm text-gray-600 decoration-2 hover:underline focus:outline-none focus:underline dark:text-blue-500">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6" />
                </svg>
                Back to products list
                </Link>
            </div>
            <div class="grid items-start grid-cols-1 lg:grid-cols-2 gap-10">
                <div class="space-y-4 lg:sticky top-8">
                    <div class="p-4 flex items-center sm:h-[380px] rounded-lg">
                        <img :src="product.prod_picture" alt="Product"
                            class="w-full max-h-full object-contain object-top " />
                    </div>

                    <Rating v-if="product && $page.props.auth.admin" :product="product" :ratings="product.ratings"
                        :user_id="user.id" />
                </div>

                <div class="max-w-xl">
                    <div>
                        <h2 class="text-4xl font-bold text-gray-800 dark:text-white">{{ product.prod_name }}</h2>
                        <p class="text-md text-gray-600 dark:text-gray-300 mt-2">{{ formatDate(product.created_at) }}
                        </p>
                        <div>
                            <span
                                class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">
                                {{ product.prod_category }}
                            </span>
                            <span
                                class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">
                                {{ product.prod_status }}
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-4 mt-4">
                        <h3 class="text-gray-800 dark:text-gray-200 text-4xl font-semibold">₱{{ product.prod_price
                            }}
                        </h3>
                        <p class="text-gray-400 dark:text-gray-300 text-base"><span class="text-sm">Tax
                                included</span>
                        </p>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Quantity</h3>
                        <p class="italic text-xs text-gray-600 dark:text-gray-300">Product available quantity: {{
                            product.prod_quantity }}
                        </p>
                    </div>

                    <div class="mt-8">
                        <!-- Tabs -->
                        <ul class="flex border-b dark:border-gray-600">
                            <li @click="activeTab = 'description'" :class="{
                                'text-gray-800 dark:text-white font-bold text-sm py-3 px-8 border-b-2 border-gray-700 cursor-pointer': activeTab === 'description',
                                'text-gray-600 dark:hover:text-gray-300 font-bold text-sm hover:bg-gray-50 dark:hover:bg-gray-500 py-3 px-8 cursor-pointer': activeTab !== 'description'
                            }">
                                Description
                            </li>
                            <li @click="activeTab = 'seller'" :class="{
                                'text-gray-800 dark:text-white font-bold text-sm py-3 px-8 border-b-2 border-gray-700 cursor-pointer': activeTab === 'seller',
                                'text-gray-600 dark:hover:text-gray-300 font-bold text-sm hover:bg-gray-50 dark:hover:bg-gray-500 py-3 px-8 cursor-pointer': activeTab !== 'seller'
                            }">
                                Seller info
                            </li>
                        </ul>

                        <div v-show="activeTab === 'description'" class="py-6 text-gray-600 dark:text-gray-300">
                            <div class="space-y-4">
                                <div class="text-lg font-medium">Product Description</div>
                                <div class="text-sm text-justify whitespace-pre-wrap">
                                    {{ product.prod_description }}
                                </div>
                            </div>
                        </div>

                        <div v-show="activeTab === 'seller'" class="py-6 text-gray-600 dark:text-gray-300">
                            <div class="space-y-4">
                                <div class="text-lg font-medium">Seller Information</div>
                                <div class="flex gap-4">
                                    <div
                                        class="flex-shrink-0 relative inline-flex items-center justify-center rounded-2xl shadow-lg shadow-indigo-300 dark:shadow-indigo-800/70 mb-2 overflow-hidden bg-indigo-400 dark:bg-indigo-600 w-12 h-12">
                                        <span class="p-2 font-medium text-2xl text-white dark:text-gray-100">
                                            {{ product.user.name.charAt(0).toUpperCase() || '?' }}
                                        </span>
                                    </div>
                                    <div class="space-y-1">
                                        <div class="text-sm font-medium">{{ product.user.name }}</div>
                                        <div class="text-xs text-gray-400">{{ product.user.email }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
