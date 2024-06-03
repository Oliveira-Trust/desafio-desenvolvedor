<template>
  <v-card>
    <v-form id="form-convert" ref="form" fast-fail>
      <v-card-title>Conversor de Moeda</v-card-title>

    <template v-if="falha">
      <v-alert :value="true" class="p-3" closable variant="tonal" color="error" icon="mdi-alert">
      {{ falha ? msg_erro_show : 'Erro ao realizar conversão' }}
      <br />
      <v-btn v-if="!check" @click="checkServiceStatus" :loading="loading" variant="outlined" class="mt-2" color="danger">Verificar status do serviço</v-btn>
      </v-alert>
    </template>

      <v-card-text>
        <!-- Seleção de moedas -->
        <v-row>
          <v-col cols="6">
            <label>Moeda de origem</label>
            <v-select
              v-model="selectFrom"
              :items="currenciesFrom"
              label="Moeda de origem"
              :rules="[rules.required]"
              :hint="`${selectFrom.coin}, ${selectFrom.abbr}`"
              :loading="loading"
              :disabled="loading"
              item-title="coin"
              :placeholder="loading ? 'Carregando...' : 'Selecione a moeda de origem'"
              item-value="abbr"
              chips
              variant="solo-filled"
              persistent-hint
              return-object
              single-line
            ></v-select>
          </v-col>
          <v-col cols="6">
            <label>Moeda de destino</label>
            <v-select
              v-model="toCurrency"
              :items="currencies"
              :rules="[rules.required]"
              label="Moeda de destino"
              :hint="`${toCurrency.coin}, ${toCurrency.abbr}`"
              :loading="loading"
              :disabled="loading"
              item-title="coin"
              item-value="abbr"
              variant="solo-filled"
              persistent-hint
              return-object
              single-line
            ></v-select>
          </v-col>
        </v-row>
        <!-- Valor de entrada -->
        <v-row>
          <v-col>
            <v-text-field
              v-model.lazy="amount"
              v-money="money"
              :disabled="loading"
              :placeholder="loading ? 'Carregando...' : 'Selecione o valor de compra'"
              :rules="[rules.required, rules.numeric, rules.min, rules.max]"
              label="Valor"
              min="1000"
              max="1000000"
              class="text-4xl"
            ></v-text-field>
          </v-col>
        </v-row>
        <!-- Forma de pagamento -->
        <v-row>
          <v-col class="py-2" cols="12">
            <p>Forma de pagamento</p>
            <v-btn-toggle v-model="method" :disabled="loading" rounded="0" mandatory group>
              <v-btn value="Boleto">Boleto</v-btn>
              <v-btn value="CreditCard">Cartão de Crédito</v-btn>
            </v-btn-toggle>
          </v-col>
        </v-row>
      </v-card-text>
      <!-- Botão de conversão -->
      <v-card-actions>
        <v-btn @click="validate" class="ms-2" :disabled="!check || loading" :loading="loading" color="blue" variant="tonal">Converter</v-btn>
      </v-card-actions>
    </v-form>

    <v-card-text v-if="result && !loading" class="mt-4 flex flex-col space-y-4 resultado-cambio">
      <v-row class="flex flex-col space-y-2">
        <v-col cols="12" class="text-center">
          <p class="text-lg font-bold">Resultado:</p>
          <p class="text-xl">Câmbio gerado com sucesso</p>
        </v-col>
      </v-row>
      <v-row class="flex flex-col space-y-2">
        <v-col cols="12" class="text-left">
          <div class="mt-4 flex flex-col space-y-2">
            <div class="quote-section">
              <h3>Detalhes da Cotação - #ID {{ result.quote_id }}</h3>
              <ul>
                <li><strong>Moeda de origem:</strong> {{ result.origin_currency_name }} ({{ result.origin_currency }})</li>
                <li><strong>Moeda de destino:</strong> {{ result.destination_currency_name }} ({{ result.destination_currency }})</li>
                <li><strong>Valor original:</strong> {{ result.original_value }}</li>
                <li><strong>Valor menos taxas:</strong> {{ result.original_value_minus_tax }}</li>
                <li><strong>Método de Pagamento:</strong> {{ (result.payment_method === 'CreditCard') ? "Cartão de Crédito" : result.payment_method }}</li>
              </ul>
            </div>
            <div class="quote-section">
              <h3>Detalhes da Conversão</h3>
              <ul>
                <li><strong>Valor Moeda Origem:</strong> {{ result.original_value_minus_tax }}</li>
                <li><strong>Valor Moeda Destino:</strong> {{ result.conversion_details.converted_amount }}</li>
                <li><strong>Câmbio:</strong> {{ result.conversion_details.exchange_rate }}</li>
              </ul>
            </div>
            <div class="quote-section">
              <h3>Detalhes da Taxa</h3>
              <ul>
                <li><strong>Taxa do método de pagamento:</strong> {{ result.tax.tax_rate_value }} ({{ result.tax.tax_rate_value_percentages }}%)</li>
                <li><strong>Taxa de conversão:</strong> {{ result.tax.tax_conversion_value }} ({{ result.tax.tax_conversion_percentage }}%)</li>
                <li><strong>Taxa total:</strong> {{ result.tax.tax_total }}</li>
              </ul>
            </div>
          </div>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
