<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref, onMounted, watch, computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import TextArea from '@/Components/TextArea.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    users: Array,
    selectedUser: Object,
    messages: Array,
    currentUserId: Number,
});

const selectedUser = ref(props.selectedUser);
const messages = ref(Array.isArray(props.messages) ? [...props.messages] : []);

const form = useForm({
    recipient_id: selectedUser.value?.id || '',
    content: '',
});

const sendMessage = async () => {
    if (form.content.trim()) {
        try {
            const newMessage = {
                id: Date.now(),
                content: form.content,
                sender_id: props.currentUserId,
                recipient_id: form.recipient_id,
                created_at: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
            };

            messages.value.push(newMessage);

            const response = await form.post('/messages/store');

            if (response.message) {
                newMessage.id = response.message.id;
                messages.value = [...messages.value];
            }
            form.reset('content');
        } catch (error) {
            console.error('Failed to send message:', error);
        }
    }
};

const loadConversation = async (userId) => {
    try {
        const response = await router.get(`/messages/${userId}`);
        if (response && response.props) {
            messages.value = response.props.messages;
        }
    } catch (error) {
        console.error('Failed to load conversation:', error);
    }
};

watch(() => selectedUser.value?.id, (newUserId) => {
    if (newUserId) {
        loadConversation(newUserId);
        form.recipient_id = newUserId;
    }
}, { immediate: true });

const selectUser = async (userId) => {
    const user = props.users.find(u => u.id === userId);
    if (user) {
        selectedUser.value = user;
    }
};

onMounted(() => {
    if (selectedUser.value) {
        loadConversation(selectedUser.value.id);
        form.recipient_id = selectedUser.value.id;
    }
});

const isOpen = ref(false);

const toggleSidebar = () => {
    isOpen.value = !isOpen.value;
};

function formatDate(dateString) {
    const now = new Date();
    const date = new Date(dateString);

    if (isNaN(date.getTime())) {
        return "Just now";
    }

    const diff = now - date;

    if (diff < 60 * 1000) {
        return "Just now";
    }

    return date.toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
    });
}

</script>

