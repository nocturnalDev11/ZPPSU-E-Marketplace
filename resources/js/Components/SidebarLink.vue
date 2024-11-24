<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'inline-flex flex rounded-lg items-center px-3 py-4 w-full bg-white shadow-xl shadow-gray-200 dark:shadow-none dark:bg-gray-900 font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none transition duration-150 ease-in-out'
        : 'inline-flex flex rounded-lg items-center px-3 py-4 w-full bg-50 dark:bg-gray-950 font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out',
);
</script>

<template>
    <Link :href="href" :class="classes">
    <slot />
    </Link>
</template>