import QuoteService from '../../Service/QuoteService.js';
import { VMoney } from 'v-money';

export default {
  directives: { money: VMoney },
  props: {
    user: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      rules: {
        required: value => !!value || 'Campo obrigatório.',
        numeric: value => !isNaN(this.moneyForNumber(value)) || 'Apenas números são permitidos.',
        min: value => this.moneyForNumber(value) >= 1000 || 'Valor mínimo de R$ 1000,00.',
        max: value => this.moneyForNumber(value) <= 100000 || 'Valor máximo de R$ 100.000,00.',
      },
      amount: 100000,
      method: 'Boleto',
      falha: false,
      check: true,
      msg_erro_show: '',
      result: null,
      loading: false,
      selectFrom: { coin: 'Real Brasileiro', abbr: 'BRL' },
      toCurrency: { coin: 'Dolar Americano', abbr: 'USD' },
      currenciesFrom: [{ coin: 'Real Brasileiro', abbr: 'BRL' }],
      currencies: [],
      money: {
        decimal: ',',
        thousands: '.',
        prefix: 'R$ ',
        suffix: '',
        precision: 2,
        masked: false,
      },
    };
  },
  methods: {
    reset(){
      this.falha = false;
      this.msg_erro_show = '';
    },
    async fetchAvailableCurrencies() {
      const serviceStatus = await this.checkServiceStatus();
      if (!serviceStatus) {
        return;
      }
      try {
        this.loading = true;
        const data = await QuoteService.getAvailableCurrencies(this.user, this.selectFrom.abbr);
        this.currencies = data;
      } catch (error) {
        this.handleError('Erro ao buscar moedas disponíveis da API', error);
      } finally {
        this.loading = false;
      }
    },
    async checkServiceStatus() {
      try {
        this.loading = true;
        const data = await QuoteService.checkServiceStatus(this.user);
        this.reset();
        this.check = data;
        if(!this.check) {
          this.falha = true;
          this.msg_erro_show = 'API indisponível';
        }
      } catch (error) {
        this.check = false;
        this.handleError('Erro ao buscar status da API', error);
      } finally {
        this.loading = false;
        return this.check;
      }
    },
    async generateQuote() {
      if (!this.check) {
        return;
      }
      try {
        this.reset();
        this.loading = true;
        this.result = null;
        const data = await QuoteService.generateQuote(
          this.user,
          this.selectFrom.abbr,
          this.toCurrency.abbr,
          this.amount,
          this.method
        );
        this.result = data.data;
      } catch (error) {
        this.handleError('Erro ao gerar a cotação', error);
        this.checkServiceStatus();
      } finally {
        this.loading = false;
      }
    },
    async validate() {
      const { valid } = await this.$refs.form.validate();
      if (valid) this.generateQuote();
    },
    moneyForNumber(value) {
      if (typeof value !== 'string') {
        value = value.toString();
      }
      return parseFloat(value.replace(/[^0-9,]/g, '').replace(',', '.'));
    },
    handleError(customMessage, error) {
      this.falha = true;
      if (error.response) {
        // Erro de requisição com resposta
        if (error.response.status === 500) {
          this.msg_erro_show = 'Erro interno do servidor. Por favor, tente novamente mais tarde.';
        } else {
          this.msg_erro_show = customMessage + ': ' + error.response.data.message;
        }
        console.error(`${customMessage}: ${error.response.status} - ${error.response.data.message}`);
      } else if (error.request) {
        // Erro de requisição sem resposta do servidor
        this.msg_erro_show = 'Sem resposta do servidor. Por favor, verifique sua conexão ou tente novamente mais tarde.';
        console.error(`${customMessage}: Sem resposta do servidor`);
      } else {
        // Erro de configuração do cliente
        this.msg_erro_show = customMessage + ': ' + error.message;
        console.error(`${customMessage}: ${error.message}`);
      }
    },
  },
  mounted() {
    this.fetchAvailableCurrencies();
  },
};
</script>

