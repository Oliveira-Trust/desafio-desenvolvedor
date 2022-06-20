<template>
    <div class="minhas-cotacoes">
        <h1>Minhas cotações</h1>

        <table>
            <thead>
            <tr>
                <th>Data</th>
                <th>Valor em reais</th>
                <th>Preço de conversão</th>
                <th>Taxas</th>
                <th>Valor que você receberá</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="cotacao in cotacoes">
                <td>{{ cotacao.created_at }}</td>
                <td>
                    R${{ formatValue(cotacao.amount) }}<br>
                    Pagamento: {{ cotacao.payment_type_description }}
                </td>
                <td>R${{ formatValue(cotacao.price) }}</td>
                <td>
                    Taxa de pagamento: R${{ formatValue(cotacao.fees['1']) }}<br>
                    Taxa de conversão: R${{ formatValue(cotacao.fees['2']) }}<br>
                </td>
                <td class="value">{{ formatValue(cotacao.exchanged_amount) }} {{ cotacao.currency_code }}</td>
            </tr>
            <tr v-if="cotacoes.length === 0">
                <td colspan="5">Nenhuma cotação realizada.</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import {formatValue} from '../utils/formatValue';

export default {
    mounted() {
        this.load();
    },

    data() {
        return {
            cotacoes: []
        }
    },

    methods: {
        load() {
            this.axios.get('/api/quotation').then((response) => {
                this.cotacoes = response.data.data;
            })
        },

        formatValue
    }
}
</script>
