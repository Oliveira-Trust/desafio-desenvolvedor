<template>
  <div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Moeda de origem</th>
          <th>Moeda de destino</th>
          <th>Valor Conversão</th>
          <th>Forma Pagamento</th>
          <th>Valor Moeda Destino</th>
          <th>Valor Comprado Destino</th>
          <th>Taxa Pagamento</th>
          <th>Taxa Conversão</th>
          <th>Valor Conversão com Taxas</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="h in historico" :key="h.id">
          <td>{{ h.moeda_origem }}</td>
          <td>{{ h.moeda_destino }}</td>
          <td>{{ h.valor_conversao }}</td>
          <td>{{ h.forma_pagamento }}</td>
          <td>{{ h.valor_moeda_destino }}</td>
          <td>{{ h.valor_comprado_moeda_destino }}</td>
          <td>{{ h.taxa_pagamento }}</td>
          <td>{{ h.taxa_conversao }}</td>
          <td>{{ h.valor_conversao_com_taxas }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "HistoricoComponent",
  data() {
    return {
      historico: [],
    };
  },
  created() {
    this.getHistorico().then((resposta) => {
      console.log(resposta.data);
      this.historico = resposta.data.cotacao;
    });
  },
  methods: {
    async getHistorico() {
      return await axios.get("http://127.0.0.1:8001/api/getCotacao");
    },
  },
};
</script>

<style>
</style>