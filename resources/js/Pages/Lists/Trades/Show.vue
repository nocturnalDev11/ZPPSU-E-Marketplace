<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import TextArea from '@/Components/TextArea.vue';
import Modal from '@/Components/Modal.vue';
// import Delete from './Partials/Delete.vue';
import AuthUsersLayout from '@/Layouts/AuthUsersLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    trade: {
        type: Object,
        required: true
    },
    isAuthorized: {
        type: Boolean,
        default: false,
    },
    message: {
        type: Object,
        required: true
    },
    relatedTrades: Array,
});

const form = useForm({
    recipient_id: props.trade.user.id,
    content: 'Is this available?',
    content_title: props.trade.trade_title,
    content_link: route('trades.show', props.trade.id),
    content_link_image: props.trade.trade_picture,
    content_link_description: props.trade.trade_description,
});

const submitMessage = () => {
    form.post(route('message.storeListInquiry'), {
        onSuccess: () => {
            closeModal();
            form.reset();
        },
    });
};

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });
}

const showModal = ref(false);

const closeModal = () => {
    showModal.value = false;
    form.clearErrors();
    form.reset();
};
</script>

<template>

    <Head :title="trade.trade_title" />

    <AuthUsersLayout v-if="isAuthorized">
        You are authorized
    </AuthUsersLayout>

    <GuestLayout v-else>

    </GuestLayout>
</template>