<style scoped>
  /* Fonte importada do Google Fonts */
  @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

  body {
    font-family: 'Roboto', Arial, sans-serif;
    background-color: #f0f2f5;
    padding: 20px;
    margin: 0;
  }

  .container {
    max-width: 600px;
    margin: 0 auto;
    background-color: #ffffff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
  }

  h1 {
    color: #007BFF;
    font-size: 28px;
    text-align: center;
    margin-bottom: 25px;
    font-weight: 700;
  }

  p {
    font-size: 16px;
    color: #333333;
    margin-bottom: 20px;
    line-height: 1.6;
  }

  .quote-section {
    margin-bottom: 30px;
    padding: 20px;
    border-radius: 8px;
    background-color: #f9f9f9;
    border: 1px solid #e0e0e0;
    transition: background-color 0.3s, border 0.3s;
  }

  .quote-section:hover {
    background-color: #f1f1f1;
    border: 1px solid #d1d1d1;
  }

  .quote-section h3 {
    font-size: 20px;
    color: #007BFF;
    margin-bottom: 15px;
    font-weight: 500;
  }

  .quote-section ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
  }

  .quote-section li {
    font-size: 16px;
    color: #555555;
    margin-bottom: 10px;
  }

  .quote-section li strong {
    color: #333333;
    font-weight: 500;
  }

  .signature {
    font-size: 14px;
    color: #999999;
    text-align: center;
    margin-top: 40px;
  }

  /* Botão de ação */
  .action-button {
    display: block;
    width: 100%;
    max-width: 200px;
    margin: 20px auto;
    padding: 12px 20px;
    text-align: center;
    background-color: #007BFF;
    color: #ffffff;
    border: none;
    border-radius: 25px;
    text-decoration: none;
    font-size: 16px;
    font-weight: 500;
    transition: background-color 0.3s, transform 0.3s;
  }

  .action-button:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
  }

  /* Media queries para dispositivos móveis */
  @media (max-width: 768px) {
    .container {
      padding: 15px;
    }

    h1 {
      font-size: 24px;
    }

    p {
      font-size: 14px;
    }

    .quote-section h3 {
      font-size: 18px;
    }

    .quote-section li {
      font-size: 14px;
    }

    .signature {
      font-size: 12px;
    }

    .action-button {
      font-size: 14px;
      padding: 10px 16px;
    }
  }

  /* Estilos específicos para a seção de resultado do câmbio */
  .resultado-cambio {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
  }

  .resultado-cambio p {
    font-size: 16px;
    color: #333333;
    line-height: 1.6;
  }

  .resultado-cambio p strong {
    color: #007BFF;
    font-weight: 500;
  }

  .resultado-cambio .text-lg {
    font-size: 1.25rem;
  }

  .resultado-cambio .text-xl {
    font-size: 1.5rem;
  }
</style>