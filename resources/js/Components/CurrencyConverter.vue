<template>
    <div
        class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
    >
        <a href="#">
            <h5
                class="mb-10 text-2xl font-bold tracking-tight text-center text-gray-900 dark:text-white"
            >
                Conversor de moeda
            </h5>
        </a>

        <form class="max-w-sm mx-auto" @submit.prevent="handleClick">
            <div class="relative z-0">
                <input
                    v-model.lazy="valorFormatado"
                    v-money3="config"
                    type="text"
                    :class="
                        errors.amount
                            ? ' border-red-600 appearance-none dark:text-white dark:border-red-500 dark:focus:border-red-500  focus:border-red-600 '
                            : ''
                    "
                    class="block py-2.5 px-0 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-green-500 focus:outline-none focus:ring-0 focus:border-green-600 peer"
                    placeholder=" "
                />
                <label
                    :class="
                        errors.amount ? '  text-red-600 dark:text-red-500 ' : ''
                    "
                    class="absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-green-600 peer-focus:dark:text-green-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto"
                    >Valor</label
                >
                <p
                    id="outlined_error_help"
                    class="mt-2 text-base text-red-600 dark:text-red-400"
                >
                    {{ errors.amount }}
                </p>
            </div>
            <div class="flex justify-between items-center pt-12 space-x-3">
                <div>
                    <input
                        value="Real"
                        readonly
                        type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-300 focus:border-gray-300 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    />
                </div>
                <Icon icon="material-symbols:arrow-right-alt" />

                <div>
                    <select
                        v-model="form.currency_destination"
                        :class="
                            errors.currency_destination
                                ? 'bg-red-50  border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500  dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                : ''
                        "
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                    >
                        <option disabled value="">Selecione a moeda</option>
                        <option
                            v-for="currency of currencies"
                            :value="currency.name"
                            :key="currency.name"
                        >
                            {{ currency.value }}
                        </option>
                    </select>
                    <span class="mt-2 text-sm text-red-600 dark:text-red-500">{{
                        errors.currency_destination
                    }}</span>
                </div>
            </div>
            <div>
                <div class="max-w-sm mx-auto pt-6">
                    <label
                        :class="
                            errors.payment_method
                                ? ' text-red-700 dark:text-red-500'
                                : ''
                        "
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Método de pagamento</label
                    >
                    <select
                        v-model="form.payment_method"
                        :class="
                            errors.payment_method
                                ? 'bg-red-50  border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500  dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                                : ''
                        "
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                    >
                        <option disabled value="">
                            Selecione o método de pagamento
                        </option>
                        <option :value="paymentMethod.id" v-for="paymentMethod in paymentMethods" :key="paymentMethod.id">
                            {{ paymentMethod.name }} - taxa de {{paymentMethod.fee_percentage  }}
                        </option>
                       
                    </select>
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                        {{ errors.payment_method }}
                    </p>
                </div>
            </div>
            <div class="flex justify-center pt-12">
                <button
                    type="submit"
                    class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-400 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800"
                >
                    Converter
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { defineEmits } from "vue";
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import { watch } from "vue";
import { ref } from "vue";
import { Money3Directive, format } from "v-money3";

import { Icon } from "@iconify/vue";


defineProps({
    errors: Object,
    paymentMethods: Array,
    currencies: Array
});
const valorFormatado = ref("");





const form = ref({
    amount: "",
    currency_destination: "USD",
    payment_method: "",
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

const removeFormatting = (value) => {
    // Remover milhar e decimal para converter o valor para um número
    return value.replace("R$ ", "").replace(/\./g, "").replace(",", ".");
};

// Watch para monitorar mudanças no valor formatado
watch(valorFormatado, (newValue) => {
    form.value.amount = removeFormatting(newValue);
});

const emit = defineEmits(["conversion-event"]);
const handleClick = () => {
    
    emit("conversion-event", form.value);
};
onMounted(() => {
    initFlowbite();
    
});
</script>
