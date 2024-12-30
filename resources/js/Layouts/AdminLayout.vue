<script setup>
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import Search from '@/Components/Search.vue';
import ThemeToggle from '@/Components/ThemeToggle.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

const isSidebarOpen = ref(false);

function toggleSidebar() {
    isSidebarOpen.value = !isSidebarOpen.value;
}

const sidebarClasses = computed(() =>
    isSidebarOpen.value ? 'translate-x-none' : '-translate-x-48'
);

const maxSidebarClasses = computed(() =>
    isSidebarOpen.value ? 'flex' : 'hidden'
);

const miniSidebarClasses = computed(() =>
    isSidebarOpen.value ? 'hidden' : 'flex'
);

const maxToolbarClasses = computed(() =>
    isSidebarOpen.value ? 'translate-x-0' : 'translate-x-24 scale-x-0'
);

const contentClasses = computed(() =>
    isSidebarOpen.value ? 'ml-12 md:ml-60' : 'ml-12'
);

const navClasses = computed(() =>
    isSidebarOpen.value ? 'ml-12 md:ml-32' : 'ml-12'
);
</script>

<template>
    <div>
        <div class="fixed w-full z-30 flex p-2 items-center justify-center h-16 px-10 dark:bg-gray-900">
            <div
                class="ml-12 dark:text-white  transform ease-in-out duration-500 flex-none h-full flex items-center justify-center">
                ADMIN
            </div>

            <div :class="['nav', navClasses]" class="nav items-center">
                <nav v-if="$slots.route" class="flex px-5 py-3 text-gray-700 mx-4">
                    <slot name="route" />
                </nav>
            </div>

            <!-- SPACER -->
            <div class=" grow h-full flex items-center justify-center"></div>

            <div class="flex-none h-full text-center flex items-center justify-center">
                <div class="flex space-x-3 items-center px-3">
                    <div class="flex-none flex justify-center">
                        <ApplicationLogo
                            class="flex items-center h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </div>

                    <div class="hidden md:block text-sm md:text-md text-black dark:text-white">
                        ZPPSU E-Marketplace
                    </div>
                </div>
            </div>
        </div>
        <aside @click.stop="toggleSidebar"
            :class="['transition transform ease-in-out duration-1000 z-50', sidebarClasses]"
            class="w-60 fixed h-screen bg-gray-100 dark:bg-gray-800">
            <!-- open sidebar button -->
            <div
                :class="['max-toolbar w-full -right-6 flex items-center justify-between border-4 border-white dark:border-[#0F172A] bg-[#1E293B] absolute top-2 rounded-full h-12', maxToolbarClasses]">
                <div class="flex pl-4 items-center space-x-2 ">
                    <div>
                        <ThemeToggle />
                    </div>
                </div>
                <div
                    class="flex items-center space-x-3 group bg-gradient-to-r from-red-700 to-red-900 pl-10 pr-2 py-1 rounded-full text-white  ">
                    <div class="transform ease-in-out duration-300 mr-20">
                        ADMIN
                    </div>
                </div>
            </div>
            <div @click="openNav()"
                class="-right-6 transition transform ease-in-out duration-500 flex border-4 border-white dark:border-[#0F172A] bg-gray-300 dark:bg-[#1E293B] dark:hover:bg-red-700 hover:bg-red-900 absolute top-2 p-3 rounded-full dark:text-white dark:hover:text-white hover:text-white hover:rotate-45">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={3}
                    stroke="currentColor" class="w-4 h-4">
                    <path strokeLinecap="round" strokeLinejoin="round"
                        d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
            </div>
            <!-- MAX SIDEBAR-->
            <div :class="['max mt-20 flex-col space-y-2 w-full h-[calc(100vh)]', maxSidebarClasses]">
                <Link :href="route('dashboard')"
                    class="hover:ml-4 w-full dark:text-white hover:text-purple-500 dark:hover:text-blue-500 dark:bg-gray-800 bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-950 p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                    stroke="currentColor" class="w-4 h-4">
                    <path strokeLinecap="round" strokeLinejoin="round"
                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <div>
                    Home
                </div>
                </Link>
                <Link :href="route('all.users')"
                    class="hover:ml-4 w-full dark:text-white hover:text-purple-500 dark:hover:text-blue-500 dark:bg-gray-800 bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-950 p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path strokeLinecap=" round" strokeLinejoin="round"
                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                <div>
                    Users
                </div>
                </Link>
                <Link :href="route('products.index')"
                    class="hover:ml-4 w-full dark:text-white hover:text-purple-500 dark:hover:text-blue-500 dark:bg-gray-800 bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-950 p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none" class="w-4 h-4">
                    <g id="Delivery">
                        <path id="icon"
                            d="M17.5 13.3334H9.16667C6.80964 13.3334 5.63113 13.3334 4.8989 12.6011C4.16667 11.8689 4.16667 10.6904 4.16667 8.33337V5.00004C4.16667 4.07957 3.42047 3.33337 2.5 3.33337M8.33333 17.0834C8.33333 17.7737 7.77369 18.3334 7.08333 18.3334C6.39298 18.3334 5.83333 17.7737 5.83333 17.0834C5.83333 16.393 6.39298 15.8334 7.08333 15.8334C7.77369 15.8334 8.33333 16.393 8.33333 17.0834ZM15 17.0834C15 17.7737 14.4404 18.3334 13.75 18.3334C13.0596 18.3334 12.5 17.7737 12.5 17.0834C12.5 16.393 13.0596 15.8334 13.75 15.8334C14.4404 15.8334 15 16.393 15 17.0834ZM10.4167 10H13.75C14.9204 10 15.5056 10 15.926 9.71916C16.1079 9.59756 16.2642 9.44131 16.3858 9.25932C16.6667 8.83895 16.6667 8.25376 16.6667 7.08337C16.6667 5.91299 16.6667 5.3278 16.3858 4.90742C16.2642 4.72544 16.1079 4.56919 15.926 4.44759C15.5056 4.16671 14.9204 4.16671 13.75 4.16671H10.4167C9.24628 4.16671 8.66109 4.16671 8.24072 4.44759C8.05873 4.56919 7.90248 4.72544 7.78088 4.90742C7.5 5.3278 7.5 5.91299 7.5 7.08337C7.5 8.25376 7.5 8.83895 7.78088 9.25932C7.90248 9.44131 8.05873 9.59756 8.24072 9.71916C8.66109 10 9.24628 10 10.4167 10Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </g>
                </svg>
                <div>
                    Products
                </div>
                </Link>
                <Link :href="route('posts.index')"
                    class="hover:ml-4 w-full dark:text-white hover:text-purple-500 dark:hover:text-blue-500 dark:bg-gray-800 bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-950 p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                </svg>
                <div>
                    Posts
                </div>
                </Link>
                <Link :href="route('admin.logout')" method="post" as="button"
                    class="hover:ml-4 w-full dark:text-white hover:text-purple-500 dark:hover:text-blue-500 dark:bg-gray-800 bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-950 p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                </svg>
                <div>
                    Logout
                </div>
                </Link>
            </div>
            <!-- MINI SIDEBAR-->
            <div :class="['mini mt-20 flex flex-col space-y-2 w-full h-[calc(100vh)]', miniSidebarClasses]">
                <div
                    class="hover:ml-4 justify-end pr-5 dark:text-white hover:text-purple-500 dark:hover:text-blue-500 w-full dark:bg-gray-800 bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-950 p-3 rounded-full transform ease-in-out duration-300 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                        stroke="currentColor" class="w-4 h-4">
                        <path strokeLinecap="round" strokeLinejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </div>
                <div
                    class="hover:ml-4 justify-end pr-5 dark:text-white hover:text-purple-500 dark:hover:text-blue-500 w-full dark:bg-gray-800 bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-950 p-3 rounded-full transform ease-in-out duration-300 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path strokeLinecap=" round" strokeLinejoin="round"
                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
                <div
                    class="hover:ml-4 justify-end pr-5 dark:text-white hover:text-purple-500 dark:hover:text-blue-500 w-full dark:bg-gray-800 bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-950 p-3 rounded-full transform ease-in-out duration-300 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none" class="w-4 h-4">
                        <g id="Delivery">
                            <path id="icon"
                                d="M17.5 13.3334H9.16667C6.80964 13.3334 5.63113 13.3334 4.8989 12.6011C4.16667 11.8689 4.16667 10.6904 4.16667 8.33337V5.00004C4.16667 4.07957 3.42047 3.33337 2.5 3.33337M8.33333 17.0834C8.33333 17.7737 7.77369 18.3334 7.08333 18.3334C6.39298 18.3334 5.83333 17.7737 5.83333 17.0834C5.83333 16.393 6.39298 15.8334 7.08333 15.8334C7.77369 15.8334 8.33333 16.393 8.33333 17.0834ZM15 17.0834C15 17.7737 14.4404 18.3334 13.75 18.3334C13.0596 18.3334 12.5 17.7737 12.5 17.0834C12.5 16.393 13.0596 15.8334 13.75 15.8334C14.4404 15.8334 15 16.393 15 17.0834ZM10.4167 10H13.75C14.9204 10 15.5056 10 15.926 9.71916C16.1079 9.59756 16.2642 9.44131 16.3858 9.25932C16.6667 8.83895 16.6667 8.25376 16.6667 7.08337C16.6667 5.91299 16.6667 5.3278 16.3858 4.90742C16.2642 4.72544 16.1079 4.56919 15.926 4.44759C15.5056 4.16671 14.9204 4.16671 13.75 4.16671H10.4167C9.24628 4.16671 8.66109 4.16671 8.24072 4.44759C8.05873 4.56919 7.90248 4.72544 7.78088 4.90742C7.5 5.3278 7.5 5.91299 7.5 7.08337C7.5 8.25376 7.5 8.83895 7.78088 9.25932C7.90248 9.44131 8.05873 9.59756 8.24072 9.71916C8.66109 10 9.24628 10 10.4167 10Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </g>
                    </svg>
                </div>
                <div
                    class="hover:ml-4 justify-end pr-5 dark:text-white hover:text-purple-500 dark:hover:text-blue-500 w-full dark:bg-gray-800 bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-950 p-3 rounded-full transform ease-in-out duration-300 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                    </svg>
                </div>
                <div
                    class="hover:ml-4 justify-end pr-5 dark:text-white hover:text-purple-500 dark:hover:text-blue-500 w-full dark:bg-gray-800 bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-950 p-3 rounded-full transform ease-in-out duration-300 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                </div>
            </div>
        </aside>
        <!-- CONTENT -->
        <div :class="['content', contentClasses]"
            class="content ml-12 transform ease-in-out duration-500 pt-20 px-2 md:px-5 pb-4 ">
            <slot />
        </div>
    </div>
</template>
