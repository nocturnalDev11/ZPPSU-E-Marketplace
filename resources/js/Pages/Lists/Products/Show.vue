<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Delete from './Partials/Delete.vue';
import Modal from '@/Components/Modal.vue';
import AuthUsersLayout from '@/Layouts/AuthUsersLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextArea from '@/Components/TextArea.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    product: {
        type: Object,
        required: true
    },
    isAuthorized: {
        type: Boolean,
        default: false,
    },
    message: {
        type: Object,
        required: true
    },
});

const form = useForm({
    recipient_id: props.product.user.id,
    content: 'Is this available?',
    content_title: props.product.prod_name,
    content_link: route('products.show', props.product.id),
    content_link_image: props.product.prod_picture,
    content_link_description: props.product.prod_description,
});

const submitMessage = () => {
    form.post(route('message.storeListInquiry'), {
        onSuccess: () => {
            closeModal();
            form.reset();
        },
    });
};

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

    <template v-if="isAuthorized">
        <AuthUsersLayout>
            <div class="p-8 tracking-wide max-lg:max-w-2xl mx-auto">
                <div>
                    <Link :href="route('products.index')"
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
                    <div class="space-y-4 text-center lg:sticky top-8">
                        <div class="bg-gray-100 dark:bg-gray-800/70 p-4 flex items-center sm:h-[380px] rounded-lg">
                            <img :src="product.prod_picture" alt="Product"
                                class="w-full max-h-full object-contain object-top " />
                        </div>
                    </div>

                    <div class="max-w-xl">
                        <div>
                            <h2 class="text-4xl font-bold text-gray-800 dark:text-white">{{ product.prod_name }}</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">{{ product.prod_category }}</p>
                        </div>

                        <div class="flex mt-4">
                            <button type="button"
                                class="px-2.5 py-1.5 bg-slate-200 text-xs text-gray-800 rounded-lg flex items-center">
                                {{ product.prod_status }}
                            </button>
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

                        <div class="flex flex-wrap gap-4 mt-8" v-if="!props.user || product.user.id !== props.user.id">
                            <SecondaryButton @click="showModal = true" class="flex justify-center w-full px-4 py-2.5">
                                Inquire product
                            </SecondaryButton>

                            <Modal :show="showModal" @close="closeModal">
                                <div class="p-6">
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 pb-3">Inquire this
                                        product to {{ product.user.name }}</h2>

                                    <form @submit.prevent="submitMessage" class="space-y-4">
                                        <input type="hidden" name="recipient_id" :value="form.recipient_id">
                                        <input type="hidden" name="content_title" :value="form.content_title">
                                        <input type="hidden" name="content_link" :value="form.content_link">
                                        <input type="hidden" name="content_link_image" :value="form.content_link_image">
                                        <input type="hidden" name="content_link_description"
                                            :value="form.content_link_description">
                                        <div>
                                            <InputLabel for="content" value="Type a message" />
                                            <TextArea id="content" v-model="form.content" class="mt-1 block w-full"
                                                rows="3" placeholder="Aa"></textarea>
                                            <InputError :message="form.errors.content" class="mt-2" />
                                        </div>

                                        <div class="mt-6 flex justify-end">
                                            <PrimaryButton @click="closeModal">Cancel</PrimaryButton>
                                            <SecondaryButton class="ms-3" :class="{ 'opacity-25': form.processing }"
                                                :disabled="form.processing" type="submit">
                                                Send
                                            </SecondaryButton>
                                        </div>
                                    </form>
                                </div>
                            </Modal>
                        </div>

                        <div class="flex flex-wrap gap-4 mt-8" v-if="props.user && product.user.id === props.user.id">
                            <div class="flex justify-start w-full gap-2 py-2.5">
                                <Link :href="route('products.edit', product.id)"
                                    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800">
                                Edit
                                </Link>
                                <Delete :productId="product.id" />
                            </div>
                        </div>

                        <div class="mt-8">
                            <!-- Tabs -->
                            <ul class="flex border-b dark:border-gray-600">
                                <li @click="activeTab = 'description'" :class="{
                                    'text-gray-800 dark:text-white font-bold text-sm bg-gray-100 dark:bg-gray-700 py-3 px-8 border-b-2 border-gray-700 cursor-pointer': activeTab === 'description',
                                    'text-gray-600 dark:hover:text-gray-300 font-bold text-sm hover:bg-gray-100 dark:hover:bg-gray-700 py-3 px-8 cursor-pointer': activeTab !== 'description'
                                }">
                                    Description
                                </li>
                                <li @click="activeTab = 'seller'" :class="{
                                    'text-gray-800 dark:text-white font-bold text-sm bg-gray-100 dark:bg-gray-700 py-3 px-8 border-b-2 border-gray-700 cursor-pointer': activeTab === 'seller',
                                    'text-gray-600 dark:hover:text-gray-300 font-bold text-sm hover:bg-gray-100 dark:hover:bg-gray-700 py-3 px-8 cursor-pointer': activeTab !== 'seller'
                                }">
                                    Seller info
                                </li>
                            </ul>

                            <div v-show="activeTab === 'description'" class="py-6 text-gray-600 dark:text-gray-300">
                                <div class="space-y-4">
                                    <div class="text-lg font-medium">Product Description</div>
                                    <div class="text-sm text-justify whitespace-pre-wrap">{{ product.prod_description }}
                                    </div>
                                </div>
                            </div>

                            <div v-show="activeTab === 'seller'" class="py-6 text-gray-600 dark:text-gray-300">
                                <div class="space-y-4">
                                    <div class="text-lg font-medium">Seller Information</div>
                                    <div class="flex gap-4">
                                        <div
                                            class="flex-shrink-0 relative inline-flex items-center justify-center rounded-2xl shadow-lg shadow-indigo-300 dark:shadow-indigo-800/70 mb-2 overflow-hidden bg-indigo-400 dark:bg-indigo-600 w-12 h-12">
                                            <span class="p-2 font-medium text-2xl text-gray-300 dark:text-gray-100">
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
        </AuthUsersLayout>
    </template>

    <template v-else>
        <GuestLayout>
            <div class="font-sans p-8 tracking-wide max-lg:max-w-2xl mx-auto pt-44">
                <div>
                    <Link :href="route('products.index')"
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
                    <div class="space-y-4 text-center lg:sticky top-8">
                        <div class="bg-gray-100 dark:bg-gray-800/70 p-4 flex items-center sm:h-[380px] rounded-lg">
                            <img :src="product.prod_picture" alt="Product"
                                class="w-full max-h-full object-contain object-top " />
                        </div>
                    </div>

                    <div class="max-w-xl">
                        <div>
                            <h2 class="text-4xl font-bold text-gray-800 dark:text-white">{{ product.prod_name }}</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">{{ product.prod_category }}</p>
                        </div>

                        <div class="flex mt-4">
                            <button type="button"
                                class="px-2.5 py-1.5 bg-slate-200 text-xs text-gray-800 rounded-lg flex items-center">
                                {{ product.prod_status }}
                            </button>
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
                            <div
                                class="flex divide-x dark:divide-gray-700 border dark:border-gray-700 w-max mt-4 rounded overflow-hidden">
                                <button type="button"
                                    class="bg-gray-100 dark:bg-gray-700 w-10 h-9 font-semibold flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-current inline"
                                        viewBox="0 0 124 124">
                                        <path
                                            d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z"
                                            data-original="#000000"></path>
                                    </svg>
                                </button>
                                <button type="button"
                                    class="bg-transparent w-10 h-9 font-semibold flex items-center justify-center text-gray-800 dark:text-gray-100 text-lg">
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

                        <div class="flex flex-wrap gap-4 mt-8" v-if="!props.user || product.user.id !== props.user.id">
                            <SecondaryButton @click="showModal = true" class="flex justify-center w-full px-4 py-2.5">
                                Inquire product
                            </SecondaryButton>

                            <Modal :show="showModal" @close="closeModal">
                                <div class="p-6">
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Please log in to inquire
                                        about this product.</p>
                                    <div class="flex gap-3 py-2">
                                        <Link :href="route('external.login')"
                                            class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">
                                        Log in as external user
                                        </Link>
                                        <Link :href="route('campus.login')"
                                            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800">
                                        Log in as campus user
                                        </Link>
                                    </div>
                                </div>
                            </Modal>
                        </div>

                        <div class="mt-8">
                            <!-- Tabs -->
                            <ul class="flex border-b dark:border-gray-600">
                                <li @click="activeTab = 'description'" :class="{
                                    'text-gray-800 dark:text-white font-bold text-sm bg-gray-100 dark:bg-gray-700 py-3 px-8 border-b-2 border-gray-700 cursor-pointer': activeTab === 'description',
                                    'text-gray-600 dark:hover:text-gray-300 font-bold text-sm hover:bg-gray-100 dark:hover:bg-gray-700 py-3 px-8 cursor-pointer': activeTab !== 'description'
                                }">
                                    Description
                                </li>
                                <li @click="activeTab = 'seller'" :class="{
                                    'text-gray-800 dark:text-white font-bold text-sm bg-gray-100 dark:bg-gray-700 py-3 px-8 border-b-2 border-gray-700 cursor-pointer': activeTab === 'seller',
                                    'text-gray-600 dark:hover:text-gray-300 font-bold text-sm hover:bg-gray-100 dark:hover:bg-gray-700 py-3 px-8 cursor-pointer': activeTab !== 'seller'
                                }">
                                    Seller info
                                </li>
                            </ul>

                            <div v-show="activeTab === 'description'" class="py-6 text-gray-600 dark:text-gray-300">
                                <div class="space-y-4">
                                    <div class="text-lg font-medium">Product Description</div>
                                    <div class="text-sm text-justify whitespace-pre-wrap">{{ product.prod_description }}
                                    </div>
                                </div>
                            </div>

                            <div v-show="activeTab === 'seller'" class="py-6 text-gray-600 dark:text-gray-300">
                                <div class="space-y-4">
                                    <div class="text-lg font-medium">Seller Information</div>
                                    <div class="flex gap-4">
                                        <div
                                            class="flex-shrink-0 relative inline-flex items-center justify-center rounded-2xl shadow-lg shadow-indigo-300 dark:shadow-indigo-800/70 mb-2 overflow-hidden bg-indigo-400 dark:bg-indigo-600 w-12 h-12">
                                            <span class="p-2 font-medium text-2xl text-gray-300 dark:text-gray-100">
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
        </GuestLayout>
    </template>
</template>

