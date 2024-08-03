<script setup lang="ts">
import { mdiPlus } from '@mdi/js';
import CreateExchange from '../components/CreateExchange.vue';
import ExchangesTable from '../components/ExchangesTable.vue';
</script>

<template>
    <div>
        <div class="header">
            <div class="header__title">Conversões</div>
            <CreateExchange>
                <template #activator="{ props }">
                    <VBtn
                        v-bind="props"
                        :prepend-icon="mdiPlus"
                        text="Nova conversão"
                        variant="flat"
                        color="primary"
                        rounded="lg"
                    />
                </template>
            </CreateExchange>
        </div>
        <ExchangesTable />
    </div>
</template>

<style scoped lang="scss">
.header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
    &__title {
        font-size: 24px;
        font-weight: 500;
        text-transform: uppercase;
    }
}
</style>
