<script setup>
import { ref, computed } from 'vue';
<<<<<<< HEAD
import { Link } from '@inertiajs/vue3';
=======
>>>>>>> 9f64e7b045f88b60a0adb93d761525d625705b92
import ThemeToggle from '@/Components/ThemeToggle.vue';

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

<<<<<<< HEAD
=======
const logoClasses = computed(() =>
    isSidebarOpen.value ? '' : 'ml-12'
);

>>>>>>> 9f64e7b045f88b60a0adb93d761525d625705b92
const contentClasses = computed(() =>
    isSidebarOpen.value ? 'ml-12 md:ml-60' : 'ml-12'
);
</script>

<template>
<<<<<<< HEAD
    <div>
        <div class="fixed w-full z-30 flex p-2 items-center justify-center h-16 px-10">
=======
    <div :class="darkModeClass">
        <div class="fixed w-full z-30 flex bg-white dark:bg-[#0F172A] p-2 items-center justify-center h-16 px-10">
>>>>>>> 9f64e7b045f88b60a0adb93d761525d625705b92
            <div
                class="logo ml-12 dark:text-white  transform ease-in-out duration-500 flex-none h-full flex items-center justify-center">
                ADMIN
            </div>
<<<<<<< HEAD
            <!-- SPACER -->
=======
>>>>>>> 9f64e7b045f88b60a0adb93d761525d625705b92
            <div class="grow h-full flex items-center justify-center"></div>
            <div class="flex-none h-full text-center flex items-center justify-center">
                <div class="flex space-x-3 items-center px-3">
                    <div class="flex-none flex justify-center">
                        <div class="w-8 h-8 flex ">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShta_GXR2xdnsxSzj_GTcJHcNykjVKrCBrZ9qouUl0usuJWG2Rpr_PbTDu3sA9auNUH64&usqp=CAU"
                                alt="profile" class="shadow rounded-full object-cover" />
                        </div>
                    </div>

<<<<<<< HEAD
                    <div class="hidden md:block text-sm md:text-md text-black dark:text-white">
                        Admin Panel
                    </div>
=======
                    <div class="hidden md:block text-sm md:text-md text-black dark:text-white">John Doe</div>
>>>>>>> 9f64e7b045f88b60a0adb93d761525d625705b92
                </div>
            </div>
        </div>
        <aside @click.stop="toggleSidebar"
            :class="['transition transform ease-in-out duration-1000 z-50', sidebarClasses]"
<<<<<<< HEAD
            class="w-60 fixed h-screen bg-gray-100 dark:bg-gray-800">
            <!-- open sidebar button -->
            <div
                :class="['max-toolbar w-full -right-6 flex items-center justify-between border-4 border-white dark:border-[#0F172A] bg-[#1E293B] absolute top-2 rounded-full h-12', maxToolbarClasses]">
=======
            class="w-60 fixed h-screen bg-[#1E293B]">
            <div :class="['max-toolbar w-full -right-6 flex items-center justify-between border-4 border-white dark:border-[#0F172A] bg-[#1E293B]  absolute top-2 rounded-full h-12', maxToolbarClasses]">
>>>>>>> 9f64e7b045f88b60a0adb93d761525d625705b92
                <div class="flex pl-4 items-center space-x-2 ">
                    <div>
                        <ThemeToggle />
                    </div>
                </div>
                <div
<<<<<<< HEAD
                    class="flex items-center space-x-3 group bg-gradient-to-r from-red-700 to-red-900 pl-10 pr-2 py-1 rounded-full text-white  ">
=======
                    class="flex items-center space-x-3 group bg-gradient-to-r dark:from-cyan-500 dark:to-blue-500 from-indigo-500 via-purple-500 to-purple-500  pl-10 pr-2 py-1 rounded-full text-white  ">
>>>>>>> 9f64e7b045f88b60a0adb93d761525d625705b92
                    <div class="transform ease-in-out duration-300 mr-20">
                        ADMIN
                    </div>
                </div>
            </div>
            <div @click="openNav()"
<<<<<<< HEAD
                class="-right-6 transition transform ease-in-out duration-500 flex border-4 border-white dark:border-[#0F172A] bg-gray-300 dark:bg-[#1E293B] dark:hover:bg-red-700 hover:bg-red-900 absolute top-2 p-3 rounded-full dark:text-white dark:hover:text-white hover:text-white hover:rotate-45">
