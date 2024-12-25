<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import Search from '@/Components/Search.vue';
import Dropdown from '@/Components/Dropdown.vue';
import SidebarLink from '@/Components/SidebarLink.vue';
import ToggleTheme from '@/Components/ThemeToggle.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <nav
        class="fixed w-full z-20 top-0 start-0 max-w-screen-3xl flex flex-wrap items-center justify-between mx-auto p-4 xl:pl-[30rem]">
        <Link v-if="$page.props.auth.user" :href="route('home')" class="flex items-center space-x-3 xl:hidden">
        <ApplicationLogo class="flex items-center h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
        </Link>

        <Link v-else :href="route('landing.page')" :class="[
                route().current() === 'landing.page' ? 'xl:flex' : 'xl:hidden',
                'items-center space-x-3'
            ]">
        <ApplicationLogo class="flex items-center h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
        </Link>

        <div class="items-center justify-between hidden w-full md:flex md:w-auto">
            <div class="relative mt-3 md:hidden">
                <Search />
            </div>
            <header v-if="$slots.header"
                class="xl:flex hidden flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <slot name="header" />
            </header>
        </div>

        <div class="flex items-center">
            <div class="relative hidden md:block">
                <Search />
            </div>

            <div class="flex-grow justify-end sm:flex sm:items-center">
                <div class="relative ms-3 hidden sm:flex">
                    <Dropdown align="right" width="56">
                        <template #trigger>
                            <span class="inline-flex rounded-md">
                                <button
                                    class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                    type="button">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-3.jpg"
                                        alt="user photo">
                                </button>
                            </span>
                        </template>

                        <template #content>
                            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                <div>{{ $page.props.auth.user.name }}</div>
                                <div class="font-medium truncate">{{ $page.props.auth.user.department }}</div>
                            </div>
                            <DropdownLink :href="route('login')">
                                Profile
                            </DropdownLink>
                            <DropdownLink :href="route('verification')">
                                Settings
                            </DropdownLink>
                            <DropdownLink :href="route('verification')">
                                Logout
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </div>
                <div class="hidden xl:flex">
                    <ThemeToggle />
                </div>
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
                        }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Responsive Navigation Menu -->
    <aside v-if="route().current() !== 'landing.page'" :class="{
            'block xl:hidden': showingNavigationDropdown,
            'hidden xl:block': !showingNavigationDropdown,
        }"
        class="w-96 fixed top-0 left-0 z-40 h-screen xl:p-4 p-2 bg-gray-100 dark:bg-gray-950 flex-col justify-start items-start gap-5">
        <div class="size-full flex flex-col">
            <div class="flex items-center justify-between pt-4 pe-4">
                <Link :href="route('home')">
                <ApplicationLogo class="flex items-center h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                </Link>

                <ToggleTheme />
            </div>

            <div class="h-full pt-6">
                <ul class="space-y-2 font-medium">
                    <li>
                        <SidebarLink :href="route('posts.index')" :active="route().current('posts.index')">
                            <div class="h-5 gap-3 flex items-center">
                                <div class="relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.6" stroke="#6B7280">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                                    </svg>
                                </div>
                                <h2 class="text-gray-500 dark:text-gray-200 text-sm font-medium leading-snug">
                                    Posts</h2>
                            </div>
                        </SidebarLink>
                    </li>
                </ul>
                <ul v-if="$page.props.auth.user" class=" pt-4 mt-4 space-y-2 font-medium border-t border-gray-200
                    dark:border-gray-700">
                    <li>
                        <SidebarLink :href="route('profile.show')" :active="route().current('profile.show')">
                            <div class="h-5 items-center gap-3 flex">
                                <div class="relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20"
                                        fill="none">
                                        <g id="User Circle">
                                            <path id="icon"
                                                d="M5.5 16C5.5 13.9289 7.51472 12.25 10 12.25C12.4853 12.25 14.5 13.9289 14.5 16M12.25 7.75C12.25 8.99264 11.2426 10 10 10C8.75736 10 7.75 8.99264 7.75 7.75C7.75 6.50736 8.75736 5.5 10 5.5C11.2426 5.5 12.25 6.50736 12.25 7.75ZM17.5 10C17.5 14.1421 14.1421 17.5 10 17.5C5.85786 17.5 2.5 14.1421 2.5 10C2.5 5.85786 5.85786 2.5 10 2.5C14.1421 2.5 17.5 5.85786 17.5 10Z"
                                                stroke="#6B7280" stroke-width="1.6" />
                                        </g>
                                    </svg>
                                </div>
                                <h2 class="text-gray-500 dark:text-gray-200 text-sm font-medium leading-snug">
                                    Profile</h2>
                            </div>
                        </SidebarLink>
                    </li>
                    <li>
                        <SidebarLink :href="route('profile.edit', { id: $page.props.auth.user?.id })" :active="route().current('profile.edit')">
                            <div class="h-5 items-center gap-3 flex">
                                <div class="relative">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20"
                                        fill="none">
                                        <g id="User Circle">
                                            <path id="icon"
                                                d="M5.5 16C5.5 13.9289 7.51472 12.25 10 12.25C12.4853 12.25 14.5 13.9289 14.5 16M12.25 7.75C12.25 8.99264 11.2426 10 10 10C8.75736 10 7.75 8.99264 7.75 7.75C7.75 6.50736 8.75736 5.5 10 5.5C11.2426 5.5 12.25 6.50736 12.25 7.75ZM17.5 10C17.5 14.1421 14.1421 17.5 10 17.5C5.85786 17.5 2.5 14.1421 2.5 10C2.5 5.85786 5.85786 2.5 10 2.5C14.1421 2.5 17.5 5.85786 17.5 10Z"
                                                stroke="#6B7280" stroke-width="1.6" />
                                        </g>
                                    </svg> -->
                                    <svg class="size-6" width="25" height="25" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </div>
                                <h2 class="text-gray-500 dark:text-gray-200 text-sm font-medium leading-snug">
                                    Settings
                                </h2>
                            </div>
                        </SidebarLink>
                    </li>
                </ul>
            </div>

            <div class="mt-auto">
                <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                    <Link
                        class="flex w-full justify-between items-center gap-x-3 py-2 px-3 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:hover:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300 dark:focus:text-gray-300"
                        :href="route('logout')" method="post" as="button">
                    Logout
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                        <polyline points="10 17 15 12 10 7" />
                        <line x1="15" x2="3" y1="12" y2="12" />
                    </svg>
                    </Link>
                </div>
            </div>
        </div>
    </aside>

    <main class="p-4 xl:px-20 px-8 h-auto pt-24 xl:ml-96">
        <div class="xl:hidden sm:block">
            <header v-if="$slots.header">
                <slot name="header" />
            </header>
            <nav v-if="$slots.route" class="flex py-3">
                <slot name="route" />
            </nav>
        </div>

        <slot />
    </main>
</template>
