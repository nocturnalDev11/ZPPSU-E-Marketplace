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
        ? 'inline-flex py-5 items-center px-1 border-b-2 border-red-700 dark:border-red-600 text-lg font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-red-700 transition duration-150 ease-in-out'
        : 'inline-flex py-5 items-center px-1 border-b-2 border-transparent text-lg font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out',
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
