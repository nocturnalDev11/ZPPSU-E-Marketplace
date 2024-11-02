<script setup>
import GuestLayout from '../../../Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    services: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>

    <Head title="All services" />
    <GuestLayout>
        <div class="grid h-full w-full grid-cols-1 gap-4 px-2 py-4 md:h-auto xl:grid-cols-5">
            <template v-if="services.length > 0">
                <div v-for="service in services" :key="service.id" class="mb-6 w-full select-none">
                    <div class="relative pb-64">
                        <div class="cursor-pointer">
                            <img class="absolute h-full w-full cursor-pointer rounded-lg border-b object-cover shadow-md"
                                :src="service.prod_picture || 'default-image-url'" alt="service name" />
                        </div>
                    </div>

                    <div class="relative -mt-16 px-4">
                        <div class="rounded-lg border bg-white shadow-lg">
                            <div class="p-5">
                                <div class="flex items-center justify-between">
                                    <div class="text-xs opacity-75">
                                        <a class="hover:underline" href="#">{{ service.prod_category }}</a>
                                    </div>

                                    <span class="select-none rounded-full bg-teal-200 px-3 py-1 text-xs text-green-500">
                                        {{ service.prod_status }}
                                    </span>
                                </div>

                                <a class="mt-2 block truncate text-lg font-medium text-gray-800 hover:underline"
                                    href="#">
                                    {{ service.prod_name }}
                                </a>
                            </div>

                            <div class="flex items-center justify-between px-4 pb-3">
                                <div>
                                    <div class="text-lg text-gray-800">
                                        <span class="font-medium">₱{{ service.prod_price }}</span>
                                    </div>
                                </div>

                                <div>
                                    <Link :href="route('services.show', service.id)"
                                        class="btn-link flex items-center text-xs text-indigo-600 hover:underline"
                                        href="#">
                                    View service &rarr;
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <div class="col-span-full text-center text-gray-600">
                    No services available.
                </div>
            </template>
        </div>
    </GuestLayout>
</template>
