<template>
    <div class="flex max-w-xs">
        <card>
            <div class="flex justify-start items-center">
                <span class="text-lg font-bold">{{ `${coinBase.name} / ${coinConvert.name}` }}</span>
            </div>

            <div class="flex justify-start items-center mt-2">
                <span class="text-md font-semibold">{{ coinPrice.name }}</span>
            </div>

            <div class="flex flex-col mt-10 space-y-3 max-w-xs">
                <div>
                    <div class="flex space-x-2 items-center" title="Valor referência">
                        <span class="font-bold">{{ coinBase.name }}</span>
                        <em class="text-xs">(Referência)</em>
                    </div>

                    <div class="mt-3 space-y-2">
                        <div class="flex flex-col border rounded p-2">
                            <div class="flex cursor-help text-center" title="Valor base escolhido para realizar conversão.">
                                <span class="w-full">{{ getConversion.value.toLocaleString() }}</span>
                            </div>
                            <div class="flex cursor-help text-center" :title="`Taxa de conversão, aplicada no valor base (${exchange.conversion_tax.toLocaleString()}%)`">
                                <span class="w-full">+ {{ exchange.conversion_price.toLocaleString() }}</span>
                            </div>
                            <div class="flex cursor-help text-center" :title="`Taxa de pagamento tipo ${paymentMethod.name}, aplicada no valor base (${paymentMethod.tax.toLocaleString()}%)`">
                                <span class="w-full">+ {{ exchange.payment_price.toLocaleString() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="flex space-x-2 items-center" title="Valor convertido">
                        <span class="font-bold">{{ coinConvert.name }}</span>
                        <em class="text-xs">(Conversão)</em>
                    </div>

                    <div class="mt-3 space-y-2">
                        <div class="flex flex-col border rounded p-2">
                            <div class="flex cursor-help text-center" title="Valor base escolhido para realizar conversão.">
                                <span class="w-full">{{ exchange.value.toLocaleString() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full">
                    <div class="flex space-x-2 items-center" title="Valor referência">
                        <span>Valor final</span>
                        <em class="text-xs">(Valor a ser pago)</em>
                    </div>
                    <em class="text-xs">(taxas aplicadas no valor de compra diminuindo no valor total de conversão)</em>

                    <div class="mt-3 space-y-2">
                        <div class="flex flex-col border rounded p-2 text-center">
                            <span>{{ exchange.price.toLocaleString() }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </card>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Coin from '~/types/Coin'
import CoinPrice from '~/types/CoinPrice';
import Conversion from '~/types/Conversion'
import Exchange from '~/types/Exchange';
import PaymentMethod from '~/types/PaymentMethod';

export default Vue.extend({
    props: {
        conversion: Object
    },
    computed: {
        getConversion(): Conversion {
            let conversion: Conversion = this.conversion;
            return conversion;
        },
        coinBase(): Coin {
            let coinBase = this.getConversion?.coin_price?.coin_base;
            return coinBase ? coinBase : new Coin();
        },
        coinConvert(): Coin {
            let coinConvert = this.getConversion?.coin_price?.coin_convert;
            return coinConvert ? coinConvert : new Coin();
        },
        coinPrice(): CoinPrice {
            let coinPrice = this.getConversion?.coin_price;
            return coinPrice ? coinPrice : new CoinPrice();
        },
        exchange(): Exchange {
            let exchange = this.getConversion.exchange;
            return exchange ? exchange : new Exchange();
        },
        paymentMethod(): PaymentMethod {
            let paymentMethod = this.exchange.payment_method;
            return paymentMethod ? paymentMethod : new PaymentMethod();
        }
    }
})
</script>
