<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';

const form = useForm({
    amount: '',
    currency_destination: '',
    payment_method: '',
});

function handleSubmit() {
    form.post(route('currency.convert'), {
        onSuccess: (e) => {
            form.reset();
        },
    });
}
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <div class="flex items-center justify-center">
                            <span v-if="form.errors.custom" class="mt-1 text-sm text-red-700 text-center">
                            {{ form.errors.custom }}
                          </span>
                        </div>

                        <form @submit.prevent="handleSubmit">
                            <div class="flex flex-col items-center justify-center">
                                <h2 class="font-medium">Quantia a ser convertida</h2>
                                <input class="rounded-md w-[30%] text-center"
                                       v-model="form.amount"
                                       placeholder="Quantia a ser convertida"
                                       autocomplete="off">
                                <div v-if="form.errors.amount">{{ form.errors.amount }}</div>
                            </div>
                            <div class="flex flex-col items-center justify-center mt-4">
                                <svg width="24" height="24" fill="currentColor" focusable="false"
                                     viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                          d="m16.629 11.999-1.2-1.2 3.085-3.086H2.572V5.999h15.942L15.43 2.913l1.2-1.2 4.543 4.543a.829.829 0 0 1 0 1.2l-4.543 4.543Zm-9.257-.001 1.2 1.2-3.086 3.086h15.943v1.714H5.486l3.086 3.086-1.2 1.2-4.543-4.543a.829.829 0 0 1 0-1.2l4.543-4.543Z"
                                          clip-rule="evenodd">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex flex-col items-center justify-center mt-4">
                                <h2 class="font-medium">Converter para</h2>
                                <select class="rounded-md w-[30%] text-center" v-model="form.currency_destination">
                                    <option value="USD" selected>USD</option>
                                    <option value="EUR">EUR</option>
                                </select>
                                <div v-if="form.errors.currency_destination">{{
                                        form.errors.currency_destination
                                    }}
                                </div>
                            </div>
                            <div class="flex flex-col items-center justify-center mt-4">
                                <h2 class="font-medium">Forma de pagamento</h2>
                                <select class="rounded-md w-[30%] text-center" v-model="form.payment_method">
                                    <option value="bank_slip" selected>Boleto</option>
                                    <option value="credit_card">Cartão de crédito</option>
                                </select>
                                <div v-if="form.errors.payment_method">{{ form.errors.payment_method }}</div>
                            </div>
                            <div class="flex flex-col items-center justify-center mt-4">
                                <button
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-[30%]">
                                    Converter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
