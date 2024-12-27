<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const form = useForm({
    profile_picture: null,
});

const showCreateModal = ref(false);
const uploadedFilePreview = ref(null);

const handleFileUpload = (event) => {
    const file = event.target.files[0];
    form.profile_picture = file;
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            uploadedFilePreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const clearFile = () => {
    uploadedFilePreview.value = null;
};

const submit = () => {
    form.post(route('profile.update.picture'), {
        onSuccess: () => {
            alert("Profile picture updated successfully!");
            closeModal();
            form.reset();
        },
        onError: () => {
            alert("Failed to update profile picture. Please try again.");
        },
    });
};

// Closes the modal
const closeModal = () => {
    showCreateModal.value = false;
    form.clearErrors();
    form.reset();
};
</script>

<template>
    <div>
        <SecondaryButton @click="showCreateModal = true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path d="M12 9a3.75 3.75 0 1 0 0 7.5A3.75 3.75 0 0 0 12 9Z" />
                <path fill-rule="evenodd"
                    d="M9.344 3.071a49.52 49.52 0 0 1 5.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 0 1-3 3h-15a3 3 0 0 1-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 0 0 1.11-.71l.822-1.315a2.942 2.942 0 0 1 2.332-1.39ZM6.75 12.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Zm12-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                    clip-rule="evenodd" />
            </svg>
        </SecondaryButton>

        <Modal :show="showCreateModal" @close="closeModal" aria-labelledby="modal-title">
            <div class="p-6">
                <h2 id="modal-title" class="text-lg font-medium text-gray-900 dark:text-gray-100 pb-3">
                    Upload profile picture
                </h2>

                <form @submit.prevent="submit">
                    <div>
                        <div class="flex items-center gap-4 mt-4">
                            <template v-if="uploadedFilePreview">
                                <div class="w-20 h-20">
                                    <img :src="uploadedFilePreview" alt="Uploaded File Preview"
                                        class="w-full h-full object-cover rounded-full" />
                                </div>
                            </template>

                            <label v-if="!uploadedFilePreview" for="file-input"
                                class="flex justify-center items-center w-20 h-20 border-2 border-dotted border-gray-300 text-gray-400 cursor-pointer rounded-full hover:bg-gray-50 dark:border-neutral-700 dark:text-neutral-600 dark:hover:bg-neutral-700/50">
                                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-label="Upload Icon">
                                    <circle cx="12" cy="12" r="10" stroke-width="1.5" />
                                    <circle cx="12" cy="10" r="3" stroke-width="1.5" />
                                    <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662" stroke-width="1.5" />
                                </svg>
                                <input id="file-input" ref="fileInput" type="file" class="hidden" accept="image/*"
                                    @change="handleFileUpload" />
                            </label>

                            <div>
                                <DangerButton v-if="uploadedFilePreview" type="button"
                                    @click="clearFile">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-6">
                                        <path fill-rule="evenodd"
                                            d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </DangerButton>
                            </div>
                        </div>
                    </div>


                    <div class="mt-6">
                        <SecondaryButton type="submit" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300 dark:bg-blue-800 dark:hover:bg-blue-700 dark:focus:ring-blue-600">
                            Submit
                        </SecondaryButton>
                    </div>
                </form>
            </div>
        </Modal>
    </div>
</template>
