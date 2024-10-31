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
                                    <span class="hidden sm:block w-auto fill-current text-gray-800 dark:text-gray-200">
                                        ZPPSU E-Marketplace
                                    </span>
                                    <ApplicationLogo
                                        class="sm:hidden block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                                    </Link>
                                </div>
                            </div>

                            <!-- Search Component with responsive width -->
                            <Search />

                            <!-- Settings and Get Started Button -->
                            <div class="sm:ms-6 sm:flex sm:items-center">
                                <div class="relative ms-3 hidden sm:flex">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <span class="inline-flex rounded-md">
                                                <button type="button"
                                                    class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300">
                                                    {{ $page.props.auth.user.name }}
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
                                            <!-- <DropdownLink :href="route('user.login')">Login</DropdownLink> -->
                                            <DropdownLink href="#">Admin profile</DropdownLink>
                                            <DropdownLink :href="route('admin.logout')" method="post" as="button">
                                                Logout
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
                    }" class="sm:hidden">
                        <div class="flex items-center justify-between space-y-1 pb-3 pt-2 px-4">
                            <div class="text-base font-medium text-gray-800 dark:text-gray-200">
                                Theme toggle
                            </div>
                            <ThemeToggle />
                        </div>

                        <div class="border-t border-gray-200 pb-2 dark:border-gray-600">
                            <div class="mt-2 space-y-1">
                                <ResponsiveNavLink href="#">
                                    Products
                                </ResponsiveNavLink>
                                <ResponsiveNavLink href="#">
                                    Services
                                </ResponsiveNavLink>
                                <ResponsiveNavLink href="#">
                                    Posts
                                </ResponsiveNavLink>
                                <ResponsiveNavLink href="#">
                                    Trades
                                </ResponsiveNavLink>
                                <ResponsiveNavLink href="#">
                                    Buyers
                                </ResponsiveNavLink>
                                <ResponsiveNavLink href="#">
                                    Sellers
                                </ResponsiveNavLink>
                                <ResponsiveNavLink :href="route('admin.logout')" method="post" as="button">
                                    Logout
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
                                    <NavLink href="#">
                                        Products
                                    </NavLink>
                                    <NavLink href="#">
                                        Services
                                    </NavLink>
                                    <NavLink href="#">
                                        Posts
                                    </NavLink>
                                    <NavLink href="#">
                                        Trades
                                    </NavLink>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
            </div>

            <!-- Page Content -->
            <main class="pt-48">
                <slot />
            </main>
        </div>
    </div>
</template>
