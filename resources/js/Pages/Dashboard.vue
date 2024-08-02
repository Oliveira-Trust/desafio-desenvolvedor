<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import CurrencyConverter from "@/Components/CurrencyConverter.vue";
import CurrencyConversionCard from "@/Components/CurrencyConversionCard.vue";
import { ref } from "vue";
import { useToast } from "vue-toast-notification";
import { router } from "@inertiajs/vue3";

defineProps({
    currencies: Array,
    paymentMethods: Array,
    currencyConversions: Array,
    errors: Object,
});

const $toast = useToast();
const handleCustomEvent = (payload) => {
    console.log(payload);
    router.visit(route("conversao.store"), {
        method: "post",
        data: payload,
        onSuccess: () => {

            $toast.success("Conversão Realizada com Sucesso");
        }
    });
};



</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Conversão
            </h2>
        </template>
       
        <div class="py-20 px-4">
            <div class="">
                <div class="flex justify-center">
                    <CurrencyConverter
                        class=""
                        @conversion-event="handleCustomEvent"
                        :errors="errors"
                        :paymentMethods="paymentMethods"
                        :currencies="currencies"
                    />
                </div>
                <h5 class="text-2xl mb-3 text-center pt-12">Últimas Conversões</h5>
                <div
                    class="flex justify-center mb-5"
                    v-if="currencyConversions.length > 0"
                    v-for="currencyConversion in currencyConversions"
                >
                    <CurrencyConversionCard
                        :key="currencyConversion.id"
                        :currencyConversion="currencyConversion"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
