<script setup>
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import TextArea from '@/Components/TextArea.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const showModal = ref(false);

const props = defineProps({
    service: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    services_picture: null,
    services_title: props.service.services_title,
    services_status: props.service.services_status,
    services_fee: props.service.services_fee || 0,
    services_category: props.service.services_category,
    services_description: props.service.services_description,
});

const imagePreview = ref(props.service.services_picture);
const fileName = ref("No file chosen");

const handleImageUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        fileName.value = file.name;
        imagePreview.value = URL.createObjectURL(file);
        form.services_picture = file;
    }
};

const triggerFileInput = () => {
    document.getElementById("services_picture").click();
};

const updateService = () => {
    form.put(route('services.update', props.service.id), {
        onSuccess: () => {
            console.log('Service updated successfully');
            form.reset();
        },
        onError: (errors) => {
            console.error('Error updating service:', errors);
        },
    });

    router.post(`/services/${props.service.id}`, {
        _method: 'put',
        services_picture: form.services_picture,
        services_title: form.services_title,
        services_status: form.services_status,
        services_fee: form.services_fee,
        services_category: form.services_category,
        services_description: form.services_description,
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
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 pb-3">Edit Product</h2>

                <form @submit.prevent="updateService" class="space-y-4">
                    <div>
                        <InputLabel value="Image" />

                        <input type="file" id="services_picture" @change="handleImageUpload" class="hidden" />

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

                        <InputError :message="form.errors.services_picture" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="services_title" value="Services title" />
                        <TextInput id="services_title" v-model="form.services_title" class="mt-1 block w-full"
                            placeholder="Services title" />
                        <InputError :message="form.errors.services_title" class="mt-2" />
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
                            <option value="Others">Others</option>
                        </select>
                        <InputError :message="form.errors.services_category" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="services_description" value="Description" />
                        <TextArea id="services_description" v-model="form.services_description"
                            class="mt-1 block w-full" rows="5" placeholder="Description"></textarea>
                        <InputError :message="form.errors.services_description" class="mt-2" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <PrimaryButton @click="closeModal">Cancel</PrimaryButton>
                        <SecondaryButton class="ms-3" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing" type="submit">
                            Update Service
                        </SecondaryButton>
                    </div>
                </form>
            </div>
        </Modal>
    </div>
</template>
