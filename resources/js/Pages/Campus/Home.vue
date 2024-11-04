<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthUsersLayout from '../../Layouts/AuthUsersLayout.vue';
</script>

<template>
    <AuthUsersLayout>

        <Head title="Home" />
        <div class="px-4 md:px-10 mx-auto w-full">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                <!-- Card 1 -->
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white rounded-xl mb-6 xl:mb-0 shadow-lg h-52 dark:bg-gray-700 dark:backdrop:filter dark:backdrop-blur-2xl dark:bg-opacity-20">
                    <div class="flex-auto p-4 flex flex-col justify-between h-full">
                        <div>
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-gray-700 uppercase font-bold text-md dark:text-gray-50">
                                        PRODUCTS</h5>
                                    <span class="font-semibold text-sm text-gray-500 dark:text-gray-300">
                                        Browse through a variety of products available for sale within the
                                        university community.
                                    </span>
                                </div>
                                <div class="relative w-auto pl-4 flex-initial">
                                    <div
                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l">
                                        <svg class="w-8 h-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="currentColor">
                                            <path fill="#ffffff" fill-rule="evenodd"
                                                d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 0 0 4.25 22.5h15.5a1.875 1.875 0 0 0 1.865-2.071l-1.263-12a1.875 1.875 0 0 0-1.865-1.679H16.5V6a4.5 4.5 0 1 0-9 0ZM12 3a3 3 0 0 0-3 3v.75h6V6a3 3 0 0 0-3-3Zm-3 8.25a3 3 0 1 0 6 0v-.75a.75.75 0 0 1 1.5 0v.75a4.5 4.5 0 1 1-9 0v-.75a.75.75 0 0 1 1.5 0v.75Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <Link href="#"
                            class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        View all
                        </Link>
                    </div>
                </div>

                <!-- Card 2 -->
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white rounded-xl mb-6 xl:mb-0 shadow-lg h-52 dark:bg-gray-700 dark:backdrop:filter dark:backdrop-blur-2xl dark:bg-opacity-20">
                    <div class="flex-auto p-4 flex flex-col justify-between h-full">
                        <div>
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-gray-700 uppercase font-bold text-md dark:text-gray-50">
                                        SERVICES</h5>
                                    <span class="font-semibold text-sm text-gray-500 dark:text-gray-300">
                                        Discover a wide range of services offered by your peers and faculty.
                                    </span>
                                </div>
                                <div class="relative w-auto pl-4 flex-initial">
                                    <div
                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl">
                                        <svg class="w-8 h-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24">
                                            <path fill="#ffffff" fill-rule="evenodd"
                                                d="M12 2a7 7 0 0 0-7 7 3 3 0 0 0-3 3v2a3 3 0 0 0 3 3h1a1 1 0 0 0 1-1V9a5 5 0 1 1 10 0v7.083A2.919 2.919 0 0 1 14.083 19H14a2 2 0 0 0-2-2h-1a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h1a2 2 0 0 0 1.732-1h.351a4.917 4.917 0 0 0 4.83-4H19a3 3 0 0 0 3-3v-2a3 3 0 0 0-3-3 7 7 0 0 0-7-7Zm1.45 3.275a4 4 0 0 0-4.352.976 1 1 0 0 0 1.452 1.376 2.001 2.001 0 0 1 2.836-.067 1 1 0 1 0 1.386-1.442 4 4 0 0 0-1.321-.843Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <Link href="#"
                            class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        View all
                        </Link>
                    </div>
                </div>

                <!-- Card 3 -->
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white rounded-xl mb-6 xl:mb-0 shadow-lg h-52 dark:bg-gray-700 dark:backdrop:filter dark:backdrop-blur-2xl dark:bg-opacity-20">
                    <div class="flex-auto p-4 flex flex-col justify-between h-full">
                        <div>
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-gray-700 uppercase font-bold text-md dark:text-gray-50">
                                        POSTS</h5>
                                    <span class="font-semibold text-sm text-gray-500 dark:text-gray-300">
                                        Explore the latest listings and announcements from fellow students,
                                        staff, and faculty.
                                    </span>
                                </div>
                                <div class="relative w-auto pl-4 flex-initial">
                                    <div
                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl">
                                        <svg class="w-8 h-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path fill="#ffffff" fill-rule="evenodd"
                                                d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6Zm4.996 2a1 1 0 0 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 8a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Zm-4.004 3a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 11a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Zm-4.004 3a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 14a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <Link href="#"
                            class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        View all
                        </Link>
                    </div>
                </div>

                <!-- Card 4 -->
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white rounded-xl mb-6 xl:mb-0 shadow-lg h-52 dark:bg-gray-700 dark:backdrop:filter dark:backdrop-blur-2xl dark:bg-opacity-20">
                    <div class="flex-auto p-4 flex flex-col justify-between h-full">
                        <div>
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-gray-700 uppercase font-bold text-md dark:text-gray-50">
                                        TRADES</h5>
                                    <span class="font-semibold text-sm text-gray-500 dark:text-gray-300">
                                        Manage your transactions and profile settings conveniently.
                                    </span>
                                </div>
                                <div class="relative w-auto pl-4 flex-initial">
                                    <div
                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl">
                                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            aria-hidden="true" viewBox="0 0 24 24">
                                            <path fill="#ffffff"
                                                d="m13,2C13,.895,13.895,0,14.999,0l4.001-.002c1.105,0,2.001.895,2.001,2v2.005c0,1.104-.894,1.999-1.998,2l-2.498.002-2.288,1.87c-.526.336-1.215-.041-1.215-.665l-.002-5.209Zm-2,0C11,.895,10.105,0,9.001,0l-4.001-.002c-1.105,0-2.001.895-2.001,2v2.005c0,1.104.894,1.999,1.998,2l2.498.002,2.288,1.87c.526.336,1.215-.041,1.215-.665l.002-5.209Zm12,9.003c.552,0,1,.448,1,1v7c0,.552-.448,1-1,1h-2.814l-7.188-6.436-2.309,2.142c-.207.208-.493.315-.788.29-.298-.024-.56-.175-.739-.425-.274-.38-.19-.975.181-1.347l3.369-3.302c.667-.627,1.397-.923,2.288-.923.662,0,1.65.297,2.403.594.69.273,1.424.406,2.166.406h3.431Zm-9.993,5.255l4.778,4.279-3.381,2.639c-.687.536-1.533.827-2.404.827h0c-.871,0-1.717-.291-2.404-.827l-2.98-2.326c-.703-.549-1.569-.847-2.461-.847H1c-.552,0-1-.448-1-1v-7c0-.552.448-1,1-1h3.521c.768,0,1.525-.149,2.238-.434s1.578-.566,2.218-.566c.526,0,1.025.126,1.482.34l-2.533,2.473c-1.066,1.068-1.232,2.759-.389,3.926.52.724,1.321,1.179,2.192,1.25.086.008.173.012.259.012.792,0,1.549-.312,2.084-.85l.935-.895Z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <Link href="#"
                            class="text-white bg-gradient-to-br from-green-400 to-blue-600 dark:from-green-300 dark:to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        View all
                        </Link>
                    </div>
                </div>
            </div>
        </div>

    </AuthUsersLayout>
</template>
