<template>
    <div>
        <form @submit.prevent="submit" v-if="quotation === false" class="quotation">
            <h1>Preencha os campos abaixos e realize a sua cotação agora mesmo.</h1>

            <div class="input-form" :class="{'has-errors': getError(this.errors, 'amount') !== ''}">
                <label for="amount">Valor em reais</label>
                <div class="input-form-row">
                    <img :src="currency_image_brazil" class="h-10"/>

                    <div class="input-form-group">
                        <span class="has-input">BRL</span>

                        <CurrencyInput id="amount" v-model="form.amount" :options="{ currency: 'BRL', hideCurrencySymbolOnFocus: false, autoDecimalDigits: true, precision: 2 }"/>
                    </div>
                </div>

                <p class="msg-error" v-if="getError(this.errors, 'amount') !== ''">{{ getError(this.errors, 'amount') }}</p>
            </div>

            <div class="input-form" :class="{'has-errors': getError(this.errors, 'currency_id') !== ''}">
                <label for="currency_id">Qual moeda gostaria de comprar?</label>
                <div class="input-form-row">
                    <img :src="currency_image" class="h-10"/>

                    <div class="input-form-group pr-4">
                        <select id="currency_id" name="currency_id" v-model="form.currency_id">
                            <option :value="2">(USD) Dólar Americano</option>
                            <option :value="3">(EUR) Euro</option>
                            <option :value="4">(GBP) Libra Esterlina</option>
                        </select>
                    </div>
                </div>

                <p class="msg-error" v-if="getError(this.errors, 'currency_id') !== ''">{{ getError(this.errors, 'currency_id') }}</p>
            </div>

            <div class="input-form" :class="{'has-errors': getError(this.errors, 'payment_type_id') !== ''}">
                <label for="currency_id">Como gostaria de fazer o pagamento?</label>
                <div class="input-form-row no-shadow">
                    <div class="flex mr-10">
                        <input type="radio" id="payment_type_id_1" name="payment_type_id" :value="1" v-model="form.payment_type_id">
                        <div class="radio-image has-input">
                            <img src="/images/boleto.png" alt="Boleto" title="Boleto" class="h-10">
                            <label for="payment_type_id_1">Boleto</label>
                        </div>
                    </div>

                    <div class="flex">
                        <input type="radio" id="payment_type_id_2" name="payment_type_id" :value="2" v-model="form.payment_type_id">
                        <div class="radio-image has-input">
                            <img src="/images/cartao-de-credito.png" alt="Cartão de crédito" title="Cartão de crédito" class="h-10">
                            <label for="payment_type_id_2">Cartão de crédito</label>
                        </div>
                    </div>
                </div>

                <p class="msg-error" v-if="getError(this.errors, 'payment_type_id') !== ''">{{ getError(this.errors, 'payment_type_id') }}</p>
            </div>

            <div class="input-form">
                <button type="submit" :class="{'button-loading': isLoading}">
                    <div class="icon-loading mr-2" v-if="isLoading">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </div>

                    <span v-if="isLoading">Processando...</span>
                    <span v-else>Fazer cotação agora</span>
                </button>
            </div>
        </form>

        <div v-else class="quotation resultado">
            <h1>Parabéns, sua cotação foi realizada com sucesso.</h1>

            <div>
                Você pagará
                <span class="separator"></span>
                <span>R${{ formatValue(quotation.amount) }}</span>
            </div>

            <div>
                Preço utilizado na conversão
                <span class="separator"></span>
                <span>R${{ formatValue(quotation.price) }}</span>
            </div>

            <div class="taxas">
                <b>Taxas</b>
                <div>
                    <span>Taxa de pagamento</span>
                    <span class="separator"></span>
                    <span>R${{ formatValue(quotation.fees['1']) }}</span>
                </div>
                <div>
                    <span>Taxa de conversão</span>
                    <span class="separator"></span>
                    <span>R${{ formatValue(quotation.fees['2']) }}</span>
                </div>
            </div>

            <div>
                Você receberá
                <span class="separator"></span>
                <span class="text-red-500"><b>{{ formatValue(quotation.exchanged_amount) }} {{ quotation.currency_code }}</b></span>
            </div>

            <button v-if="!isEmailEnviado" type="button" @click="enviarEmail" class="button-link mt-10">
                {{ isLoadingEmail ? 'Enviando email....' : 'Deseja enviar essa cotação por email? Clique aqui.' }}
            </button>

            <button v-if="isEmailEnviado" type="button" @click.prevent="()=>{}" class="button-link mt-10">
                Email enviado com sucesso.
            </button>

            <button type="button" @click="limparCotacao" class="button-link mt-2">
                Realizar uma nova cotação.
            </button>
        </div>

        <login-modal ref="loginModal"></login-modal>
    </div>
</template>

<script>
import LoginModal from "../components/LoginModal";
import CurrencyInput from "../components/CurrencyInput";
import {formatValue} from '../utils/formatValue';
import {getError} from '../utils/getError';

export default {
    components: {CurrencyInput, LoginModal},
    mounted() {
        $(function () {
            $('.has-input').click(function () {
                $(this).parent().find('input, select, textarea').click().focus();
            })
        });
    },

    computed: {
        currency_image_brazil() {
            return `/images/currencies/1.jpg`;
        },

        currency_image() {
            return `/images/currencies/${this.form.currency_id}.jpg`;
        }
    },

    data() {
        return {
            form: {
                amount: 0,
                currency_id: 2,
                payment_type_id: 1
            },

            quotation: false,
            isLoading: false,
            errors: {},

            isEmailEnviado: false,
            isLoadingEmail: false,
        }
    },

    methods: {
        submit() {
            if (this.isLoading) {
                return;
            }

            this.$refs.loginModal.fazerLogin(true, true, () => {
                this.isLoading = true;
                this.errors = {}

                this.axios.post('/api/quotation', this.form).then((response) => {
                    this.quotation = response.data.data;

                    this.form = {
                        amount: 0,
                        currency_id: 2,
                        payment_type_id: 1
                    }

                    this.$emit('created');
                    this.isLoading = false;
                }).catch((error) => {
                    this.isLoading = false;

                    if (error.response.status === 422 && error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    }
                });
            })
        },

        enviarEmail() {
            this.isLoadingEmail = true;

            this.axios.post(`/api/quotation/${this.quotation.id}/email`).then(() => {
                this.isLoadingEmail = false;
                this.isEmailEnviado = true;
            }).catch((error) => {
                this.isLoadingEmail = false;
            });
        },

        limparCotacao() {
            this.quotation = false;
        },

        getError,
        formatValue
    }
}
</script>
