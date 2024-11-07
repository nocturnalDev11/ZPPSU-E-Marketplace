<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthUsersLayout from '../../../Layouts/AuthUsersLayout.vue';
import PrimaryButton from '../../../Components/PrimaryButton.vue';
import SecondaryButton from '../../../Components/SecondaryButton.vue'

const props = defineProps({
    product: {
        type: Object,
        required: true
    },
});

const activeTab = ref('description');

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

</script>

<template>
    <AuthUsersLayout>

        <Head :title="product.prod_name" />
        <div class="font-sans p-8 tracking-wide max-lg:max-w-2xl mx-auto">
            <div class="grid items-start grid-cols-1 lg:grid-cols-2 gap-10">
                <div class="space-y-4 text-center lg:sticky top-8">
                    <div class="bg-gray-100 p-4 flex items-center sm:h-[380px] rounded-lg">
                        <img :src="product.prod_picture" alt="Product"
                            class="w-full max-h-full object-contain object-top " />
                    </div>
                </div>

                <div class="max-w-xl">
                    <div>
                        <h2 class="text-4xl font-bold text-gray-800">{{ product.prod_name }}</h2>
                        <p class="text-sm text-gray-600 mt-2">{{ product.prod_category }}</p>
                    </div>

                    <div class="flex mt-4">
                        <button type="button"
                            class="px-2.5 py-1.5 bg-slate-200 text-xs text-gray-800 rounded-lg flex items-center">
                            {{ product.prod_status }}
                        </button>
                    </div>

                    <div class="flex flex-wrap gap-4 mt-4">
                        <h3 class="text-gray-800 text-4xl font-semibold">₱{{ product.prod_price }}</h3>
                        <p class="text-gray-400 text-base"><span class="text-sm">Tax included</span></p>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-lg font-bold text-gray-800">Quantity</h3>
                        <p class="italic text-xs text-gray-600">Product available quantity: {{ product.prod_quantity }}
                        </p>
                        <div class="flex divide-x border w-max mt-4 rounded overflow-hidden">
                            <button type="button"
                                class="bg-gray-100 w-10 h-9 font-semibold flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-current inline"
                                    viewBox="0 0 124 124">
                                    <path
                                        d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z"
                                        data-original="#000000"></path>
                                </svg>
                            </button>
                            <button type="button"
                                class="bg-transparent w-10 h-9 font-semibold flex items-center justify-center text-gray-800 text-lg">
                                1
                            </button>
                            <button type="button"
                                class="bg-gray-800 text-white w-10 h-9 font-semibold flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-current inline"
                                    viewBox="0 0 42 42">
                                    <path
                                        d="M37.059 16H26V4.941C26 2.224 23.718 0 21 0s-5 2.224-5 4.941V16H4.941C2.224 16 0 18.282 0 21s2.224 5 4.941 5H16v11.059C16 39.776 18.282 42 21 42s5-2.224 5-4.941V26h11.059C39.776 26 42 23.718 42 21s-2.224-5-4.941-5z"
                                        data-original="#000000"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-4 mt-8" v-if="!user || product.user.id !== user.id">
                        <PrimaryButton class="flex justify-center w-full px-4 py-2.5">
                            Avail now
                        </PrimaryButton>
                    </div>

                    <div class="flex flex-wrap gap-4 mt-8" v-if="user && product.user.id === user.id">
                        <PrimaryButton class="flex justify-center min-w-[200px] px-4 py-2.5">
                            Edit product
                        </PrimaryButton>
                        <SecondaryButton class="flex justify-center min-w-[200px] px-4 py-2.5">
                            Delete
                        </SecondaryButton>
                    </div>

                    <div class="mt-8">
                        <!-- Tabs -->
                        <ul class="flex border-b">
                            <li @click="activeTab = 'description'" :class="{
                                'text-gray-800 font-bold text-sm bg-gray-100 py-3 px-8 border-b-2 border-gray-700 cursor-pointer': activeTab === 'description',
                                'text-gray-600 font-bold text-sm hover:bg-gray-100 py-3 px-8 cursor-pointer': activeTab !== 'description'
                            }">
                                Description
                            </li>
                            <li @click="activeTab = 'seller'" :class="{
                                'text-gray-800 font-bold text-sm bg-gray-100 py-3 px-8 border-b-2 border-gray-700 cursor-pointer': activeTab === 'seller',
                                'text-gray-600 font-bold text-sm hover:bg-gray-100 py-3 px-8 cursor-pointer': activeTab !== 'seller'
                            }">
                                Seller information
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div v-if="activeTab === 'description'" class="mt-8">
                            <h3 class="text-lg font-bold text-gray-800">Product Description</h3>
                            <div class="flex mt-4">
                                <div
                                    class="px-2.5 py-1.5 bg-slate-200 text-xs text-gray-800 rounded-lg flex items-center">
                                    {{ formatDate(product.created_at) }}
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 mt-4">{{ product.prod_description }}</p>
                        </div>

                        <div v-if="activeTab === 'seller'" class="mt-8">
                            <h3 class="text-lg font-bold text-gray-800">Seller Information</h3>
                            <div class="flex mt-4">
                                <p class="text-sm text-gray-600">{{ product.user.name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthUsersLayout>
</template>
