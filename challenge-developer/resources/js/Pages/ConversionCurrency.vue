<template>
    <app-layout title="Conversion">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Conversão de moeda
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg">

                    <form @submit.prevent="getHistoryConversions">
                        <div class="col-span-6 sm:col-span-4">

                            <jet-label value="Moeda de origem" />
                            <div class="automation-period-options-field">
                                <select v-model="form.currency_origin">
                                    <option v-for="(option, index) in currency_origin" :key="index" :value="option.value">
                                        {{ option.label }}
                                    </option>
                                </select>
                            </div>

                            <jet-label class="mt-4" value="Moeda de destino" />
                            <div class="automation-period-options-field">
                                <select v-model="form.currency_destiny">
                                    <option v-for="(option, index) in currency_destiny" :key="index" :value="option.value">
                                        {{ option.label }}
                                    </option>
                                </select>
                            </div>

                            <jet-label class="mt-4" value="Valor para conversão" />
                            <div class="automation-period-options-field">
                                <input
                                    id="value"
                                    type="text"
                                    maxlength="9"
                                    v-model="form.value"
                                    class="mt-1 block w-full"
                                />
                                <p v-if="errorText" style="color:red">{{errorText}}</p>
                            </div>

                            <jet-label class="mt-4" value="Forma de pagamento" />
                            <div class="automation-period-options-field">
                                <select v-model="form.payment_method">
                                    <option v-for="(option, index) in payment_method" :key="index" :value="option.value">
                                        {{ option.label }}
                                    </option>
                                </select>
                            </div>

                            <div class="flex items-center justify-start mt-4">
                                <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                                    Conversão realizada com sucesso.
                                </jet-action-message>

                                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Salvar
                                </jet-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import JetActionMessage from '@/Jetstream/ActionMessage.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetFormSection from '@/Jetstream/FormSection.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'

export default defineComponent({
    components: {
        AppLayout,
        JetLabel,
        JetInput,
        JetButton,
        JetFormSection,
        JetInputError,
        JetActionMessage,
    },

    data() {
        return {
            form: this.$inertia.form({
                currency_origin: 'BRL',
                currency_destiny: null,
                payment_method: null,
                value: null,
            }),
            currency_origin: [
                {
                    label: 'BRL',
                    value: 'BRL'
                },
            ],
            currency_destiny: [
                {
                    label: 'USD',
                    value: 'USD'
                },
                {
                    label: 'EUR',
                    value: 'EUR'
                }
            ],
            payment_method: [
                {
                    label: 'Boleto',
                    value: 'ticket'
                },
                {
                    label: 'Cartão de crédito',
                    value: 'credit_card'
                },
            ],
            valueMin: 1000.00,
            valueMax: 100000.00,
            recoveryCodes: [],
        }
    },

    computed: {
        errorText() {
            if (this.form.value != null && this.form.value < this.valueMin) {
                return "O valor deve ser maior que R$ 1.000,00"
            }

            if (this.form.value > this.valueMax) {
                return "Valor máximo deve ser de R$ 100.000,00"
            }
        }
    },

    methods: {
        getHistoryConversions() {
            let value = this.form.value.toString().replace(",", ".")
            this.form.value = parseFloat(value)

            if ( this.form.value < this.valueMin || this.form.value > this.valueMax) {
                return
            }

            this.form.post(this.route('conversion.recordCreationAndCurrencyConversion'), {
                onSuccess: () => Promise.all([
                ]),
                onFinish: () => this.form.reset(),
            })
        },
    }
})

</script>

<style lang="scss" scoped>

.automation-period-options-field {

    input,
    select {
        height: 43px;
        width: 100%;
        display: block;
        padding: 0 1rem;
        border: 1px solid rgb(202, 202, 202);
        border-radius: 4px;
        transition: all .2s;

        &:hover {
            border-color: rgb(197, 194, 194);
        }
    }
}
</style>
