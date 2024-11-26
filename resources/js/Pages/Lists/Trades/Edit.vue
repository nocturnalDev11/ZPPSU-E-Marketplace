<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthUsersLayout from '@/Layouts/AuthUsersLayout.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import TextArea from '@/Components/TextArea.vue';

const props = defineProps({
    trade: Object,
});

const form = useForm({
    trade_title: props.trade.trade_title || '',
    trade_category: props.trade.trade_category || '',
    trade_description: props.trade.trade_description || '',
    trade_status: props.trade.trade_status || '',
    trade_type: props.trade.trade_type || '',
    trade_value: props.trade.trade_value || 0,
    trade_conditions: props.trade.trade_conditions || '',
    trade_duration: props.trade.trade_duration || '',
});

const updateTrade = () => {
    form.put(route('trades.update', props.trade.id), {
        onSuccess: () => {
            console.log('Trade updated successfully');
            form.reset();
        },
        onError: (errors) => {
            console.error('Error updating trade:', errors);
        },
    });
};

</script>

<template>

    <Head title="Edit trade" />

    <AuthUsersLayout>
        <div class="min-h-screen flex flex-col items-center justify-center px-4">
            <div class="max-w-2xl w-full">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 pb-3">Edit Product</h2>

                <form @submit.prevent="updateTrade" class="space-y-4">
                    <div>
                        <InputLabel for="trade_title" value="Title" />
                        <TextInput id="trade_title" v-model="form.trade_title" class="mt-1 block w-full"
                            placeholder="Title" />
                        <InputError :message="form.errors.trade_title" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="trade_category" value="Category" />
                        <select id="trade_category" v-model="form.trade_category"
                            class="mt-1 block w-full text-gray-400 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50">
                            <option value="" selected>Select category</option>
                            <option value="Apparel">Apparel</option>
                            <option value="School supplies">School Supplies</option>
                            <option value="Electronics">Electronics</option>
                            <option value="Stationery">Stationery</option>
                            <option value="University merchandise">University Merchandise</option>
                            <option value="Musical Instruments">Musical Instruments</option>
                            <option value="Books">Books</option>
                            <option value="Others">Others</option>
                        </select>
                        <InputError :message="form.errors.trade_category" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="trade_description" value="Description" />
                        <TextArea id="trade_description" v-model="form.trade_description" class="mt-1 block w-full"
                            rows="3" placeholder="Description"></textarea>
                        <InputError :message="form.errors.trade_description" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <InputLabel for="trade_status" value="Status" />
                            <select id="trade_status" v-model="form.trade_status"
                                class="mt-1 block w-full text-gray-400 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50">
                                <option value="" selected>Select status</option>
                                <option value="Available">Available</option>
                                <option value="Completed">Completed</option>
                                <option value="Cancelled">Cancelled</option>
                                <option value="Closed">Closed</option>
                            </select>
                            <InputError :message="form.errors.trade_status" class="mt-2" />
                        </div>

                        <div>
                            <InputLabel for="trade_type" value="Type" />
                            <select id="trade_type" v-model="form.trade_type"
                                class="mt-1 block w-full text-gray-400 text-sm border border-gray-300 px-4 py-3 rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300 dark:text-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:focus:border-gray-500 dark:focus:ring-2 dark:focus:ring-gray-500 dark:focus:ring-offset-0 dark:focus:ring-opacity-50">
                                <option value="" selected>Select type</option>
                                <option value="Buy">Buy</option>
                                <option value="Sell">Sell</option>
                                <option value="Exchange">Exchange</option>
                                <option value="Donation">Donation</option>
                                <option value="Rental">Rental</option>
                                <option value="Service offering">Service Offering</option>
                                <option value="Service request">Service Request</option>
                                <option value="Barter">Barter</option>
                            </select>
                            <InputError :message="form.errors.trade_type" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <InputLabel for="trade_value" value="Value" />
                        <TextInput id="trade_value" v-model="form.trade_value" type="number" class="mt-1 block w-full"
                            placeholder="Trading value" />
                        <InputError :message="form.errors.trade_value" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="trade_conditions" value="Conditions" />
                        <TextArea id="trade_conditions" v-model="form.trade_conditions" class="mt-1 block w-full"
                            rows="3" placeholder="Conditions"></textarea>
                        <InputError :message="form.errors.trade_conditions" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="trade_duration" value="Duration" />
                        <TextInput id="trade_duration" v-model="form.trade_duration" type="date"
                            class="mt-1 block w-full" />
                        <InputError :message="form.errors.trade_duration" class="mt-2" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                        <SecondaryButton class="ms-3" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing" type="submit">
                            Update Trade
                        </SecondaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthUsersLayout>
</template>
