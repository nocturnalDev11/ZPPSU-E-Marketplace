<script setup>
import { ref } from 'vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import AuthUsersLayout from '@/Layouts/AuthUsersLayout.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import TextArea from '@/Components/TextArea.vue';

const props = defineProps({
    post: Object,
});

const form = useForm({
    post_picture: null,
    post_title: props.post.post_title,
    post_list_type: props.post.post_list_type,
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
        post_content: form.post_content,
    })
};

</script>

<template>

    <Head title="Edit service" />

    <AuthUsersLayout>
        <div class="min-h-screen flex flex-col items-center justify-center px-4">
            <div class="max-w-2xl w-full">
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
        </div>
    </AuthUsersLayout>

</template>
