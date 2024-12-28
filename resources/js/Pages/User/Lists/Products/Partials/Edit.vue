<script setup>
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import TextArea from '@/Components/TextArea.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const showModal = ref(false);

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    prod_picture: null,
    prod_name: props.product.prod_name,
    prod_price: props.product.prod_price,
    prod_status: props.product.prod_status,
    prod_category: props.product.prod_category,
    prod_condition: props.product.prod_condition,
    prod_description: props.product.prod_description,
    prod_quantity: props.product.prod_quantity || 0,
});

const imagePreview = ref(props.product.prod_picture);
const fileName = ref("No file chosen");

const handleImageUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        fileName.value = file.name;
        imagePreview.value = URL.createObjectURL(file);
        form.prod_picture = file;
    }
};

const triggerFileInput = () => {
    document.getElementById("prod_picture").click();
};

const updateProduct = () => {
    router.post(`/products/${props.product.id}`, {
        _method: 'put',
        prod_picture: form.prod_picture,
        prod_name: form.prod_name,
        prod_price: form.prod_price,
        prod_status: form.prod_status,
        prod_category: form.prod_category,
        prod_condition: form.prod_condition,
        prod_description: form.prod_description,
        prod_quantity: form.prod_quantity
    })
};

const closeModal = () => {
    showModal.value = false;
    form.clearErrors();
    form.reset();
};

</script>

<template>
    <div>
        <SecondaryButton @click="showModal = true">
            Edit product
        </SecondaryButton>

        <Modal :show="showModal" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 pb-3">Edit Post</h2>

                <form @submit.prevent="updateProduct" class="space-y-4">

                    <div>
                        <InputLabel value="Product Image" />

                        <input type="file" id="prod_picture" @change="handleImageUpload" class="hidden" />

                        <div class="flex items-center space-x-4 mt-1">
                            <button type="button" @click="triggerFileInput"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700">
                                Choose File
                            </button>
                            <span class="text-gray-600">{{ fileName }}</span>
                        </div>

                        <div class="mt-4">
                            <img :src="imagePreview" alt="Image Preview" class="w-32 h-32 object-cover rounded-md" />
                        </div>

                        <InputError :message="form.errors.prod_picture" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="prod_name" value="Product Name" />
                        <TextInput id="prod_name" v-model="form.prod_name" class="mt-1 block w-full"
                            placeholder="Product Name" />
                        <InputError :message="form.errors.prod_name" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <InputLabel for="prod_price" value="Product Price" />
                            <TextInput id="prod_price" v-model="form.prod_price" type="number" class="mt-1 block w-full"
                                placeholder="Price" />
                            <InputError :message="form.errors.prod_price" class="mt-2" />
                        </div>

                        <div>
                            <InputLabel for="prod_category" value="Category" />
                            <select id="prod_category" v-model="form.prod_category"
                                class="mt-1 block w-full text-gray-400 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50">
                                <option value="" selected>Select category</option>
                                <option value="Apparel">Apparel</option>
                                <option value="School supplies">School Supplies</option>
                                <option value="Footwares">Footwares</option>
                                <option value="Stationery">Stationery</option>
                                <option value="Electronics">Electronics</option>
                                <option value="University merchandise">University Merchandise</option>
                                <option value="Musical instruments">Musical instruments</option>
                                <option value="Books">Books</option>
                            </select>
                            <InputError :message="form.errors.prod_category" class="mt-2" />
                        </div>

                        <div>
                            <InputLabel for="prod_status" value="Status" />
                            <select id="prod_status" v-model="form.prod_status"
                                class="mt-1 block w-full text-gray-400 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50">
                                <option value="" disabled>Select a status</option>
                                <option value="Available">Available</option>
                                <option value="Out of Stock">Out of Stock</option>
                                <option value="Closed">Closed</option>
                                <option value="Pending">Pending</option>
                            </select>
                            <InputError :message="form.errors.prod_status" class="mt-2" />
                        </div>

                        <div>
                            <InputLabel for="prod_condition" value="Condition" />
                            <select id="prod_condition" v-model="form.prod_condition"
                                class="mt-1 block w-full text-gray-400 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50">
                                <option value="" selected>Select condition</option>
                                <option value="New">New</option>
                                <option value="Used - like new">Used - Like new</option>
                                <option value="Used - like good">Used - Like good</option>
                                <option value="Used - like fair">Used - Like fair</option>
                            </select>
                            <InputError :message="form.errors.prod_condition" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <InputLabel for="prod_description" value="Description" />
                        <TextArea id="prod_description" v-model="form.prod_description" class="mt-1 block w-full"
                            rows="3" placeholder="Description"></TextArea>
                        <InputError :message="form.errors.prod_description" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="prod_quantity" value="Quantity" />
                        <TextInput id="prod_quantity" v-model="form.prod_quantity" type="number"
                            class="mt-1 block w-full" placeholder="Quantity" />
                        <InputError :message="form.errors.prod_quantity" class="mt-2" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <Link :href="route('products.show', product.id)"
                            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800"
                            href="#">
                        Cancel
                        </Link>
                        <SecondaryButton class="ms-3" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing" type="submit">
                            Update Product
                        </SecondaryButton>
                    </div>
                </form>
            </div>
        </Modal>
    </div>
</template>
