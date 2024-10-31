<script setup>
import { ref } from 'vue';
import AuthGuestLayout from '../../../Layouts/AuthGuestLayout.vue';
import Checkbox from '../../../Components/Checkbox.vue';
import InputError from '../../../Components/InputError.vue';
import InputLabel from '../../../Components/InputLabel.vue';
import PrimaryButton from '../../../Components/PrimaryButton.vue';
import TextInput from '../../../Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const showPassword = ref(false);

function togglePassword() {
    showPassword.value = !showPassword.value;
}

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('external.login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <Head title="External Users Login" />

    <AuthGuestLayout>
        <div class="flex items-center justify-center min-h-screen">
            <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit" class="max-w-md w-full bg-white p-6 rounded-lg shadow-md dark:bg-gray-800">
                <div class="text-center mb-8 text-gray-800 dark:text-white">
                    <h3 class="text-3xl font-extrabold">
                        Sign in
                    </h3>
                </div>

                <div class="space-y-4">
                    <!-- Login ID Field -->
                    <div>
                        <InputLabel for="email" value="Email" />
                        <div class="relative flex items-center">
                            <TextInput v-model="form.email" type="text" id="email" required autofocus
                                class="mt-1 block w-full" autocomplete="email" />
                            <svg class="w-4 h-4 absolute right-4 dark:text-gray-100" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M14 14.252V16.3414C13.3744 16.1203 12.7013 16 12 16C8.68629 16 6 18.6863 6 22H4C4 17.5817 7.58172 14 12 14C12.6906 14 13.3608 14.0875 14 14.252ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11ZM18 17V13.5L23 18L18 22.5V19H15V17H18Z">
                                </path>
                            </svg>
                        </div>
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <!-- Password Field with Toggle Visibility -->
                    <div>
                        <InputLabel for="password" value="Password" />
                        <div class="relative flex items-center">
                            <TextInput id="password" v-model="form.password" :type="showPassword ? 'text' : 'password'"
                                required autofocus autocomplete="current-password" class="mt-1 block w-full" />
                            <svg @click="togglePassword"
                                class="w-4 h-4 absolute right-4 cursor-pointer dark:text-gray-100"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3ZM12.0003 19C16.2359 19 19.8603 16.052 20.7777 12C19.8603 7.94803 16.2359 5 12.0003 5C7.7646 5 4.14022 7.94803 3.22278 12C4.14022 16.052 7.7646 19 12.0003 19ZM12.0003 16.5C9.51498 16.5 7.50026 14.4853 7.50026 12C7.50026 9.51472 9.51498 7.5 12.0003 7.5C14.4855 7.5 16.5003 9.51472 16.5003 12C16.5003 14.4853 14.4855 16.5 12.0003 16.5ZM12.0003 14.5C13.381 14.5 14.5003 13.3807 14.5003 12C14.5003 10.6193 13.381 9.5 12.0003 9.5C10.6196 9.5 9.50026 10.6193 9.50026 12C9.50026 13.3807 10.6196 14.5 12.0003 14.5Z">
                                </path>
                            </svg>
                        </div>
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <label class="flex items-center">
                            <Checkbox name="remember" v-model:checked="form.remember" />
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-8">
                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Log in
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </AuthGuestLayout>
</template>
