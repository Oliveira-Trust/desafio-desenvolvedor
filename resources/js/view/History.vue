<script setup>
import Datatable from "../components/Datatable.vue";
import { onMounted } from "vue";
import useCurrencyConverter from "../stores/currencyConverter.js";

const currencyConverter = useCurrencyConverter();

onMounted(async () => {
    await currencyConverter.findHistory();
});
</script>

<template>
    <div
        class="container pt-24 md:pt-32 px-4 mx-auto flex flex-wrap flex-col md:flex-row items-cente"
    >
        <Datatable :data="currencyConverter.histories" />
    </div>
</template>
