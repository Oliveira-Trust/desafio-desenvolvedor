<template>
    <div>
        <h1>Conversão de Moedas</h1>
        <div>
            <input type="text" v-model="conversion.conversion_value" placeholder="Valor para conversão"
                required="required" />
            <br>
            <select v-model="selectedDestinationCurrency">
                <option v-for="option in options" :value="option.value" :key="option.value">
                    {{ option.text }}
                </option>
            </select>

            <span>- {{ selectedDestinationCurrency }}</span>
            <br>
            <select v-model="selectedPaymentMethod">
                <option value="" disabled selected>Escolha um método de pagamento</option>
                <option v-for="paymentMethod in paymentMethods" :value="paymentMethod" :key="paymentMethod.id">
                    {{ paymentMethod.name }}
                </option>
            </select>
            <span v-if="selectedPaymentMethod">
                - {{ selectedPaymentMethod.tax }}
            </span>
            <br>
            <div v-if="errors.length" class="error-message">
                <ul>
                    <li v-for="error in errors" :key="error">
                        {{ error }}
                    </li>
                </ul>
            </div>


            <button @click="submitConversion">Converter</button>
            
        </div>
        <div v-if="successfulConversions.length">
            <h2>Conversões Bem-sucedidas</h2>
            <ul>
                <li v-for="conversion in successfulConversions" :key="conversion.id">
                    <!-- Exibir detalhes da conversão bem-sucedida -->
                    <p>Origin Currency: {{ conversion.origin_currency }}</p>
                    <p>Destination Currency: {{ conversion.destination_currency }}</p>
                    <p>Conversion Value: {{ conversion.conversion_value }}</p>
                    <!-- Adicione outros detalhes necessários aqui -->
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import { authenticationService, userService, paymentMethodService, conversionService } from '@/_services';

export default {
    data() {
        return {
            user: authenticationService.currentUserValue,
            users: [],
            paymentMethods: [],
            selectedPaymentMethod: null,
            successfulConversions: [],
            conversion: {
                conversion_value: ''
            },
            errors: [],
            selectedDestinationCurrency: 'USD',
            options: [
                { text: 'Dólar Americano', value: 'USD' },
                { text: 'Peso Argentino', value: 'ARS' },
                { text: 'Euro', value: 'EUR' }
            ]
        };
    },
    created() {
        userService.getAll().then(users => this.users = users);
        paymentMethodService.getAll().then(paymentMethods => this.paymentMethods = paymentMethods);
    },
    methods: {
        submitConversion() {
            const conversionData = {
                conversion_value: this.conversion.conversion_value,
                destination_currency: this.selectedDestinationCurrency,
                payment_method_id: this.selectedPaymentMethod.id
            };
            conversionService.conversion(conversionData)
                .then(response => {
                    if (response.success==false ) {
                        this.errors = Object.values(response.data.conversion_value).flat();
                    }
                    const conversionResult = response.data;
                    this.successfulConversions.push(conversionResult)
                })
                .catch(error => {
                    if (error.error) {
                        this.errors = Object.values(error).flat();
                    } else {
                        this.errors = ["Ocorreu um erro ao converter."];
                    }
                    console.error(error);
                });
        }
    }
};
</script>