=======
                class="-right-6 transition transform ease-in-out duration-500 flex border-4 border-white dark:border-[#0F172A] bg-[#1E293B] dark:hover:bg-blue-500 hover:bg-purple-500 absolute top-2 p-3 rounded-full text-white hover:rotate-45">
>>>>>>> 9f64e7b045f88b60a0adb93d761525d625705b92
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={3}
                    stroke="currentColor" class="w-4 h-4">
                    <path strokeLinecap="round" strokeLinejoin="round"
                        d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
            </div>
<<<<<<< HEAD
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
                <div
                    class="hover:ml-4 w-full dark:text-white hover:text-purple-500 dark:hover:text-blue-500 dark:bg-gray-800 bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-950 p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
=======
            <div :class="['max mt-20 flex-col space-y-2 w-full h-[calc(100vh)]', maxSidebarClasses]">
                <div
                    class="hover:ml-4 w-full text-white hover:text-purple-500 dark:hover:text-blue-500 bg-[#1E293B] p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                        stroke="currentColor" class="w-4 h-4">
                        <path strokeLinecap="round" strokeLinejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <div>
                        Home
                    </div>
                </div>
                <div
                    class="hover:ml-4 w-full text-white hover:text-purple-500 dark:hover:text-blue-500 bg-[#1E293B] p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                    </svg>
                    <div>
                        Table
                    </div>
                </div>
                <div
                    class="hover:ml-4 w-full text-white hover:text-purple-500 dark:hover:text-blue-500 bg-[#1E293B] p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
>>>>>>> 9f64e7b045f88b60a0adb93d761525d625705b92
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                    </svg>
                    <div>
                        Graph
                    </div>
                </div>
<<<<<<< HEAD
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
=======
            </div>
            <div :class="['mini mt-20 flex flex-col space-y-2 w-full h-[calc(100vh)]', miniSidebarClasses]">
                <div
                    class="hover:ml-4 justify-end pr-5 text-white hover:text-purple-500 dark:hover:text-blue-500 w-full bg-[#1E293B] p-3 rounded-full transform ease-in-out duration-300 flex">
>>>>>>> 9f64e7b045f88b60a0adb93d761525d625705b92
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                        stroke="currentColor" class="w-4 h-4">
                        <path strokeLinecap="round" strokeLinejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </div>
                <div
<<<<<<< HEAD
                    class="hover:ml-4 justify-end pr-5 dark:text-white hover:text-purple-500 dark:hover:text-blue-500 w-full dark:bg-gray-800 bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-950 p-3 rounded-full transform ease-in-out duration-300 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path strokeLinecap=" round" strokeLinejoin="round"
                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
                <div
                    class="hover:ml-4 justify-end pr-5 dark:text-white hover:text-purple-500 dark:hover:text-blue-500 w-full dark:bg-gray-800 bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-950 p-3 rounded-full transform ease-in-out duration-300 flex">
=======
                    class="hover:ml-4 justify-end pr-5 text-white hover:text-purple-500 dark:hover:text-blue-500 w-full bg-[#1E293B] p-3 rounded-full transform ease-in-out duration-300 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                    </svg>
                </div>
                <div
                    class="hover:ml-4 justify-end pr-5 text-white hover:text-purple-500 dark:hover:text-blue-500 w-full bg-[#1E293B] p-3 rounded-full transform ease-in-out duration-300 flex">
>>>>>>> 9f64e7b045f88b60a0adb93d761525d625705b92
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                    </svg>
                </div>
<<<<<<< HEAD
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
            <nav v-if="$slots.route" class="flex px-5 py-3 text-gray-700  rounded-lg bg-gray-50 dark:bg-gray-950 mx-4">
                <slot name="route" />
=======
            </div>

        </aside>

        <div :class="['content', contentClasses]"
            class="content ml-12 transform ease-in-out duration-500 pt-20 px-2 md:px-5 pb-4 ">
            <nav class="flex px-5 py-3 text-gray-700  rounded-lg bg-gray-50 dark:bg-[#1E293B] " aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fillRule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clipRule="evenodd"></path>
                            </svg>
                            <a href="#"
                                class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">Templates</a>
                        </div>
                    </li>
                </ol>
>>>>>>> 9f64e7b045f88b60a0adb93d761525d625705b92
            </nav>
            <slot />
        </div>
    </div>
</template>
