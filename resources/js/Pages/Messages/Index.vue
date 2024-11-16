<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref, onMounted, watch } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import TextArea from '@/Components/TextArea.vue';
import AuthUsersLayout from '../../Layouts/AuthUsersLayout.vue';

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
</script>

<template>

    <Head title="Messages" />
    <AuthUsersLayout>
        <div class="flex space-x-6 p-6 bg-gray-800 text-white min-h-screen">
            <!-- Contacts Sidebar -->
            <div class="w-1/4">
                <h2 class="text-xl font-bold mb-4">Contacts</h2>
                <div v-for="user in users" :key="user.id" class="mb-4">
                    <Link :href="`/messages/${user.id}`"
                        class="block p-4 bg-white text-black rounded-lg shadow-md hover:bg-gray-100"
                        @click.prevent="selectUser(user.id)">
                    <p class="font-semibold">{{ user.name }}</p>
                    <p v-if="user.latestMessage" class="text-gray-500">
                        {{ user.latestMessage.content }}
                    </p>
                    <p v-else class="text-gray-400">No messages yet</p>
                    </Link>
                </div>
            </div>

            <div v-if="selectedUser" class="w-3/4">
                <h3 class="text-xl font-semibold mb-4">
                    Conversation with {{ selectedUser.name }}
                </h3>

                <div v-if="messages.length" class="space-y-4">
                    <div v-for="message in messages" :key="message.id" class="flex flex-col items-center">
                        <div :class="[
                            message.sender_id === currentUserId
                                ? 'bg-blue-600 text-white self-end'
                                : 'bg-gray-700 text-white self-start',
                            'p-3 rounded-full max-w-xs'
                        ]">

                            <p>{{ message.content }}</p>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">{{ message.created_at }}</p>
                    </div>
                </div>

                <div v-else>
                    <p class="text-gray-400">No messages yet.</p>
                </div>

                <div class="mt-4 flex items-center space-x-4">
                    <form @submit.prevent="sendMessage" class="flex-grow">
                        <TextArea v-model="form.content" name="content" class="bg-gray-900 text-white p-2 rounded-md" />
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </AuthUsersLayout>
</template>

<style scoped>
.bg-blue-600 {
    background-color: #0078FF;
}

.bg-gray-700 {
    background-color: #444444;
}
</style>
