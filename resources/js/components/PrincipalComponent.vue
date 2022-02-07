<template>
  <div>
    <div class="row">
      <div class="col">
        <div class="mb-4">
          <label class="form-label">Moeda de destino</label>
          <select
            v-model="moedaDestino"
            class="form-select"
            aria-label="Default select example"
          >
            <option value="USD">Dolar</option>
            <option value="EUR">Euro</option>
            <option value="INR">Rúpia Indiana</option>
          </select>
        </div>
      </div>

      <div class="col">
        <div class="mb-4">
          <label class="form-label">Valor para conversão</label>
          <input
            v-model="valorConversao"
            type="number"
            class="form-control"
            placeholder="Entre R$ 1.000 e R$ 100.000,00"
          />
        </div>
      </div>

      <div class="col">
        <div class="mb-4">
          <label class="form-label">Forma de pagamento</label>
          <select
            v-model="formaPagamento"
            class="form-select"
            aria-label="Default select example"
          >
            <option value="boleto">Boleto</option>
            <option value="cartao">Cartão</option>
          </select>
        </div>
      </div>

      <div class="col">
        <div class="mt-3">
          <button
            type="button"
            @click="calcular"
            class="btn btn-primary btn-sm mt-3"
            :disabled="liberado"
          >
            Calcular
          </button>
        </div>
      </div>
    </div>
    <hr />
    <h2 v-show="!resultado && liberado">AGUARDE ...</h2>
    <div
      v-show="resultado"
      style="border: 1px solid #ccc; background-color: #efe8e8"
    >
      <table class="table table-hover">
        <tbody>
          <tr>
            <th>Moeda de origem</th>
            <td>Mark</td>
          </tr>
          <tr>
            <th>Moeda de destino</th>
            <td>Mark</td>
          </tr>
          <tr>
            <th>Valor para conversão</th>
            <td>Mark</td>
          </tr>
          <tr>
            <th>Forma de pagamento</th>
            <td>Mark</td>
          </tr>
          <tr>
            <th>Valor da "Moeda de destino" usado para conversão</th>
            <td>Mark</td>
          </tr>
          <tr>
            <th>Valor comprado em "Moeda de destino"</th>
            <td>Mark</td>
          </tr>
          <tr>
            <th>Taxa de pagamento</th>
            <td>Mark</td>
          </tr>
          <tr>
            <th>Taxa de conversão</th>
            <td>Mark</td>
          </tr>
          <tr>
            <th>Valor utilizado para conversão descontando as taxas</th>
            <td>Mark</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: "PrincipalComponent",
  data() {
    return {
      moedaOrigem: "BRL",
      moedaDestino: "",
      valorConversao: 0.0,
      formaPagamento: "",
      liberado: false,
      resultado: false,
    };
  },
  methods: {
    async calcular() {
      this.liberado = true;
      this.resultado = false;
      let resposta = await axios.post("http://127.0.0.1:8001/api/getCotacao", {
        moedaOrigem: this.moedaOrigem,
        moedaDestino: this.moedaDestino,
        valorConversao: this.valorConversao,
        formaPagamento: this.formaPagamento,
      });

      console.log(resposta.data);

      this.liberado = false;
      this.resultado = true;
    },
  },
};
</script>

<style>
</style>