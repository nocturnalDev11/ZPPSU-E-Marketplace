<script setup>
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import TextArea from '@/Components/TextArea.vue'
import { useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const showCreateModal = ref(false);

const form = useForm({
    services_picture: null,
    services_title: '',
    services_status: '',
    services_fee: '',
    services_category: '',
    services_description: '',
});

const imagePreview = ref(null);
const fileName = ref("No file chosen");

const handleImageUpload = (event) => {
    const file = event.target.files[0];
    form.services_picture = file;
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
    document.getElementById("services_picture").click();
};

const wordCount = computed(() => {
    return form.services_description.trim().split(/\s+/).length;
});

const submitService = () => {
    form.post(route('services.store'), {
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
            <slot />
        </SecondaryButton>
        <!-- Modal for creating a new product -->
        <Modal :show="showCreateModal" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 pb-3">Create New Service</h2>

                <form @submit.prevent="submitService" class="space-y-4">
                    <div>
                        <InputLabel for="services_title" value="Services title" />
                        <TextInput id="services_title" v-model="form.services_title" class="mt-1 block w-full"
                            placeholder="Services title" />
                        <InputError :message="form.errors.services_title" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel value="Services Image" />

                        <input type="file" id="services_picture" @change="handleImageUpload" class="hidden" />

                        <div class="flex items-center space-x-4 mt-1">
                            <button type="button" @click="triggerFileInput"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700">
                                Choose File
                            </button>
                            <span class="text-gray-600">{{ fileName }}</span>
                        </div>

                        <InputError :message="form.errors.services_picture" class="mt-2" />

                        <div v-if="imagePreview" class="mt-4">
                            <img :src="imagePreview" alt="Image Preview" class="w-32 h-32 object-cover rounded-md" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <InputLabel for="services_status" value="Status" />
                            <select id="services_status" v-model="form.services_status"
                                class="mt-1 block w-full text-gray-400 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50">
                                <option value="" selected>Select status</option>
                                <option value="Available">Available</option>
                                <option value="Discontinued">Discontinued</option>
                                <option value="Closed">Closed</option>
                            </select>
                            <InputError :message="form.errors.services_status" class="mt-2" />
                        </div>

                        <div>
                            <InputLabel for="services_fee" value="Fee" />
                            <TextInput id="services_fee" v-model="form.services_fee" type="number"
                                class="mt-1 block w-full" placeholder="Fee" />
                            <InputError :message="form.errors.services_fee" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <InputLabel for="services_category" value="Category" />
                        <select id="services_category" v-model="form.services_category"
                            class="mt-1 block w-full text-gray-400 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50">
                            <option value="" selected>Select category</option>
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
                        <InputError :message="form.errors.services_category" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="services_description" value="Description" />
                        <TextArea id="services_description" v-model="form.services_description"
                            class="mt-1 block w-full" rows="3" placeholder="Description"></textarea>
                        <InputError :message="form.errors.services_description" class="mt-2" />

                        <div :class="{
                            'text-red-500': wordCount < 10,
                            'text-green-500': wordCount >= 10
                        }" class="text-sm mt-1">
                            <span v-if="wordCount < 10">You need at least 10 words. (Current: {{ wordCount }})</span>
                            <span v-else>Looks good! You have typed {{ wordCount }} words.</span>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                        <SecondaryButton class="ms-3" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing" type="submit">
                            Create Service
                        </SecondaryButton>
                    </div>
                </form>
            </div>
        </Modal>
    </div>
</template>
