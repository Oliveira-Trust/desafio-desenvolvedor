<script setup lang="ts">
import { VSelect } from 'vuetify/components';
import InputField from './InputField.vue';

defineOptions({
    inheritAttrs: false,
});
</script>

<template>
    <InputField v-bind="$attrs" :component="VSelect">
        <template v-for="(_, slot) of $slots" v-slot:[slot]="scope">
            <slot :name="slot" v-bind="scope" />
        </template>
    </InputField>
</template>

<style scoped lang="scss"></style>
