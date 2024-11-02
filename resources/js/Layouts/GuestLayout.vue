<script setup>
import { ref } from 'vue';
import ApplicationLogo from '../Components/ApplicationLogo.vue'
import Dropdown from '../Components/Dropdown.vue';
import DropdownLink from '../Components/DropdownLink.vue';
import NavLink from '../Components/NavLink.vue';
import ResponsiveNavLink from '../Components/ResponsiveNavLink.vue';
import ThemeToggle from '../Components/ThemeToggle.vue';
import Search from '../Components/Search.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <div class="fixed left-0 right-0 top-0">
                <nav class="border-b border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-800">
                    <!-- Primary Navigation Menu -->
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div class="flex h-16 justify-between">
                            <div class="flex">
                                <!-- Logo -->
                                <div class="flex shrink-0 items-center me-2">
                                    <Link href="/">
                                    <span
                                        class="hidden md:hidden lg:block xl:block w-auto fill-current text-gray-800 dark:text-gray-200">
                                        ZPPSU E-Marketplace
                                    </span>
                                    <ApplicationLogo
                                        class="xl:hidden lg:hidden md:block block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                                    </Link>
                                </div>
                            </div>

                            <!-- Search Component with responsive width -->
                            <Search />

                            <!-- Settings and Get Started Button -->
                            <div class="sm:ms-6 sm:flex sm:items-center">
                                <div class="relative ms-3 hidden sm:flex">
                                    <Dropdown align="right" width="56">
                                        <template #trigger>
                                            <span class="inline-flex rounded-md">
                                                <button type="button"
                                                    class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300">
                                                    Get Started
                                                    <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <span
                                                class="block w-full py-2 px-4 text-start text-md leading-5 font-semibold text-gray-800 dark:text-gray-100">
                                                Login
                                            </span>
                                            <DropdownLink :href="route('campus.login')">
                                                ZPPSU community members
                                            </DropdownLink>
                                            <DropdownLink :href="route('external.login')">
                                                Non-community members
                                            </DropdownLink>
                                            <hr class="mx-2 py-2 border-gray-300 dark:border-gray-600">
                                            <span
                                                class="block w-full py-2 px-4 text-start text-md leading-5 font-semibold text-gray-800 dark:text-gray-100">
                                                Verify/Signup
                                            </span>
                                            <DropdownLink href="#">
                                                Email verification ZPPSU community members
                                            </DropdownLink>
                                            <DropdownLink href="#">
                                                Signup non-community members
                                            </DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                                <div class="hidden sm:flex">
                                    <ThemeToggle />
                                </div>
                            </div>

                            <!-- Hamburger -->
                            <div class="-me-2 flex items-center sm:hidden ml-2">
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
                    </div>

                    <!-- Responsive Navigation Menu -->
                    <div :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                        class="xl:hidden w-72 fixed top-0 left-0 z-[300] h-screen xl:p-4 p-2 bg-white dark:bg-gray-800 flex-col justify-start items-start gap-5 border-r border-gray-100 dark:border-gray-700">
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
                                <ResponsiveNavLink :href="route('products.index')">
                                    <div class="h-5 gap-3 flex">
                                        <div class="relative">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 20 20" fill="none">
                                                <g id="Delivery">
                                                    <path id="icon"
                                                        d="M17.5 13.3334H9.16667C6.80964 13.3334 5.63113 13.3334 4.8989 12.6011C4.16667 11.8689 4.16667 10.6904 4.16667 8.33337V5.00004C4.16667 4.07957 3.42047 3.33337 2.5 3.33337M8.33333 17.0834C8.33333 17.7737 7.77369 18.3334 7.08333 18.3334C6.39298 18.3334 5.83333 17.7737 5.83333 17.0834C5.83333 16.393 6.39298 15.8334 7.08333 15.8334C7.77369 15.8334 8.33333 16.393 8.33333 17.0834ZM15 17.0834C15 17.7737 14.4404 18.3334 13.75 18.3334C13.0596 18.3334 12.5 17.7737 12.5 17.0834C12.5 16.393 13.0596 15.8334 13.75 15.8334C14.4404 15.8334 15 16.393 15 17.0834ZM10.4167 10H13.75C14.9204 10 15.5056 10 15.926 9.71916C16.1079 9.59756 16.2642 9.44131 16.3858 9.25932C16.6667 8.83895 16.6667 8.25376 16.6667 7.08337C16.6667 5.91299 16.6667 5.3278 16.3858 4.90742C16.2642 4.72544 16.1079 4.56919 15.926 4.44759C15.5056 4.16671 14.9204 4.16671 13.75 4.16671H10.4167C9.24628 4.16671 8.66109 4.16671 8.24072 4.44759C8.05873 4.56919 7.90248 4.72544 7.78088 4.90742C7.5 5.3278 7.5 5.91299 7.5 7.08337C7.5 8.25376 7.5 8.83895 7.78088 9.25932C7.90248 9.44131 8.05873 9.59756 8.24072 9.71916C8.66109 10 9.24628 10 10.4167 10Z"
                                                        stroke="#6B7280" stroke-width="1.6" stroke-linecap="round" />
                                                </g>
                                            </svg>
                                        </div>
                                        <h2 class="text-gray-500 dark:text-gray-200 text-sm font-medium leading-snug">
                                            Products</h2>
                                    </div>
                                </ResponsiveNavLink>
                                <ResponsiveNavLink href="#">
                                    <div class="h-5 gap-3 flex">
                                        <div class="relative">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 20 20" fill="none">
                                                <g id="Shop">
                                                    <path id="icon"
                                                        d="M15.8338 7.5V14.1667C15.8338 15.738 15.8338 16.5237 15.3456 17.0118C14.8575 17.5 14.0718 17.5 12.5005 17.5H7.50045C5.9291 17.5 5.14343 17.5 4.65527 17.0118C4.16712 16.5237 4.16712 15.738 4.16712 14.1667V7.5M7.50045 2.5H6.03139C5.45185 2.5 5.16208 2.5 4.91255 2.58051C4.55586 2.69558 4.24838 2.92752 4.03974 3.23887C3.89378 3.45668 3.81417 3.73531 3.65496 4.29255L3.46215 4.9674C3.30254 5.52601 3.22274 5.80531 3.21582 6.00994C3.18427 6.942 3.92364 7.71858 4.85614 7.73279C5.06086 7.7359 5.34374 7.6699 5.9095 7.53789C6.19705 7.47079 6.34083 7.43724 6.46286 7.38751C7.00256 7.16753 7.38815 6.68161 7.47974 6.10604C7.50045 5.9759 7.50045 5.82826 7.50045 5.53299V2.5ZM7.50045 2.5H12.5005M7.50045 2.5V5C7.50045 5.77657 7.50045 6.16485 7.62732 6.47114C7.79647 6.87952 8.12093 7.20398 8.52931 7.37313C8.8356 7.5 9.22388 7.5 10.0005 7.5C10.777 7.5 11.1653 7.5 11.4716 7.37313C11.88 7.20398 12.2044 6.87952 12.3736 6.47114C12.5005 6.16485 12.5005 5.77657 12.5005 5V2.5M12.5005 2.5H13.9695C14.549 2.5 14.8388 2.5 15.0884 2.58051C15.445 2.69558 15.7525 2.92752 15.9612 3.23887C16.1071 3.45668 16.1867 3.73531 16.3459 4.29255L16.5388 4.9674C16.6984 5.52601 16.7782 5.80531 16.7851 6.00994C16.8166 6.942 16.0773 7.71858 15.1448 7.73279C14.94 7.7359 14.6572 7.6699 14.0914 7.53789C13.8038 7.47079 13.6601 7.43724 13.538 7.38751C12.9983 7.16753 12.6127 6.68161 12.5212 6.10604C12.5005 5.9759 12.5005 5.82826 12.5005 5.53299V2.5ZM11.6671 17.5V14.1667C11.6671 13.381 11.6671 12.9882 11.423 12.7441C11.179 12.5 10.7861 12.5 10.0005 12.5C9.21478 12.5 8.82194 12.5 8.57786 12.7441C8.33378 12.9882 8.33378 13.381 8.33378 14.1667V17.5H11.6671Z"
                                                        stroke="#6B7280" stroke-width="1.6" />
                                                </g>
                                            </svg>
                                        </div>
                                        <h2 class="text-gray-500 dark:text-gray-200 text-sm font-medium leading-snug">
                                            Services</h2>
                                    </div>
                                </ResponsiveNavLink>
                                <ResponsiveNavLink href="#">
                                    <div class="h-5 gap-3 flex">
                                        <div class="relative">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.6" stroke="#6B7280">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                                            </svg>
                                        </div>
                                        <h2 class="text-gray-500 dark:text-gray-200 text-sm font-medium leading-snug">
                                            Posts</h2>
                                    </div>
                                </ResponsiveNavLink>
                                <ResponsiveNavLink href="#">
                                    <div class="h-5 gap-3 flex">
                                        <div class="relative">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 20 20" fill="none">
                                                <g id="Swap">
                                                    <path id="icon"
                                                        d="M2.50325 9.00193C2.50145 5.42312 5.40119 2.52045 8.98001 2.51865M8.99678 2.5L7.25783 4.94982M17.5 10.9172C17.5 14.496 14.5988 17.3972 11.02 17.3972M11.0022 17.4161L12.7423 14.9671M14.5833 8.3334C12.9725 8.3334 11.6667 7.02756 11.6667 5.41673C11.6667 3.8059 12.9725 2.50006 14.5833 2.50006C16.1942 2.50006 17.5 3.8059 17.5 5.41673C17.5 7.02756 16.1942 8.3334 14.5833 8.3334ZM5.41667 17.5001C4.24628 17.5001 3.66109 17.5001 3.24072 17.2192C3.05873 17.0976 2.90248 16.9413 2.78088 16.7593C2.5 16.339 2.5 15.7538 2.5 14.5834C2.5 13.413 2.5 12.8278 2.78088 12.4074C2.90248 12.2255 3.05873 12.0692 3.24072 11.9476C3.66109 11.6667 4.24628 11.6667 5.41667 11.6667C6.58705 11.6667 7.17224 11.6667 7.59262 11.9476C7.7746 12.0692 7.93085 12.2255 8.05245 12.4074C8.33333 12.8278 8.33333 13.413 8.33333 14.5834C8.33333 15.7538 8.33333 16.339 8.05245 16.7593C7.93085 16.9413 7.7746 17.0976 7.59262 17.2192C7.17224 17.5001 6.58705 17.5001 5.41667 17.5001Z"
                                                        stroke="#6B7280" stroke-width="1.60274" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </g>
                                            </svg>
                                        </div>
                                        <h2 class="text-gray-500 dark:text-gray-200 text-sm font-medium leading-snug">
                                            Tradings</h2>
                                    </div>
                                </ResponsiveNavLink>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Page Heading -->
                <header class="hidden sm:flex border-b border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-800">
                    <!-- Primary Navigation Menu -->
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div class="flex h-12 justify-between">
                            <div class="flex">
                                <!-- Navigation Links -->
                                <div class="space-x-8 sm:-my-px me-12 sm:flex">
                                    <NavLink :href="route('products.index')"
                                        :active="route().current('products.index')">
                                        Products
                                    </NavLink>
                                    <NavLink :href="route('services.index')"
                                        :active="route().current('services.index')">
                                        Services
                                    </NavLink>
                                    <NavLink href="#">
                                        Trades
                                    </NavLink>
                                    <NavLink href="#">
                                        About us
                                    </NavLink>
                                    <NavLink href="#">
                                        Contacts us
                                    </NavLink>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
            </div>

            <!-- Page Content -->
            <main class="pt-24 px-5">
                <slot />
            </main>
        </div>
    </div>
</template>
