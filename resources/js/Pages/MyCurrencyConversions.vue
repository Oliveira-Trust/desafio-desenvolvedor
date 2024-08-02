<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import CurrencyConverter from "@/Components/CurrencyConverter.vue";
import CurrencyConversionCard from "@/Components/CurrencyConversionCard.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
defineProps({
    
    currencyConversions: Object,
    errors: Object,
});
const handleCustomEvent = (payload) => {
    console.log(payload);
    router.visit(route("conversao.store"), {
        method: "post",
        data: payload,
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
                Minhas Conversões
            </h2>
        </template>
        
        <div class="py-20 px-4">
            <div
                class="flex justify-center mb-5"
                v-if="currencyConversions.data.length > 0"
                v-for="currencyConversion in currencyConversions.data"
            >
                <CurrencyConversionCard
                    :key="currencyConversion.id"
                    :currencyConversion="currencyConversion"
                />
            </div>
            <div class="flex items-center justify-center">
                <Pagination :links="currencyConversions.meta.links" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
