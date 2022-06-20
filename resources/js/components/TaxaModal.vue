<template>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black bg-opacity-25"/>
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
                        <DialogPanel class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
                            <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">{{ isEdit ? 'Editar taxa' : 'Cadastrar taxa' }}</DialogTitle>

                            <form @submit.prevent="submit" class="mt-2">
                                <div class="input-form" :class="{'has-errors': getError(this.errors, 'fee_type_id') !== ''}">
                                    <label>Qual o tipo de taxa?</label>
                                    <div class="input-form-row no-shadow">
                                        <div class="flex mr-10 items-center">
                                            <input type="radio" id="fee_type_id_1" name="fee_type_id" :value="1" v-model="form.fee_type_id">
                                            <label for="fee_type_id_1" class="ml-2">Forma de pagamento</label>
                                        </div>

                                        <div class="flex mr-10 items-center">
                                            <input type="radio" id="fee_type_id_2" name="fee_type_id" :value="2" v-model="form.fee_type_id">
                                            <label for="fee_type_id_2" class="ml-2">Taxa de conversão</label>
                                        </div>
                                    </div>

                                    <p class="msg-error" v-if="getError(this.errors, 'fee_type_id') !== ''">{{ getError(this.errors, 'fee_type_id') }}</p>
                                </div>

                                <div v-if="form.fee_type_id === 1" class="input-form" :class="{'has-errors': getError(this.errors, 'payment_type_id') !== ''}">
                                    <label>Qual a forma de pagamento?</label>
                                    <div class="input-form-row no-shadow">
                                        <div class="flex mr-10 items-center">
                                            <input type="radio" id="payment_type_id_1" name="payment_type_id" :value="1" v-model="form.payment_type_id">
                                            <label for="payment_type_id_1" class="ml-2">Boleto</label>
                                        </div>

                                        <div class="flex mr-10 items-center">
                                            <input type="radio" id="payment_type_id_2" name="payment_type_id" :value="2" v-model="form.payment_type_id">
                                            <label for="payment_type_id_2" class="ml-2">Cartão de crédito</label>
                                        </div>
                                    </div>

                                    <p class="msg-error" v-if="getError(this.errors, 'payment_type_id') !== ''">{{ getError(this.errors, 'payment_type_id') }}</p>
                                </div>

                                <div class="input-form" :class="{'has-errors': getError(this.errors, 'min_amount') !== ''}">
                                    <label for="min_amount">Valor mínimo</label>
                                    <div class="input-form-row h-10">
                                        <div class="input-form-group">
                                            <span class="has-input">BRL</span>

                                            <CurrencyInput id="min_amount" v-model="form.min_amount" :options="{ currency: 'BRL', hideCurrencySymbolOnFocus: true, autoDecimalDigits: true, precision: 2 }"/>
                                        </div>
                                    </div>

                                    <p class="msg-error" v-if="getError(this.errors, 'min_amount') !== ''">{{ getError(this.errors, 'min_amount') }}</p>
                                </div>

                                <div class="input-form" :class="{'has-errors': getError(this.errors, 'max_amount') !== ''}">
                                    <label for="max_amount">Valor máximo</label>
                                    <div class="input-form-row h-10">
                                        <div class="input-form-group">
                                            <span class="has-input">BRL</span>

                                            <CurrencyInput id="max_amount" v-model="form.max_amount" :options="{ currency: 'BRL', hideCurrencySymbolOnFocus: true, autoDecimalDigits: true, precision: 2 }"/>
                                        </div>
                                    </div>

                                    <p class="msg-error" v-if="getError(this.errors, 'max_amount') !== ''">{{ getError(this.errors, 'max_amount') }}</p>
                                </div>

                                <div class="input-form" :class="{'has-errors': getError(this.errors, 'percent') !== ''}">
                                    <label for="percent">Taxa em porcentagem (%)</label>
                                    <div class="input-form-row h-10">
                                        <div class="input-form-group">
                                            <span class="has-input">%</span>

                                            <CurrencyInput id="percent" v-model="form.percent" :options="{ currency: 'BRL', currencyDisplay: 'hidden', hideCurrencySymbolOnFocus: true, autoDecimalDigits: true, precision: 2 }"/>
                                        </div>
                                    </div>

                                    <p class="msg-error" v-if="getError(this.errors, 'percent') !== ''">{{ getError(this.errors, 'percent') }}</p>
                                </div>

                                <div class="input-form" :class="{'has-errors': getError(this.errors, 'fixed_value') !== ''}">
                                    <label for="fixed_value">Taxa fixa (R$)</label>
                                    <div class="input-form-row h-10">
                                        <div class="input-form-group">
                                            <span class="has-input">BRL</span>

                                            <CurrencyInput id="fixed_value" v-model="form.fixed_value" :options="{ currency: 'BRL', hideCurrencySymbolOnFocus: true, autoDecimalDigits: true, precision: 2 }"/>
                                        </div>
                                    </div>
                                    <small>Útil caso precisar uma porcentagem + um pequeno valor fixo. <br>Ex: 4% + R$1,50</small>

                                    <p class="msg-error" v-if="getError(this.errors, 'fixed_value') !== ''">{{ getError(this.errors, 'fixed_value') }}</p>
                                </div>

                                <div class="mt-10">
                                    <button class="button-login" :class="{'button-loading': isLoading}">
                                        <div class="icon-loading mr-2" v-if="isLoading">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                            </svg>
                                        </div>

                                        {{ isLoading ? 'Gravando...' : 'Gravar' }}
                                    </button>
                                </div>
                            </form>

                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
import {TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle} from '@headlessui/vue'
import CurrencyInput from "../components/CurrencyInput";
import {getError} from '../utils/getError'

export default {
    components: {
        TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle, CurrencyInput
    },

    data() {
        return {
            isOpen: false,
            isEdit: true,
            isLoading: false,
            callback: null,
            fee: null,
            form: this.resetForm(),
            errors: {}
        }
    },

    methods: {
        resetForm() {
            return {
                fee_type_id: 1,
                payment_type_id: 1,
                min_amount: 0,
                max_amount: 0,
                percent: 0,
                fixed_value: 0
            };
        },

        abrirModal(fee, callback) {
            this.fee = fee;
            this.form = this.resetForm();
            this.errors = {};
            this.isLoading = false;
            this.isEdit = false;

            if (fee && fee.id > 0) {
                this.form = {
                    fee_type_id: fee.fee_type_id,
                    payment_type_id: fee.payment_type_id,
                    min_amount: fee.min_amount,
                    max_amount: fee.max_amount,
                    percent: fee.percent,
                    fixed_value: fee.fixed_value,
                }

                this.isEdit = true;
            }

            this.isOpen = true
            this.callback = callback;
        },

        closeModal() {
            if (this.callback && typeof this.callback === "function") {
                this.callback();
            }

            this.isOpen = false
        },

        submit() {
            if (this.isLoading) {
                return;
            }

            this.isLoading = true;
            this.errors = {};

            if (!this.isEdit) {
                this.axios.post('/api/admin/fees', this.form).then((response) => {
                    this.isLoading = false;

                    this.closeModal();
                }).catch((error) => {
                    this.isLoading = false;

                    if (error.response.status === 422 && error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    }
                });
            } else {
                this.axios.put('/api/admin/fees/' + this.fee.id, this.form).then((response) => {
                    this.isLoading = false;

                    this.closeModal();
                }).catch((error) => {
                    this.isLoading = false;

                    if (error.response.status === 422 && error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    }
                });
            }
        },

        getError
    }
}
</script>
