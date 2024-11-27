<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import CreateUsers from '../Partials/Users/CreateUsers.vue';
import DeleteUsers from '../Partials/Users/DeleteUsers.vue';
import AuthAdminLayout from '@/Layouts/AuthAdminLayout.vue';

const props = defineProps({
    users: {
        type: Array,
        default: () => [],
    },
});

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    });
}

const searchTerm = ref('');

const searchedUsers = computed(() => {
    if (!searchTerm.value) return props.users;
    return props.users.filter(user =>
        user.name.toLowerCase().includes(searchTerm.value.toLowerCase())
    );
});

</script>

<template>

    <Head title="All users" />

    <AuthAdminLayout>
        <!-- Table Section -->
        <div class="max-w-[85rem] px-4 py-14 sm:px-6 lg:px-8 lg:py-24 mx-auto">
            <!-- Card -->
            <div class="flex flex-col">
                <div class="-m-1.5 custom-scrollbar overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div
                            class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-gray-800 dark:border-gray-700">
                            <!-- Header -->
                            <div
                                class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-gray-700">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                                        Users
                                    </h2>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        Add users, edit and more.
                                    </p>
                                </div>

                                <div>
                                    <div class="inline-flex items-center gap-x-2">
                                        <form class="inline-flex mb-4 sm:pr-3 sm:mb-0">
                                            <label for="users-search" class="sr-only">Search</label>
                                            <div class="relative mt-1 sm:w-64 xl:w-96">
                                                <input type="text" id="users-search" v-model="searchTerm"
                                                    placeholder="Search for users"
                                                    class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-900/50 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50" />
                                            </div>
                                        </form>

                                        <CreateUsers />
                                    </div>
                                </div>
                            </div>
                            <!-- End Header -->

                            <!-- Table -->
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th scope="col" class="ps-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                                    Name
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                                    Role
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                                    Home address
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                                    Contact number
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                                    Created
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-end"></th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <template v-if="searchedUsers.length > 0">
                                        <tr v-for="user in searchedUsers" :key="user.id">
                                            <td class="size-px whitespace-nowrap">
                                                <div class="ps-6 lg:ps-3 xl:ps-4 pe-6 py-3">
                                                    <div class="flex items-center gap-x-3">
                                                        <div
                                                            class="flex-shrink-0 relative inline-flex items-center justify-center rounded-full shadow-lg shadow-indigo-300 dark:shadow-indigo-800/70 overflow-hidden bg-indigo-400 dark:bg-indigo-600 w-10 h-10">
                                                            <span
                                                                class="p-2 font-medium text-lg text-gray-300 dark:text-gray-100">
                                                                {{ user.name.charAt(0).toUpperCase() || '?' }}
                                                            </span>
                                                        </div>
                                                        <div class="grow">
                                                            <Link :href="route('profile.show', user.id)"
                                                                class="block text-sm font-semibold text-gray-800 dark:text-gray-200 hover:underline">
                                                            {{ user.name }}
                                                            </Link>
                                                            <span
                                                                class="block text-sm text-gray-500 dark:text-gray-500">
                                                                {{ user.email }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="h-px w-72 whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span
                                                        class="block text-sm font-semibold text-gray-800 dark:text-gray-200">
                                                        {{ user.role.name.replace('_', ' ').replace(/^\w/, c =>
                                                        c.toUpperCase()) }}
                                                    </span>
                                                    <span v-if="user.role_id === 2"
                                                        class="block text-sm text-gray-500 dark:text-gray-500">
                                                        {{ user.department }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span v-if="user.home_address"
                                                        class="block text-sm text-gray-800 dark:text-gray-200">
                                                        {{ user.home_address }}
                                                    </span>
                                                    <span v-else
                                                        class="block text-sm text-gray-500 dark:text-gray-400 italic">
                                                        NULL
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span v-if="user.contact_number"
                                                        class="block text-sm text-gray-800 dark:text-gray-200">
                                                        {{ user.contact_number }}
                                                    </span>
                                                    <span v-else
                                                        class="block text-sm text-gray-500 dark:text-gray-400 italic">
                                                        NULL
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span class="text-sm text-gray-500 dark:text-gray-500">
                                                        {{ formatDate(user.created_at) }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="flex gap-x-5 px-6 py-1.5">
                                                    <Link
                                                        class="flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500"
                                                        :href="route('users.edit', user.id)">
                                                    Edit
                                                    </Link>

                                                    <DeleteUsers :userId="user.id" />
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                    <template v-else>
                                        <tr>
                                            <td colspan="100%">
                                                <div class="flex justify-center items-center h-full py-5">
                                                    <span class="text-gray-700 dark:text-gray-400 italic">
                                                        No users found.
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                            <!-- End Table -->

                            <!-- Footer -->
                            <div
                                class="px-6 py-4 grid gap-3 md:flex md:justify-end md:items-center border-t border-gray-200 dark:border-gray-700">
                                <div>
                                    <div class="inline-flex gap-x-2">
                                        <button type="button"
                                            class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-800 dark:focus:bg-gray-800">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m15 18-6-6 6-6" />
                                            </svg>
                                            Prev
                                        </button>

                                        <button type="button"
                                            class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-800 dark:focus:bg-gray-800">
                                            Next
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m9 18 6-6-6-6" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthAdminLayout>
</template>
