<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    name: props.user.name || '',
    dob: props.user.dob || '',
    gender: props.user.gender || '',
    home_address: props.user.home_address || '',
    login_id: props.user.login_id || '',
    role_id: props.user.role_id || '',
    department: props.user.department || '',
    email: props.user.email || '',
});

const updateUser = () => {
    form.put(route('user.update', props.user.id), {
        onSuccess: () => {
            closeModal();
            form.reset();
        },
        onError: (errors) => {
            console.error('Error updating user:', errors);
        },
    });
};

watch(() => form.name, (newValue) => {
    form.name = newValue.replace(/\b\w/g, char => char.toUpperCase());
});

const showModal = ref(false);

const closeModal = () => {
    showModal.value = false;
    form.clearErrors();
    form.reset();
};

</script>

<template>
    <SecondaryButton @click="showModal = true"
        class="px-4 py-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="shrink-0 size-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
        </svg>
    </SecondaryButton>

    <Modal :show="showModal" @close="closeModal">
        <div class="p-6">
            <form @submit.prevent="updateUser" class="space-y-4">
                <div>
                    <InputLabel for="name" value="Name" />
                    <TextInput id="name" v-model="form.name" class="mt-1 block w-full" />
                    <InputError :message="form.errors.name" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="mt-4">
                        <InputLabel for="dob" value="Date of birth" />

                        <input type="date" id="dob" v-model="form.dob"
                            class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50">

                        <InputError class="mt-2" :message="form.errors.dob" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="gender" value="Gender" />

                        <select id="gender" v-model="form.gender"
                            class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50">
                            <option value="">Select gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Non-binary">Non-binary</option>
                        </select>

                        <InputError class="mt-2" :message="form.errors.gender" />
                    </div>
                </div>

                <div>
                    <InputLabel for="home_address" value="Home address" />
                    <TextInput id="home_address" v-model="form.home_address" class="mt-1 block w-full" />
                    <InputError :message="form.errors.home_address" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="login_id" value="School ID" />
                    <TextInput id="login_id" type="text" class="mt-1 block w-full" v-model="form.login_id" required
                        autocomplete="login_id" />
                    <InputError class="mt-2" :message="form.errors.login_id" />
                </div>

                <div>
                    <InputLabel for="role_id" value="Role" />

                    <select id="role_id" v-model="form.role_id"
                        class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50">
                        <option value="">Select role</option>
                        <option value="1">Student</option>
                        <option value="2">Faculty</option>
                        <option value="3">Staff</option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.role_id" />
                </div>

                <div class="mt-4">
                    <InputLabel for="department" value="Department" />

                    <select id="department" v-model="form.department"
                        class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50">
                        <option value="">Select department</option>
                        <option value="CICS">CICS</option>
                        <option value="CME">CME</option>
                        <option value="CTE">CTE</option>
                        <option value="CET">CET</option>
                        <option value="CAHSS">CAHSS</option>
                        <option value="SBA">SBA</option>
                        <option value="SHS">SHS</option>
                        <option value="DRRMO">DRRMO</option>
                        <option value="Registrar">Registrar</option>
                        <option value="Admissions Office">Admissions Office</option>
                        <option value="Guidance and Couseling">Guidance and Couseling</option>
                        <option value="Medical-Dental Health Services">Medical-Dental Health Services</option>
                        <option value="Learning Commons Center">Learning Commons Center</option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.department" />
                </div>

                <div>
                    <InputLabel for="email" value="Email" />
                    <TextInput id="email" v-model="form.email" class="mt-1 block w-full" />
                    <InputError :message="form.errors.email" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                    <PrimaryButton class="ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        type="submit">
                        Update user
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </Modal>
</template>