<template>

    <Head title="Messages" />

    <!-- Sidebar -->
    <aside :class="[
            'fixed top-0 left-0 bottom-0 z-[60] w-96 bg-white dark:bg-gray-950 border-e border-gray-200 dark:border-gray-800 overflow-y-auto transition-transform duration-300',
            isOpen ? 'translate-x-0' : '-translate-x-full',
            'lg:block lg:translate-x-0 lg:end-auto lg:bottom-0'
        ]">
        <nav class="size-full flex flex-col">
            <div class="flex items-center justify-between pt-4 pe-4 ps-7">
                <Link :href="route('home')">
                <ApplicationLogo class="flex items-center h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                </Link>
            </div>

            <div class="h-full">
                <ul class="space-y-1.5 p-4">
                    <li v-for="user in users" :key="user.id" class="border-b dark:border-gray-700">
                        <Link :href="`/messages/${user.id}`"
                            class="block m-2 p-4 bg-white dark:bg-gray-950 text-black rounded-lg shadow-md hover:bg-gray-100 dark:hover:bg-gray-900"
                            @click.prevent="selectUser(user.id)">
                        <p class="font-semibold dark:text-gray-50">{{ user.name }}</p>
                        <div v-if="user.latestMessage" class="text-gray-500 dark:text-gray-200">
                            <p class="text-gray-400 dark:text-gray-500">{{ user.latestMessage.content }}</p>
                            <p class="flex justify-end text-xs text-gray-300">
                                {{ formatDate(user.latestMessage.created_at) }}
                            </p>
                        </div>
                        <p v-else class="text-gray-400">No messages yet</p>
                        </Link>
                    </li>
                </ul>
            </div>

            <div class="mt-auto">
                <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                    <Link v-if="$page.props.auth.user.role_id === 2"
                        class="flex w-full justify-between items-center gap-x-3 py-2 px-3 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:hover:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300 dark:focus:text-gray-300"
                        :href="route('campus.logout')" method="post" as="button">
                    Logout
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                        <polyline points="10 17 15 12 10 7" />
                        <line x1="15" x2="3" y1="12" y2="12" />
                    </svg>
                    </Link>
                    <Link v-else-if="$page.props.auth.user.role_id === 3"
                        class="flex justify-between items-center gap-x-3 py-2 px-3 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:hover:bg-gray-900 dark:text-gray-400 dark:hover:text-gray-300 dark:focus:text-gray-300"
                        :href="route('external.logout')" method="post" as="button">
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
        </nav>
    </aside>

    <div v-if="selectedUser" class="relative h-screen">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="sticky top-0 z-10 border-b dark:border-gray-800 bg-white dark:bg-gray-900 pb-6 text-center">
                <a class="mb-4 inline-block flex-none focus:opacity-80 focus:outline-none"
                    href="../examples/html/ai-with-sidebar.html" aria-label="Preline"> </a>

                <h1 class="text-3xl font-bold text-gray-800 dark:text-white sm:text-4xl">Conversation with {{
                    selectedUser.name }}</h1>
                <p class="mt-3 text-gray-600 dark:text-gray-400">{{ selectedUser.department }}</p>
            </div>

            <div v-if="messages.length">
                <ul class="mt-16 space-y-5" v-for="message in messages" :key="message.id">
                    <li class="flex items-start gap-2.5" v-if="message.sender_id !== props.currentUserId">
                        <span
                            class="inline-flex size-[38px] shrink-0 items-center justify-center rounded-full bg-gray-600">
                            <span class="text-sm font-medium leading-none text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6">
                                    <path fill-rule="evenodd"
                                        d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>

                        <div class="flex flex-col gap-1 w-full max-w-[320px]">
                            <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ selectedUser.name }}</span>
                                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ formatDate(message.created_at) }}
                                </span>
                            </div>

                            <div
                                class="flex flex-col leading-5 p-4 border border-gray-200 bg-gray-100 rounded-xl dark:bg-gray-700 dark:border-gray-600">
                                <!-- Message Content -->
                                <p class="text-sm font-normal text-gray-900 dark:text-white">
                                    {{ message.content }}
                                </p>

                                <!-- Link Section -->
                                <div v-if="message.content_link" class="space-y-2">
                                    <!-- Link Text -->
                                    <p class="text-sm font-normal text-gray-900 dark:text-white">
                                        <Link :href="message.content_link" target="_blank" rel="noopener noreferrer"
                                            class="text-blue-700 dark:text-blue-500 underline hover:no-underline font-medium break-all">
                                        {{ message.content_link }}
                                        </Link>
                                    </p>

                                    <!-- Link Preview Card -->
                                    <Link :href="message.content_link"
                                        class="block bg-gray-50 dark:bg-gray-600 rounded-xl p-4 hover:bg-gray-200 dark:hover:bg-gray-500">
                                    <!-- Thumbnail -->
                                    <div v-if="message.content_link_image" class="w-full">
                                        <img :src="message.content_link_image" alt="Content Image"
                                            class="rounded-lg mb-2" />
                                    </div>
                                    <!-- Link Metadata -->
                                    <div class="space-y-1">
                                        <span class="block text-sm font-medium text-gray-900 dark:text-white">
                                            {{ message.content_title }}
                                        </span>
                                        <span class="block text-xs text-gray-500 dark:text-gray-400">
                                            {{ message.content_link_description }}
                                        </span>
                                    </div>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Chat Bubble (for sender) -->
                    <li class="flex items-start justify-end gap-2.5" v-if="message.sender_id === props.currentUserId">
                        <div class="flex flex-col gap-1 w-full max-w-[320px]">
                            <div class="flex items-center space-x-2 ltr:space-x-reverse">
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">You</span>
                                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ formatDate(message.created_at) }}
                                </span>
                            </div>
                            <div
                                class="flex flex-col leading-5 p-4 border border-gray-200 bg-gray-100 rounded-xl dark:bg-gray-700 dark:border-gray-600">
                                <!-- Message Content -->
                                <p class="text-sm font-normal text-gray-900 dark:text-white">
                                    {{ message.content }}
                                </p>

                                <!-- Link Section -->
                                <div v-if="message.content_link" class="space-y-2">
                                    <!-- Link Text -->
                                    <p class="text-sm font-normal text-gray-900 dark:text-white">
                                        <Link :href="message.content_link" target="_blank" rel="noopener noreferrer"
                                            class="text-blue-700 dark:text-blue-500 underline hover:no-underline font-medium break-all">
                                        {{ message.content_link }}
                                        </Link>
                                    </p>

                                    <!-- Link Preview Card -->
                                    <Link :href="message.content_link"
                                        class="block bg-gray-50 dark:bg-gray-600 rounded-xl p-4 hover:bg-gray-200 dark:hover:bg-gray-500">
                                    <!-- Thumbnail -->
                                    <div v-if="message.content_link_image" class="w-full">
                                        <img :src="message.content_link_image" alt="Content Image"
                                            class="rounded-lg mb-2" />
                                    </div>
                                    <!-- Link Metadata -->
                                    <div class="space-y-1">
                                        <span class="block text-sm font-medium text-gray-900 dark:text-white">
                                            {{ message.content_title }}
                                        </span>
                                        <span class="block text-xs text-gray-500 dark:text-gray-400">
                                            {{ message.content_link_description }}
                                        </span>
                                    </div>
                                    </Link>
                                </div>
                            </div>
                        </div>
                        <span v-if="message.sender_id === props.currentUserId"
                            class="inline-flex size-[38px] shrink-0 items-center justify-center rounded-full bg-purple-600">
                            <span class="text-sm font-medium leading-none text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6">
                                    <path fill-rule="evenodd"
                                        d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    </li>
                </ul>
            </div>

            <div v-else>
                <p class="text-gray-400">No messages yet.</p>
            </div>
        </div>

        <div class="max-w-4xl mx-auto sticky bottom-0 z-10 p-3 sm:py-6">
            <div class="lg:hidden flex justify-end mb-2 sm:mb-3">
                <button @click="toggleSidebar"
                    class="p-2 inline-flex items-center gap-x-2 text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:bg-gray-800">
                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <line x1="3" x2="21" y1="6" y2="6" />
                        <line x1="3" x2="21" y1="12" y2="12" />
                        <line x1="3" x2="21" y1="18" y2="18" />
                    </svg>
                    <span>Sidebar</span>
                </button>
            </div>

            <div>
                <form @submit.prevent="sendMessage" class="relative">
                    <TextArea v-model="form.content" name="content"
                        class="p-4 pb-12 block w-full bg-gray-100 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:placeholder-gray-500 dark:focus:ring-gray-600"
                        placeholder="Type a message..."></TextArea>

                    <div class="absolute bottom-px inset-x-px p-2 rounded-b-lg bg-gray-100 dark:bg-gray-800">
                        <div class="flex justify-end items-center">
                            <!-- Button Group -->
                            <div class="flex items-center gap-x-1">
                                <button type="button"
                                    class="inline-flex shrink-0 justify-center items-center size-8 rounded-lg text-gray-500 hover:bg-white focus:z-10 focus:outline-none focus:bg-white dark:text-gray-500 dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="m21.44 11.05-9.19 9.19a6 6 0 0 1-8.49-8.49l8.57-8.57A4 4 0 1 1 18 8.84l-8.59 8.57a2 2 0 0 1-2.83-2.83l8.49-8.48" />
                                    </svg>
                                </button>

                                <SecondaryButton type="submit"
                                    class="inline-flex shrink-0 justify-center items-center size-8 rounded-lg text-white bg-blue-600 hover:bg-blue-500 focus:z-10 focus:outline-none focus:bg-blue-500">
                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                                    </svg>
                                </SecondaryButton>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
