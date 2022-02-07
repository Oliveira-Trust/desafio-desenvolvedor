<template>
  <div>
    <div class="row">
      <div class="col">
        <div class="mb-4">
          <label class="form-label">Valor Abaixo</label>
          <input
            v-model="valorAbaixo"
            type="number"
            class="form-control"
            placeholder="Entre R$ 1.000 e R$ 100.000,00"
          />
        </div>
      </div>

      <div class="col">
        <div class="mb-4">
          <label class="form-label">Taxa Abaixo</label>
          <input
            v-model="taxaAbaixo"
            type="number"
            class="form-control"
            placeholder="Entre R$ 1.000 e R$ 100.000,00"
          />
        </div>
      </div>

      <div class="col">
        <div class="mb-4">
          <label class="form-label">Valor Acima</label>
          <input
            v-model="valorAcima"
            type="number"
            class="form-control"
            placeholder="Entre R$ 1.000 e R$ 100.000,00"
          />
        </div>
      </div>

      <div class="col">
        <div class="mb-4">
          <label class="form-label">Taxa Acima</label>
          <input
            v-model="taxaAcima"
            type="number"
            class="form-control"
            placeholder="Entre R$ 1.000 e R$ 100.000,00"
          />
        </div>
      </div>

      <div class="col">
        <div class="mt-3">
          <button
            type="button"
            @click="salvar"
            class="btn btn-primary btn-sm mt-3"
            :disabled="liberado"
          >
            Salvar
          </button>
        </div>
      </div>
    </div>
    <hr />
    <h2 v-show="liberado">AGUARDE ...</h2>
    <div style="border: 1px solid #ccc; background-color: #efe8e8">
      <table class="table table-hover">
        <tbody>
          <tr>
            <th>Valor Abaixo</th>
            <td>{{ valorAbaixo }}</td>
          </tr>
          <tr>
            <th>Taxa Abaixo</th>
            <td>{{ taxaAbaixo }}</td>
          </tr>
          <tr>
            <th>Valor Acima</th>
            <td>{{ valorAcima }}</td>
          </tr>
          <tr>
            <th>Taxa Acima</th>
            <td>{{ taxaAcima }}</td>
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
      valorAbaixo: 0.0,
      taxaAbaixo: 0.0,
      valorAcima: 0.0,
      taxaAcima: 0.0,
      liberado: false,
    };
  },
  created() {
    this.getTaxas().then((resposta) => {
      console.log(resposta.data);
      this.valorAbaixo = resposta.data[0].valor_abaixo;
      this.taxaAbaixo = resposta.data[0].taxa_abaixo;
      this.valorAcima = resposta.data[0].valor_acima;
      this.taxaAcima = resposta.data[0].taxa_acima;
      this.liberado = false;
    });
  },
  methods: {
    async getTaxas() {
      return await axios.get("http://127.0.0.1:8001/api/getTaxa");
    },
    async salvar() {
      let resposta = await axios.post("http://127.0.0.1:8001/api/setTaxa", {
        valor_abaixo: this.valorAbaixo,
        taxa_abaixo: this.taxaAbaixo,
        valor_acima: this.valorAcima,
        taxa_acima: this.taxaAcima,
      });

      console.log(resposta.data);
    },
  },
};
</script>

<style>
</style>