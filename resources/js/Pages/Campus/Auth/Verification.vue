<script setup>
import InputLabel from '../../../Components/InputLabel.vue';
import PrimaryButton from '../../../Components/PrimaryButton.vue';
import InputError from '../../../Components/InputError.vue';
import TextInput from '../../../Components/TextInput.vue';
import AuthGuestLayout from '../../../Layouts/AuthGuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

// Initialize the form
const form = useForm({ email: '' });

const submitForm = () => {
    form.post(route('send.credentials'));
};
</script>

<template>

    <Head title="Campus user verification" />

    <AuthGuestLayout>
        <!-- Form -->
        <div class="flex items-center justify-center min-h-screen">
            <form @submit.prevent="submitForm"
                class="max-w-md w-full bg-white p-6 rounded-lg shadow-md dark:bg-gray-800">
                <div class="text-center mb-8 text-gray-800 dark:text-white">
                    <h3 class="text-3xl font-extrabold">Verification</h3>
                    <span class="italic text-sm text-gray-500 dark:text-gray-300">For new ZPPSU community members</span>
                </div>
                <InputLabel for="email" value="Email verification" />
                <div class="flex items-center relative">
                    <TextInput v-model="form.email" type="email" id="email" name="email" required autocomplete="email"
                        autofocus placeholder="Enter your registered email address" class="mt-1 block w-full" />
                </div>
                <div class="mt-4 flex items-center justify-between">
                    <Link :href="route('campus.login')"
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800">
                    Already a member?
                    </Link>

                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Verify
                    </PrimaryButton>
                </div>

                <InputError class="mt-2" :message="form.errors.email" />
            </form>
        </div>
    </AuthGuestLayout>
</template>
