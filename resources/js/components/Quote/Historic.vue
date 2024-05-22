<template>
    <div class="container">
      <h1 class="title">Histórico de Cotações</h1>
  
      <v-data-table
        :headers="headers"
        :items="history"
        :loading="loading"
        :no-data-text="falha ? 'Erro ao carregar histórico' : 'Nenhum dado disponível'"
      >
        <template v-slot:item="{ item }">
          <tr>
            <td>{{ item.id }}</td>
            <td>{{ formatDate(item.created_at) }}</td>
            <td>{{ item.origin_currency }}</td>
            <td>{{ item.destination_currency }}</td>
            <td>{{ formatCurrency(item.original_amount) }}</td>
            <td>{{ formatCurrency(item.converted_amount) }}</td>
            <td>{{ item.payment_method }}</td>
            <td v-if="item.email_sent_at">
              <v-icon color="green">mdi-email-check</v-icon>
            </td>
            <td v-else>
              <v-icon color="red">mdi-email</v-icon>
            </td>
            <td>
              <v-btn small color="primary" @click="showDetails(item)">
                Ver Detalhes
              </v-btn>
            </td>
          </tr>
        </template>
  
        <template v-slot:progress>
          <v-progress-circular indeterminate color="primary"></v-progress-circular>
        </template>
      </v-data-table>
  
      <v-alert v-if="falha" type="error" dismissible>
        {{ msg_erro_show }}
      </v-alert>
  
      <v-dialog v-model="dialog" max-width="600">
        <v-card>
          <v-card-title>Detalhes da Cotação</v-card-title>
          <v-card-text v-if="selectedItem">
            <div>ID da Cotação: #{{ selectedItem.id }}</div>
            <div>Moeda de Origem: {{ selectedItem.origin_currency }}</div>
            <div>Moeda de Destino: {{ selectedItem.destination_currency }}</div>
            <div>Valor Original: R$ {{ formatCurrency(selectedItem.original_amount) }}</div>
            <div>Valor Menos Taxas: R$ {{ formatCurrency(selectedItem.original_value_minus_tax) }}</div>
            <div>Método de Pagamento: {{ selectedItem.payment_method }}</div>
            <br>
            <div><b>Detalhes da Conversão</b></div>
            <div>Valor Moeda Origem: R$ {{ formatCurrency(selectedItem.original_value_minus_tax) }}</div>
            <div>Valor Moeda Destino: {{ formatCurrency(selectedItem.converted_amount) }}</div>
            <div>Câmbio: $ {{ formatCurrency(selectedItem.exchange_rate) }}</div>
            <br>
            <div><b>Detalhes da Taxa</b></div>
            <div>Taxa do Método de Pagamento: R$ {{ formatCurrency(selectedItem.tax_rate_value) }} ({{ selectedItem.tax_rate_value_porcentages }}%)</div>
            <div>Taxa de Conversão: R$ {{ formatCurrency(selectedItem.tax_conversion_value) }} ({{ selectedItem.tax_conversion_percentage }}%)</div>
            <div>Taxa Cambio: {{ formatCurrency(selectedItem.tax_total) }}</div>
            <br>
            <div v-if="selectedItem.email_sent_at">
              <b>E-mail enviado em:</b> {{ formatDate(selectedItem.email_sent_at) }}
            </div>
            <div v-else>
              <b>E-mail não enviado</b>
            </div>
          </v-card-text>
          <v-card-actions>
            <v-btn color="primary" @click="dialog = false">Fechar</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
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
        falha: false,
        msg_erro_show: "",
        history: [],
        dialog: false,
        selectedItem: null,
        headers: [
          { title: "ID", align: "start", key: "id" },
          { title: "Data", key: "created_at" },
          { title: "Moeda de Origem", key: "origin_currency" },
          { title: "Moeda de Destino", key: "destination_currency" },
          { title: "Valor Original", key: "original_amount" },
          { title: "Valor Destino", key: "converted_amount" },
          { title: "Método de Pagamento", key: "payment_method" },
          { title: "E-mail Enviado", key: "email_sent" },
          { title: "Ações", sortable: false },
        ],
      };
    },
    methods: {
      async fetchHis() {
        try {
          this.loading = true;
          const data = await QuoteService.getQuoteHistory(this.user);
          this.history = data;
        } catch (error) {
          this.falha = true;
          this.msg_erro_show = error.message;
          console.error("Erro ao buscar histórico disponível da API:", error);
        } finally {
          this.loading = false;
        }
      },
      showDetails(item) {
        this.selectedItem = item;
        this.dialog = true;
      },
      formatDate(dateString) {
        const options = { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit' };
        const date = new Date(dateString);
        return date.toLocaleDateString('pt-BR', options);
      },
      formatCurrency(value) {
        return parseFloat(value).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
      },
    },
    mounted() {
      this.fetchHis();
    },
  };
  </script>
  
  <style scoped>
  .container {
    margin: 0 auto;
    padding: 25px;
  }
  
  .title {
    color: #007bff;
    font-size: 28px;
    text-align: center;
    margin-bottom: 25px;
    font-weight: 700;
  }
  
  .v-data-table {
    margin-top: 20px;
  }
  
  .v-dialog {
    z-index: 9999;
  }
  
  .v-alert {
    margin-top: 20px;
  }
  
  .v-btn {
    text-transform: none;
  }
  </style>
  