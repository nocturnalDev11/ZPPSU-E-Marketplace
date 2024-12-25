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
    post: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    post_picture: null,
    post_title: props.post.post_title,
    post_list_type: props.post.post_list_type,
    post_category: props.post.post_category,
    post_status: props.post.post_status,
    post_content: props.post.post_content,
});

const imagePreview = ref(props.post.post_picture);
const fileName = ref("No file chosen");

const handleImageUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        fileName.value = file.name;
        imagePreview.value = URL.createObjectURL(file);
        form.post_picture = file;
    }
};

const triggerFileInput = () => {
    document.getElementById("post_picture").click();
};

const updatePost = () => {
    router.post(`/posts/${props.post.id}`, {
        _method: 'put',
        post_picture: form.post_picture,
        post_title: form.post_title,
        post_list_type: form.post_list_type,
        post_category: form.post_category,
        post_status: form.post_status,
        post_content: form.post_content,
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
            Edit posts
        </SecondaryButton>

        <Modal :show="showModal" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 pb-3">Edit Post</h2>

                <form @submit.prevent="updatePost" class="space-y-4">
                    <div>
                        <InputLabel value="Image" />

                        <input type="file" id="post_picture" @change="handleImageUpload" class="hidden" />

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

                        <InputError :message="form.errors.post_picture" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="post_title" value="Title" />
                        <TextInput id="post_title" v-model="form.post_title" class="mt-1 block w-full"
                            placeholder="Title" />
                        <InputError :message="form.errors.post_title" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="post_list_type" value="Category" />
                        <select id="post_list_type" v-model="form.post_list_type"
                            class="mt-1 block w-full text-gray-400 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50">
                            <option value="" disabled>Select type</option>
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
                        </select>
                        <InputError :message="form.errors.post_category" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="post_status" value="Status" />
                        <select id="post_status" v-model="form.post_status"
                            class="mt-1 block w-full text-gray-400 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50">
                            <option value="" selected>Select status</option>
                            <option value="Searching for products">Searching for products</option>
                            <option value="Searching for services">Searching for services</option>
                            <option value="Searching for trades">Searching for trades</option>
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
                            Update post
                        </SecondaryButton>
                    </div>
                </form>
            </div>
        </Modal>
    </div>
</template>
