<template>
    <Head title="teste" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Taxa de Conversão - Editar
            </h2>
        </template>
        <pre></pre>
        <div class="py-12 px-4">
            <p
                class="mb-3 mt-3 font-normal text-lg text-gray-700 dark:text-gray-400 text-center"
            >
                Taxa de
                <span class="text-green-500 font-bold"
                    >{{ form.rate_less_than }}%</span
                >
                para conversão de valores abaixo de
                <span class="text-green-500 font-bold">{{
                    valorFormatado
                }}</span>
                e
                <span class="text-green-500 font-bold"
                    >{{ form.rate_greater_than }}%</span
                >
                para valores iguais ou superiores a
                <span class="text-green-500 font-bold">{{
                    valorFormatado
                }}</span
                >.
            </p>
            <div class="flex justify-center">
                <div
                    class="xl:w-1/4 md:w-1/2 lg:w-1/3 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                >
                    <form
                        class="mx-auto"
                        @submit.prevent="
                            form.put(
                                route('taxa-conversao.update', {
                                    taxa_conversao: conversionRate.id,
                                }),
                                {
                                    onSuccess: () => {
                                        sendNotificationSuccess();
                                    },
                                }
                            )
                        "
                    >
                        <div class="mb-5">
                            <label
                                :class="
                                    form.errors.currency_value
                                        ? ' text-red-700 dark:text-red-500'
                                        : ''
                                "
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Valor para comparar</label
                            >
                            <input
                                type="text"
                                v-model.lazy="valorFormatado"
                                v-money3="config"
                                :class="
                                    form.errors.currency_value
                                        ? 'bg-red-50  border-red-500 text-red-900 placeholder-red-700  focus:ring-red-500 focus:border-red-500  dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                        : ''
                                "
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                required
                            />
                            <p
                                class="mt-2 text-sm text-red-600 dark:text-red-500"
                            >
                                {{ form.errors.currency_value }}
                            </p>
                        </div>

                        <div
                            class="flex justify-between space-x-12 items-center mb-12"
                        >
                            <div class="">
                                <label
                                    :class="
                                        form.errors.rate_less_than
                                            ? ' text-red-700 dark:text-red-500'
                                            : ''
                                    "
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Taxa para valores menores que
                                    {{ valorFormatado }}</label
                                >
                                <input
                                    type="number"
                                    min="0"
                                    v-model="form.rate_less_than"
                                    :class="
                                        form.errors.rate_less_than
                                            ? 'bg-red-50  border-red-500 text-red-900 placeholder-red-700  focus:ring-red-500 focus:border-red-500  dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                            : ''
                                    "
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                    required
                                />
                            </div>
                            <div class="">
                                <label
                                    :class="
                                        form.errors.rate_greater_than
                                            ? ' text-red-700 dark:text-red-500'
                                            : ''
                                    "
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Taxa para valores iguais ou superiores a
                                    {{ valorFormatado }}</label
                                >
                                <input
                                    v-model="form.rate_greater_than"
                                    type="number"
                                    min="0"
                                    :class="
                                        form.errors.rate_greater_than
                                            ? 'bg-red-50  border-red-500 text-red-900 placeholder-red-700  focus:ring-red-500 focus:border-red-500  dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                            : ''
                                    "
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                    required
                                />
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <button
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                                type="submit"
                                class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-400 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800"
                            >
                                Atualizar a Taxa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import { initFlowbite } from "flowbite";
import { watch } from "vue";
import { ref } from "vue";
import { useToast } from "vue-toast-notification";

import { onMounted } from "vue";
const props = defineProps({
    conversionRate: Object,
});
const $toast = useToast();
const valorFormatado = ref(props.conversionRate.currency_value);
const form = useForm({
    rate_greater_than: props.conversionRate.rate_greater_than,
    rate_less_than: props.conversionRate.rate_less_than,
    currency_value: props.conversionRate.currency_value,
});

const config = ref({
    prefix: "R$ ",
    suffix: "",
    thousands: ".",
    decimal: ",",
    precision: 2,
    disableNegative: false,
    disabled: false,
    min: null,
    max: null,
    allowBlank: false,
    minimumNumberOfCharacters: 0,
    shouldRound: true,
    focusOnRight: false,
});

function sendNotificationSuccess() {
    $toast.success("Taxa Mudada Com Sucesso");
}
const removeFormatting = (value) => {
    // Remover milhar e decimal para converter o valor para um número
    return value.replace("R$ ", "").replace(/\./g, "").replace(",", ".");
};
watch(valorFormatado, (newValue) => {
    form.currency_value = removeFormatting(newValue);
});
onMounted(() => {
    initFlowbite();
});
</script>
