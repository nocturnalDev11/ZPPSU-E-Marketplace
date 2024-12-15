<script setup>
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import TextArea from '@/Components/TextArea.vue'
import { useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const form = useForm({
    prod_picture: null,
    prod_name: '',
    prod_price: '',
    prod_status: '',
    prod_category: '',
    prod_condition: '',
    prod_description: '',
    prod_quantity: '',
});

const imagePreview = ref(null);
const fileName = ref("No file chosen");

const handleImageUpload = (event) => {
    const file = event.target.files[0];
    form.prod_picture = file;
    if (file) {
        fileName.value = file.name;
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const triggerFileInput = () => {
    document.getElementById("prod_picture").click();
};

const wordCount = computed(() => {
    return form.prod_description.trim().split(/\s+/).length;
});

const submitProduct = () => {
    form.post(route('products.store'), {
        onSuccess: () => {
            closeModal();
            form.reset();
        },
    });
};

const showCreateModal = ref(false);

const closeModal = () => {
    showCreateModal.value = false;
    form.clearErrors();
    form.reset();
};
</script>

<template>
    <div>
        <!-- Button to open modal -->
        <SecondaryButton @click="showCreateModal = true">
            <slot />
        </SecondaryButton>

        <!-- Modal for creating a new product -->
        <Modal :show="showCreateModal" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 pb-3">Create New Product</h2>

                <form @submit.prevent="submitProduct" class="space-y-4">
                    <!-- Product Name -->
                    <div>
                        <InputLabel for="prod_name" value="Product Name" />
                        <TextInput id="prod_name" v-model="form.prod_name" class="mt-1 block w-full"
                            placeholder="Product Name" />
                        <InputError :message="form.errors.prod_name" class="mt-2" />
                    </div>

                    <!-- Product Picture with Preview -->
                    <div>
                        <InputLabel value="Product Image" />

                        <!-- Hidden File Input -->
                        <input type="file" id="prod_picture" @change="handleImageUpload" class="hidden" />

                        <!-- Custom Button and Filename Display -->
                        <div class="flex items-center space-x-4 mt-1">
                            <button type="button" @click="triggerFileInput"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700">
                                Choose File
                            </button>
                            <span class="text-gray-600">{{ fileName }}</span>
                        </div>

                        <InputError :message="form.errors.prod_picture" class="mt-2" />

                        <!-- Image Preview -->
                        <div v-if="imagePreview" class="mt-4">
                            <img :src="imagePreview" alt="Image Preview" class="w-32 h-32 object-cover rounded-md" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- Product Price -->
                        <div>
                            <InputLabel for="prod_price" value="Product Price" />
                            <TextInput id="prod_price" v-model="form.prod_price" type="number" class="mt-1 block w-full"
                                placeholder="Price" />
                            <InputError :message="form.errors.prod_price" class="mt-2" />
                        </div>

                        <!-- Product Category -->
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

                        <!-- Product Status -->
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

                        <!-- Product Condition -->
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

                    <!-- Product Description -->
                    <div>
                        <InputLabel for="prod_description" value="Description" />
                        <TextArea id="prod_description" v-model="form.prod_description" class="mt-1 block w-full"
                            rows="3" placeholder="Description"></textarea>
                        <InputError :message="form.errors.prod_description" class="mt-2" />

                        <div :class="{
                            'text-red-500': wordCount < 10,
                            'text-green-500': wordCount >= 10
                        }" class="text-sm mt-1">
                            <span v-if="wordCount < 10">You need at least 20 words. (Current: {{ wordCount }})</span>
                            <span v-else>Looks good! You have typed {{ wordCount }} words.</span>
                        </div>
                    </div>

                    <!-- Product Quantity -->
                    <div>
                        <InputLabel for="prod_quantity" value="Quantity" />
                        <TextInput id="prod_quantity" v-model="form.prod_quantity" type="number"
                            class="mt-1 block w-full" placeholder="Quantity" />
                        <InputError :message="form.errors.prod_quantity" class="mt-2" />
                    </div>

                    <!-- Submit and Cancel buttons -->
                    <div class="mt-6 flex justify-end">
                        <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                        <SecondaryButton class="ms-3" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing" type="submit">
                            Create Product
                        </SecondaryButton>
                    </div>
                </form>
            </div>
        </Modal>
    </div>
</template>
