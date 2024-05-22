<template>
  <v-container>
      <v-card-title class="title">Configuração de Taxas</v-card-title>
      <v-alert v-if="falha || msg_erro_show" type="error" dismissible>
        Erro: {{ msg_erro_show }}
      </v-alert>
      <v-form @submit.prevent="submitForm">
        <v-divider class="mb-4"></v-divider>

        <v-subheader>Método de Pagamento: Boleto</v-subheader>
        <v-container>
          <v-row>
            <v-col cols="12" md="6">
              <v-text-field
                v-model="form.boleto.taxValue"
                label="Valor da Taxa (Boleto)"
                type="number"
                required
                :readonly="loading"
              ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field
                v-model="form.boleto.referenceValue"
                label="Valor de Referência (Boleto)"
                type="number"
                required
                :readonly="loading"
              ></v-text-field>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" md="6">
              <v-text-field
                v-model="form.boleto.aboveReferenceRate"
                label="Taxa Acima da Referência (Boleto)"
                type="number"
                required
                :readonly="loading"
              ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field
                v-model="form.boleto.belowReferenceRate"
                label="Taxa Abaixo da Referência (Boleto)"
                type="number"
                required
                :readonly="loading"
              ></v-text-field>
            </v-col>
          </v-row>
        </v-container>

        <v-divider class="mt-6 mb-4"></v-divider>

        <v-subheader>Método de Pagamento: Cartão</v-subheader>
        <v-container>
          <v-row>
            <v-col cols="12" md="6">
              <v-text-field
                v-model="form.cartao.taxValue"
                label="Valor da Taxa (Cartão)"
                type="number"
                required
                :loading="loading"
                :readonly="loading"
              ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field
                v-model="form.cartao.referenceValue"
                label="Valor de Referência (Cartão)"
                type="number"
                required
                :loading="loading"
                :readonly="loading"
              ></v-text-field>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" md="6">
              <v-text-field
                v-model="form.cartao.aboveReferenceRate"
                label="Taxa Acima da Referência (Cartão)"
                type="number"
                required
                :loading="loading"
                :readonly="loading"
              ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field
                v-model="form.cartao.belowReferenceRate"
                label="Taxa Abaixo da Referência (Cartão)"
                type="number"
                required
                :loading="loading"
                :readonly="loading"
              ></v-text-field>
            </v-col>
          </v-row>
        </v-container>

        <v-divider class="mt-6 mb-4"></v-divider>

        <v-card-actions>
          <v-btn
            color="primary"
            class="mr-4"
            :disabled="loading"
            :loading="loading"
            @click="submitForm"
          >
            Salvar Configurações
          </v-btn>
        </v-card-actions>
      </v-form>
  </v-container>
</template>

<script>
import QuoteService from "../../Service/QuoteService.js";

export default {
  props: {
    user: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      loading: false,
      form: {
        boleto: {
          taxValue: 1.45,
          referenceValue: 3000,
          aboveReferenceRate: 1,
          belowReferenceRate: 2,
        },
        cartao: {
          taxValue: 7.63,
          referenceValue: 3000,
          aboveReferenceRate: 1,
          belowReferenceRate: 2,
        },
      },
      falha: false,
      msg_erro_show: "",
    };
  },
  methods: {
    async submitForm() {
      this.falha = false;
      this.msg_erro_show = "";
      this.loading = true;
      try {
        const configs = [
          {
            payment_method: "Boleto",
            payment_method_fee: this.form.boleto.taxValue.toString(),
            conversion_fee_threshold: this.form.boleto.referenceValue.toString(),
            conversion_fee_below_threshold: this.form.boleto.belowReferenceRate.toString(),
            conversion_fee_above_threshold: this.form.boleto.aboveReferenceRate.toString(),
          },
          {
            payment_method: "CreditCard",
            payment_method_fee: this.form.cartao.taxValue.toString(),
            conversion_fee_threshold: this.form.cartao.referenceValue.toString(),
            conversion_fee_below_threshold: this.form.cartao.belowReferenceRate.toString(),
            conversion_fee_above_threshold: this.form.cartao.aboveReferenceRate.toString(),
          },
        ];
        await QuoteService.saveTaxConfigs(configs);
      } catch (error) {
        this.falha = true;
        this.msg_erro_show = error.message;
        console.error("Erro ao salvar configurações de taxas:", error);
      } finally {
        this.loading = false;
      }
    },
    async fetchTaxs() {
      try {
        this.loading = true;
        const data = await QuoteService.getTaxsConfig(this.user);
        this.populateForm(data);
      } catch (error) {
        this.falha = true;
        this.msg_erro_show = error.message;
        console.error("Erro ao buscar taxas disponíveis da API:", error);
      } finally {
        this.loading = false;
      }
    },
    populateForm(data) {
      data.forEach((item) => {
        if (item.payment_method === "Boleto") {
          this.form.boleto.taxValue = parseFloat(item.payment_method_fee);
          this.form.boleto.referenceValue = parseFloat(item.conversion_fee_threshold);
          this.form.boleto.aboveReferenceRate = parseFloat(item.conversion_fee_above_threshold);
          this.form.boleto.belowReferenceRate = parseFloat(item.conversion_fee_below_threshold);
        } else if (item.payment_method === "CreditCard") {
          this.form.cartao.taxValue = parseFloat(item.payment_method_fee);
          this.form.cartao.referenceValue = parseFloat(item.conversion_fee_threshold);
          this.form.cartao.aboveReferenceRate = parseFloat(item.conversion_fee_above_threshold);
          this.form.cartao.belowReferenceRate = parseFloat(item.conversion_fee_below_threshold);
        }
      });
    },
  },
  mounted() {
    this.fetchTaxs();
  },
};
</script>

<style scoped>
.title {
  font-size: 28px;
  color: #007bff;
  font-weight: 700;
  text-align: center;
  margin-bottom: 20px;
}

.v-subheader {
  font-size: 20px;
  color: #333333;
  font-weight: 500;
  margin-top: 20px;
}

.v-divider {
  margin-top: 20px;
}

.v-container {
  max-width: 800px;
  margin: 0 auto;
}

.v-card-actions {
  justify-content: flex-end;
}

.v-text-field {
  width: 100%;
}
</style>
