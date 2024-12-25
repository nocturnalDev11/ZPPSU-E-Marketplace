<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthLayout from '@/Layouts/AuthLayout.vue';

const form = useForm({ email: '' });

const submit = () => {
    form.post(route('send.credentials'));
};
</script>

<template>
    <AuthLayout>

        <Head title="Verification" />

        <form @submit.prevent="submit">
            <div class="text-center mb-6 text-gray-800 dark:text-white">
                <h3 class="text-3xl font-extrabold">Verification</h3>
                <span class="italic text-sm text-gray-500 dark:text-gray-300">For new ZPPSU community members</span>
            </div>

            <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                <p v-if="form.recentlySuccessful" class="py-4 text-sm text-green-500 dark:text-green-400">
                    Verification sent. Check your email.
                </p>
            </Transition>

            <InputLabel for="email" value="Email verification" />
            <div class="flex items-center relative">
                <TextInput v-model="form.email" type="email" id="email" name="email" required autocomplete="email"
                    autofocus placeholder="Enter your registered email address" class="mt-1 block w-full" />
            </div>
            <Transition enter-active-class="transition ease-in-out duration-300" enter-from-class="opacity-0"
                leave-active-class="transition ease-in-out duration-300" leave-to-class="opacity-0">
                <p v-if="form.errors.email" class="py-4 text-sm text-red-500 dark:text-red-400">
                    {{ form.errors.email }}
                </p>
            </Transition>


            <div class="mt-4 flex items-center justify-between">
                <Link :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800">
                Already a member?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Verify
                </PrimaryButton>
            </div>
        </form>
    </AuthLayout>
</template>
