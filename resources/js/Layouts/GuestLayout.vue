<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import Search from '@/Components/Search.vue';
import NavLink from '@/Components/NavLink.vue';
import Dropdown from '@/Components/Dropdown.vue';
import ToggleTheme from '@/Components/ThemeToggle.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <nav class="bg-gray-50 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <Link :href="route('landing.page')" class="flex items-center space-x-3">
            <ApplicationLogo class="flex items-center h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </Link>

            <div class="items-center justify-between hidden w-full md:flex md:w-auto">
                <div class="relative mt-3 md:hidden">
                    <Search />
                </div>
                <ul
                    class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <NavLink :href="route('products.index')" :active="route().current('products.index')">
                            Products
                        </NavLink>
                    </li>
                    <li>
                        <NavLink :href="route('services.index')" :active="route().current('services.index')">
                            Services
                        </NavLink>
                    </li>
                    <li>
                        <NavLink :href="route('posts.index')" :active="route().current('posts.index')">
                            Posts
                        </NavLink>
                    </li>
                    <li>
                        <NavLink :href="route('trades.index')" :active="route().current('trades.index')">
                            Trades
                        </NavLink>
                    </li>
                </ul>
            </div>

            <div class="flex items-center">
                <Dropdown align="center" width="56">
                    <template #trigger>
                        <span class="inline-flex rounded-md">
                            <button type="button"
                                class="ml-3 inline-flex items-center rounded-md border border-transparent bg-gray-100 px-3 py-2 text-md font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-950 dark:text-gray-400 dark:hover:text-gray-300">
                                Get started
                                <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </span>
                    </template>

                    <template #content>
                        <DropdownLink :href="route('login')">
                            Login
                        </DropdownLink>
                        <DropdownLink :href="route('verification')">
                            Email verification
                        </DropdownLink>
                    </template>
                </Dropdown>

                <div class="inline-flex justify-center ml-3">
                    <ToggleTheme />
                </div>

                <!-- Hamburger -->
                <div class="flex xl:hidden">
                    <button @click="
                        showingNavigationDropdown =
                        !showingNavigationDropdown
                        "
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{
                                hidden: showingNavigationDropdown,
                                'inline-flex':
                                    !showingNavigationDropdown,
                            }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{
                                hidden: !showingNavigationDropdown,
                                'inline-flex':
                                    showingNavigationDropdown,
                            }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{
                block: showingNavigationDropdown,
                hidden: !showingNavigationDropdown,
            }"
                class="xl:hidden w-72 fixed top-0 left-0 z-40 h-screen xl:p-4 p-2 bg-white dark:bg-gray-800 flex-col justify-start items-start gap-5 border-r border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between space-y-1 pb-3 pt-2 px-4">
                    <div class="text-base font-medium text-gray-800 dark:text-gray-200">
                        Theme toggle
                    </div>
                    <ThemeToggle />
                </div>

                <div class="border-t border-gray-200 pb-2 dark:border-gray-600">
                    <div class="mt-2 space-y-1">
                        <div class="w-full h-8 px-4 items-center flex">
                            <h6 class="text-gray-800 dark:text-gray-100 text-xs font-semibold leading-4">MENU
                            </h6>
                        </div>
                        <ul
                            class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                            <li>
                                <a href="#"
                                    class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500"
                                    aria-current="page">Home</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Services</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto">
        <slot />
    </main>
</template>
