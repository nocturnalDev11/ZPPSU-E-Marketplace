<script setup>
import GuestLayout from '../../../Layouts/GuestLayout.vue';
import InputLabel from '../../../Components/InputLabel.vue';
import TextInput from '../../../Components/TextInput.vue';
import InputError from '../../../Components/InputError.vue';
import PrimaryButton from '../../../Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { watch } from 'vue';

const form = useForm({
    name: '',
    dob: '',
    gender: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('external.signup'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

// Watch the name field for changes and capitalize each word
watch(() => form.name, (newValue) => {
    form.name = newValue.replace(/\b\w/g, char => char.toUpperCase());
});
</script>

<template>

    <Head title="Signup" />
    <GuestLayout>
        <div class="flex items-center justify-center min-h-screen">
            <form @submit.prevent="submit" class="max-w-md w-full bg-white p-6 rounded-lg shadow-md dark:bg-gray-800">
                <div class="text-center mb-8 text-gray-800 dark:text-white">
                    <h3 class="text-3xl font-extrabold">
                        Sign up
                    </h3>
                </div>
                <div class="mt-4">
                    <InputLabel for="name" value="Name" />

                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                        autocomplete="name" />

                    <InputError class="mt-2" :message="form.errors.name" />
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

                <div class="mt-4">
                    <InputLabel for="email" value="Email" />

                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                        autocomplete="username" />

                    <InputError class="mt-2" :message="form.errors.email" />
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

                <div class="mt-4 flex items-center justify-between">
                    <Link :href="route('external.login')"
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800">
                    Already registered?
                    </Link>

                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>
