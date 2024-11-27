<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
    name: '',
    email: '',
    gender: '',
    home_address: '',
    login_id: '',
    department: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('users.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
        onSuccess: () => {
            closeModal();
            form.reset();
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
        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14" />
            <path d="M12 5v14" />
        </svg>
        Add user
    </SecondaryButton>

    <Modal :show="showModal" @close="closeModal">
        <div class="p-6">
            <form @submit.prevent="submit" class="space-y-4">
                <div class="text-center mb-8 text-gray-800 dark:text-white">
                    <h3 class="text-3xl font-extrabold">
                        Create user
                    </h3>
                </div>
                <div class="mt-4">
                    <InputLabel for="name" value="Name" />
                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                        autocomplete="name" />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="email" value="Email" />

                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                        autocomplete="username" />

                    <InputError class="mt-2" :message="form.errors.email" />
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

                <div class="mt-4">
                    <InputLabel for="home_address" value="Home address" />

                    <TextInput id="home_address" type="text" class="mt-1 block w-full" v-model="form.home_address"
                        required autocomplete="home_address" />

                    <InputError class="mt-2" :message="form.errors.home_address" />
                </div>

                <div class="mt-4">
                    <InputLabel for="login_id" value="School ID" />

                    <TextInput id="login_id" type="text" class="mt-1 block w-full" v-model="form.login_id" required
                        autocomplete="login_id" />

                    <InputError class="mt-2" :message="form.errors.login_id" />
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

                <div class="mt-4">
                    <InputLabel for="password" value="Password" />

                    <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                        autocomplete="new-password" />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Confirm Password" />

                    <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                        v-model="form.password_confirmation" required autocomplete="new-password" />

                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <div class="mt-4 flex items-center justify-end">
                    <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Add user
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </Modal>
</template>
