<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import TextArea from '@/Components/TextArea.vue'
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const showCreateModal = ref(false);

const form = useForm({
    post_picture: null,
    post_title: '',
    post_list_type: '',
    post_category: '',
    post_status: '',
    post_content: '',
});

const imagePreview = ref(null);
const fileName = ref("No file chosen");

const handleImageUpload = (event) => {
    const file = event.target.files[0];
    form.post_picture = file;
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
    document.getElementById("post_picture").click();
};

const submitPost = () => {
    form.post(route('posts.store'), {
        onSuccess: () => {
            closeModal();
            form.reset();
        },
    });
};

const closeModal = () => {
    showCreateModal.value = false;
    form.clearErrors();
    form.reset();
};
</script>

<template>
    <div>
        <SecondaryButton @click="showCreateModal = true">
            <svg class="mr-2 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd"></path>
            </svg>
            Add posts
        </SecondaryButton>

        <Modal :show="showCreateModal" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 pb-3">Create New Post</h2>

                <form @submit.prevent="submitPost" class="space-y-4">
                    <div>
                        <InputLabel value="Upload image" />

                        <!-- Hidden File Input -->
                        <input type="file" id="post_picture" @change="handleImageUpload" class="hidden" />

                        <!-- Custom Button and Filename Display -->
                        <div class="flex items-center space-x-4 mt-1">
                            <button type="button" @click="triggerFileInput"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700">
                                Choose File
                            </button>
                            <span class="text-gray-600">{{ fileName }}</span>
                        </div>

                        <InputError :message="form.errors.post_picture" class="mt-2" />

                        <!-- Image Preview -->
                        <div v-if="imagePreview" class="mt-4">
                            <img :src="imagePreview" alt="Image Preview" class="w-32 h-32 object-cover rounded-md" />
                        </div>
                    </div>

                    <div>
                        <InputLabel for="post_title" value="Title" />
                        <TextInput id="post_title" v-model="form.post_title" class="mt-1 block w-full"
                            placeholder="Title" />
                        <InputError :message="form.errors.post_title" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="post_list_type" value="List type" />
                        <select id="post_list_type" v-model="form.post_list_type"
                            class="mt-1 block w-full text-gray-400 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50">
                            <option value="" selected>Select type</option>
                            <option value="Products">Products</option>
                            <option value="Services">Services</option>
                            <option value="Tradings">Tradings</option>
                        </select>
                        <InputError :message="form.errors.post_list_type" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="post_category" value="Category" />
                        <select id="post_category" v-model="form.post_category"
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
                            <option value="Tutoring services">Tutoring services</option>
                            <option value="Video editing">Video editing</option>
                            <option value="Photo editing">Photo editing</option>
                            <option value="Videography">Videography</option>
                            <option value="Photography">Photography</option>
                            <option value="Writing">Writing</option>
                            <option value="Coding services">Coding services</option>
                            <option value="Drawing">Drawing</option>
                            <option value="Painting">Painting</option>
                            <option value="Catering">Catering</option>
                            <option value="Troubleshooting">Troubleshooting</option>
                            <option value="Project assistance">Project assistance</option>
                            <option value="Repair services">Repair services</option>
                            <option value="House cleaning services">House cleaning services</option>
                            <option value="Others">Others</option>
                        </select>
                        <InputError :message="form.errors.post_category" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="post_status" value="Status" />
                        <select id="post_status" v-model="form.post_status"
                            class="mt-1 block w-full text-gray-400 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50">
                            <option value="" selected>Select status</option>
                            <option value="Searching for products">Urgent</option>
                            <option value="Searching for services">Needed Soon</option>
                            <option value="Searching for trades">Flexible</option>
                            <option value="Discontinued">Discontinued</option>
                            <option value="Closed">Closed</option>
                        </select>
                        <InputError :message="form.errors.post_status" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="post_content" value="Description" />
                        <TextArea id="post_content" v-model="form.post_content" class="mt-1 block w-full" rows="3"
                            placeholder="Description"></textarea>
                        <InputError :message="form.errors.post_content" class="mt-2" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                        <SecondaryButton class="ms-3" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing" type="submit">
                            Create post
                        </SecondaryButton>
                    </div>
                </form>
            </div>
        </Modal>
    </div>
</template>
