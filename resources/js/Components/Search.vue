<script>
import axios from 'axios';
import { Link } from '@inertiajs/vue3';

export default {
    data() {
        return {
            query: '',
            results: [],
        };
    },
    methods: {
        async fetchResults() {
            if (this.query) {
                try {
                    const response = await axios.post('/search', { query: this.query });
                    this.results = response.data.results;
                } catch (error) {
                    console.error('Error fetching results:', error);
                }
            } else {
                this.results = [];
            }
        },
        removeResult(index) {
            this.results.splice(index, 1);
        },
    },
};
</script>

<template>
    <div class="mb-4 sm:pr-3 sm:mb-0">
        <label for="products-search" class="sr-only">Search</label>
        <div class="relative mt-1 sm:w-64 xl:w-96">
            <input v-model="query" @input="fetchResults" id="search-input" name="search" autocomplete="off"
                class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-900/50 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50"
                placeholder="Search...">

            <div v-if="results.length"
                class="absolute bg-white shadow-lg rounded-md mt-2 z-10 w-full max-w-lg dark:bg-gray-800">
                <div v-for="(result, index) in results" :key="index"
                    class="flex justify-between items-center px-4 py-3 hover:rounded-md hover:bg-gray-50 hover:dark:bg-gray-700">
                    <div class="flex items-center gap-3">
                        <a :href="result.url" class="block text-gray-800 dark:text-white">
                            <div class="font-semibold">{{ result.title }}</div>
                            <div
                                class="text-sm text-gray-600 truncate dark:text-gray-300 max-w-[12rem] whitespace-nowrap overflow-hidden text-ellipsis">
                                {{ result.description }}
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
