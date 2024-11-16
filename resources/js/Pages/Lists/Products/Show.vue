<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import AuthUsersLayout from '../../../Layouts/AuthUsersLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextArea from '@/Components/TextArea.vue';
import PrimaryButton from '../../../Components/PrimaryButton.vue';
import SecondaryButton from '../../../Components/SecondaryButton.vue'

const props = defineProps({
    product: {
        type: Object,
        required: true
    },

    message: {
        type: Object,
        required: true
    },
});

const form = useForm({
    content: '',
    recipient_id: props.product.user.id,
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
                        <h3 class="text-gray-800 dark:text-gray-200 text-4xl font-semibold">₱{{ product.prod_price }}
                        </h3>
                        <p class="text-gray-400 dark:text-gray-300 text-base"><span class="text-sm">Tax included</span>
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

                    <div class="flex flex-wrap gap-4 mt-8" v-if="!user || product.user.id !== user.id">
                        <SecondaryButton @click="showModal = true" class="flex justify-center w-full px-4 py-2.5">
                            Inquire product
                        </SecondaryButton>

                        <Modal :show="showModal" @close="closeModal">
                            <div class="p-6">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 pb-3">Inquire this
                                    product to {{ product.user.name }}</h2>

                                <form @submit.prevent="submitMessage" class="space-y-4">
                                    <input type="hidden" name="recipient_id" :value="form.recipient_id">
                                    <div>
                                        <InputLabel for="content" value="Type a message" />
                                        <TextArea id="content" v-model="form.content" class="mt-1 block w-full" rows="3"
                                            placeholder="Aa"></textarea>
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
                                Seller information
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div v-if="activeTab === 'description'" class="mt-8">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">Product Description</h3>
                            <div class="flex mt-4">
                                <div
                                    class="px-2.5 py-1.5 bg-slate-200 text-xs text-gray-800 rounded-lg flex items-center">
                                    {{ formatDate(product.created_at) }}
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-4">{{ product.prod_description }}</p>
                        </div>

                        <div v-if="activeTab === 'seller'" class="mt-8">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">Seller Information</h3>
                            <div class="flex mt-4">
                                <p class="text-sm text-gray-600 dark:text-gray-300">{{ product.user.name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthUsersLayout>
</template>
