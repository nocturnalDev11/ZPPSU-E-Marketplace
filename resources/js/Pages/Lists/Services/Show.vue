<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AuthUsersLayout from '../../../Layouts/AuthUsersLayout.vue';
import SecondaryButton from '../../../Components/SecondaryButton.vue';

const props = defineProps({
    service: {
        type: Object,
        required: true
    },
    relatedServices: Array,
});

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });
}

</script>

<template>

    <Head :title="service.services_title" />

    <AuthUsersLayout>
        <!-- Blog Article -->
        <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="grid lg:grid-cols-3 gap-y-8 lg:gap-y-0 lg:gap-x-6">
                <!-- Content -->
                <div class="lg:col-span-2">
                    <div class="lg:pe-8">
                        <div class="space-y-5 lg:space-y-8">
                            <Link :href="route('services.index')"
                                class="inline-flex items-center gap-x-1.5 text-sm text-gray-600 decoration-2 hover:underline focus:outline-none focus:underline dark:text-blue-500">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="m15 18-6-6 6-6" />
                            </svg>
                            Back to services list
                            </Link>

                            <h2 class="text-3xl font-bold lg:text-5xl dark:text-white">
                                {{ service.services_title }}
                            </h2>

                            <div class="flex items-center gap-x-5">
                                <a class="inline-flex items-center gap-1.5 py-1 px-3 sm:py-2 sm:px-4 rounded-full text-xs sm:text-sm bg-cyan-100 text-cyan-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 dark:bg-sky-950 dark:text-neutral-200 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                    href="#">
                                    {{ service.services_category }}
                                </a>
                                <p class="text-xs sm:text-sm text-gray-500 dark:text-neutral-200">{{
                                    formatDate(service.created_at) }}</p>
                            </div>

                            <figure
                                class="sm:h-[450px] bg-white shadow-lg shadow-gray-300 dark:shadow-none dark:bg-gray-800 rounded-lg">
                                <img class="w-full max-h-full object-contain object-top rounded-xl"
                                    :src="service.services_picture" alt="Blog Image">
                            </figure>

                            <div class="space-y-3">
                                <h3 class="text-2xl font-semibold dark:text-white">Service description</h3>

                                <p class="text-lg text-gray-800 dark:text-neutral-200 whitespace-pre-line">{{
                                    service.services_description
                                    }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Content -->

                <!-- Sidebar -->
                <div class="lg:col-span-1 lg:w-full lg:h-full">
                    <div class="sticky top-0 start-0 py-8 lg:ps-8">
                        <!-- Avatar Media -->
                        <div
                            class="group flex items-center gap-x-3 border-b border-gray-200 pb-8 mb-8 dark:border-neutral-700">
                            <a class="block shrink-0 focus:outline-none" href="#">
                                <img class="size-10 rounded-full"
                                    src="https://images.unsplash.com/photo-1669837401587-f9a4cfe3126e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
                                    alt="Avatar">
                            </a>

                            <a class="group grow block focus:outline-none" href="">
                                <h5
                                    class="group-hover:text-gray-600 group-focus:text-gray-600 text-sm font-semibold text-gray-800 dark:group-hover:text-neutral-400 dark:group-focus:text-neutral-400 dark:text-neutral-200">
                                    {{ service.user.name }}
                                </h5>
                                <p v-if="$page.props.service.user.role_id === 2"
                                    class="text-sm text-gray-500 dark:text-neutral-500">
                                    {{ service.user.department }} department
                                </p>
                                <p v-else-if="$page.props.service.user.role_id === 3"
                                    class="text-sm text-gray-500 dark:text-neutral-500">
                                    {{ service.user.email }}
                                </p>
                            </a>

                            <div class="grow">
                                <div class="flex justify-end">
                                    <SecondaryButton class="inline-flex items-center gap-2">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                                        </svg>
                                        Message
                                    </SecondaryButton>
                                </div>
                            </div>
                        </div>
                        <!-- End Avatar Media -->

                        <div class="space-y-6">
                            <h3 class="text-2xl font-semibold dark:text-white">Related Services</h3>
                            <!-- Related services (based on category) -->
                            <Link :href="route('services.show', relatedService.id)"
                                v-for="relatedService in relatedServices" :key="relatedService.id"
                                class="group flex items-center gap-x-6 focus:outline-none">
                            <div class="shrink-0 relative rounded-lg overflow-hidden size-20">
                                <img v-if="relatedService.services_picture"
                                    class="size-full absolute top-0 start-0 object-cover rounded-lg"
                                    :src="relatedService.services_picture" alt="Service Image" />
                                <img v-else src="https://via.placeholder.com/320" alt="Default Image"
                                    class="size-full absolute top-0 start-0 object-cover rounded-lg" />
                            </div>

                            <div class="grow">
                                <span
                                    class="text-sm font-bold text-gray-800 group-hover:text-blue-600 group-focus:text-blue-600 dark:text-neutral-200 dark:group-hover:text-blue-500 dark:group-focus:text-blue-500">
                                    {{ relatedService.services_title }}
                                </span>
                                <br />
                                <span
                                    class="text-xs font-medium italic text-gray-800 group-hover:text-blue-600 group-focus:text-blue-600 dark:text-neutral-200 dark:group-hover:text-blue-500 dark:group-focus:text-blue-500">
                                    {{ relatedService.services_category }}
                                </span>
                            </div>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthUsersLayout>
</template>
