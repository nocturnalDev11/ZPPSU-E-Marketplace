<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
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
    post_title: props.post.post_title || '',
    post_list_type: props.post.post_list_type || '',
    post_content: props.post.post_content || '',
});

const updatePost = () => {
    form.put(route('posts.update', props.post.id), {
        onSuccess: () => {
            console.log('Post updated successfully');
            form.reset();
        },
        onError: (errors) => {
            console.error('Error updating post:', errors);
        },
    });
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
                        <InputLabel for="post_title" value="Title" />
                        <TextInput id="post_title" v-model="form.post_title" class="mt-1 block w-full"
                            placeholder="Title" />
                        <InputError :message="form.errors.post_title" class="mt-2" />
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
                            Update post
                        </SecondaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthUsersLayout>

</template>
