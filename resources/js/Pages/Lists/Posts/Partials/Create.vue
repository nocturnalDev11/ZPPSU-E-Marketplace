<script setup>
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import TextArea from '@/Components/TextArea.vue'
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const showCreateModal = ref(false);

const form = useForm({
    post_title: '',
    post_picture: null,
    post_list_type: '',
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
        <SecondaryButton @click="showCreateModal = true">Add New Post</SecondaryButton>

        <Modal :show="showCreateModal" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 pb-3">Create New Post</h2>

                <form @submit.prevent="submitPost" class="space-y-4">
                    <div>
                        <InputLabel for="post_title" value="Title" />
                        <TextInput id="post_title" v-model="form.post_title" class="mt-1 block w-full"
                            placeholder="Title" />
                        <InputError :message="form.errors.post_title" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel value="Post image" />

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
                        <InputLabel for="post_list_type" value="Category" />
                        <select id="post_list_type" v-model="form.post_list_type"
                            class="mt-1 block w-full text-gray-400 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50">
                            <option value="" selected>Select type</option>
                            <option value="Apparel">Products</option>
                            <option value="School supplies">Services</option>
                            <option value="Footwares">Tradings</option>
                        </select>
                        <InputError :message="form.errors.post_list_type" class="mt-2" />
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
