<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthAdminLayout from '@/Layouts/AuthAdminLayout.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    user: Object,
});

const form = useForm({
    name: props.user.name || '',
    dob: props.user.dob || '',
    gender: props.user.gender || '',
    home_address: props.user.home_address || '',
    email: props.user.email || '',
});

const updateUser = () => {
    form.put(route('user.update', props.user.id), {
        onSuccess: () => {
            console.log('User updated successfully');
            form.reset();
        },
        onError: (errors) => {
            console.error('Error updating user:', errors);
        },
    });
};

</script>

<template>

    <Head title="Edit user" />

    <AuthAdminLayout>
        <div class="min-h-screen flex flex-col items-center justify-center px-4">
            <div class="max-w-2xl w-full">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 pb-3">Edit User</h2>

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
                        <InputLabel for="email" value="Email" />
                        <TextInput id="email" v-model="form.email" class="mt-1 block w-full" />
                        <InputError :message="form.errors.email" class="mt-2" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <Link :href="route('all.users', user.id)"
                            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800">
                        Cancel
                        </Link>
                        <SecondaryButton class="ms-3" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing" type="submit">
                            Update user
                        </SecondaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthAdminLayout>
</template>
