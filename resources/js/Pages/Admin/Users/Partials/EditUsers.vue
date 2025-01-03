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
    email: props.user.email || '',
});

const updateUser = () => {
    form.post(route('user.update', props.user.id), {
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
                    <InputLabel for="email" value="Email" />
                    <TextInput id="email" v-model="form.email" class="mt-1 block w-full" />
                    <InputError :message="form.errors.email" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <Link :href="route('all.users', user.id)"
                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800">
                    Cancel
                    </Link>
                    <SecondaryButton class="ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        type="submit">
                        Update user
                    </SecondaryButton>
                </div>
            </form>
        </div>
    </Modal>
</template>
