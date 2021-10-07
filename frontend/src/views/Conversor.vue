<template>
  <div class="conversor">
    <PageTitle
      icon="fa fa-money"
      main="Conversor de Moedas"
      sub="Invoice"
    />
    <b-form v-if="cotacao===null">
      <b-row>
        <b-col
          md="6"
          sm="12"
        >
          <b-form-group
            label="Moeda de Origem:"
            label-for="moeda-origem"
          >
            <b-form-select
              id="moeda-origem"
              v-model="invoice.moeda_origem"
              :options="moedas"
            />
          </b-form-group>
        </b-col>
        <b-col
          md="6"
          sm="12"
        >
          <b-form-group
            label="Moeda de Destino:"
            label-for="moeda-destino"
          >
            <b-form-select
              id="moeda-destino"
              v-model="invoice.moeda_destino"
              :options="moedas"
            />
          </b-form-group>
        </b-col>
      </b-row>
      <b-row>
        <b-col
          md="6"
          sm="12"
        >
          <b-form-group
            label="Valor Desejado:"
            label-form="moeda-valor"
          >
            <b-form-input
              id="moeda-valor"
              v-model="invoice.valor"
              type="number"
              placeholder="Digite Valor Desejado"
            />
          </b-form-group>
        </b-col>
        <b-col
          md="6"
          sm="12"
        >
          <b-form-group
            label="Forma de Pagamento:"
            label-form="moeda-pagamento"
          >
            <b-form-select
              id="moeda-pagamento"
              v-model="invoice.pagamento"
              :options="formas"
            />
          </b-form-group>
        </b-col>
      </b-row>
      <hr>
      <b-row>
        <b-col
          md="6"
          sm="12"
        >
          <b-button
            size="sm"
            class="pb-2"
            variant="primary"
            @click="cotar"
          >
            Cotar Moeda
          </b-button>
        </b-col>
        <b-col
          md="6"
          sm="12"
        >
          <b-button
            size="sm"
            class="pb-2"
            variant="warning"
            @click="reset"
          >
            Limpar Cotacao
          </b-button>
        </b-col>
      </b-row>
    </b-form>
    <b-container v-else>
      <b-row>
        <b-col
          md="12"
          sm="12"
          class="titulo"
        >
          <strong>Compra de Moeda - Data: </strong>{{ cotacao.data_cotacao }}
        </b-col>
      </b-row>
      <b-row>
        <b-col
          md="6"
          sm="12"
        >
          <strong>Moeda de origem: </strong> {{ cotacao.moeda_origem }}
        </b-col>
        <b-col
          md="6"
          sm="12"
        >
          <strong>Moeda de destino: </strong> {{ cotacao.moeda_destino }}
        </b-col>
      </b-row>
      <b-row>
        <b-col
          md="6"
          sm="12"
        >
          <strong>Valor para conversão({{ cotacao.moeda_origem }}): </strong>{{ cotacao.valorEntrada }}
        </b-col>
        <b-col
          md="6"
          sm="12"
        >
          <strong>Forma de pagamento: </strong>{{ cotacao.formaPagamento }}
        </b-col>
      </b-row>
      <b-row>
        <b-col
          md="6"
          sm="12"
        >
          <strong>Valor da "Moeda de destino"({{ cotacao.moeda_destino }}): </strong>{{ cotacao.valor_moeda_destino }}
        </b-col>
        <b-col
          md="6"
          sm="12"
        >
          <strong>Valor comprado em "Moeda de destino"({{ cotacao.moeda_destino }}): </strong>{{ cotacao.valorMoedaDestino }}
        </b-col>
      </b-row>
      <b-row>
        <b-col
          md="6"
          sm="12"
        >
          <strong>Taxa de pagamento: </strong>{{ cotacao.taxaPagameno }}
        </b-col>
        <b-col
          md="6"
          sm="12"
        >
          <strong>Taxa de conversão: </strong>{{ cotacao.taxaConversao }}
        </b-col>
      </b-row>
      <b-row>
        <b-col
          md="12"
          sm="12"
        >
          <strong>Valor utilizado para conversão descontando as taxas: </strong>{{ cotacao.valorPagamento }}
        </b-col>
      </b-row>
      <hr>
      <b-row>
        <b-col
          md="6"
          sm="12"
        >
          <b-button
            size="sm"
            class="pb-2"
            variant="primary"
            @click="comprar"
          >
            Comprar Moeda
          </b-button>
        </b-col>
        <b-col
          md="6"
          sm="12"
        >
          <b-button
            size="sm"
            class="pb-2"
            variant="danger"
            @click="desistir"
          >
            Desistir Compra
          </b-button>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import PageTitle from '@/components/template/PageTitle'
import axios from 'axios'
import { baseApiUrl, showError } from '@/config/global'
export default {
  name: 'App',
  components: { PageTitle },
  data () {
    return {
      moedas: [{value: null, text: 'Selecionar Moeda'}],
      formas: [
        {value: null, text: 'Selecione a Forma de Pagamento'},
        {value: 'BOLETO', text: 'Boleto Bancario'},
        {value: 'CARTAO', text: 'Cartão de Crédito'},
        ],
      invoice: {
        usuario_id: null,
        moeda_origem: null,
        moeda_destino: null,
        valor: 0,
        pagamento: null
      },
      cotacao: null
    }
  },
  computed: mapState(['isSideMenuVisible', 'usuario']),
  mounted () {
    this.getMoedas()
  },
  created () {
    this.getMoedas()
  },
  methods: {
    getMoedas () {
      axios.get(`${baseApiUrl}/moedas/listar`).then(res => {
        const retorno = res.data.moedas
        this.resetMoedas()
        retorno.map(moeda => {
           this.moedas.push({
             value: moeda.sigla,
             text: moeda.nome
             });
        });

      })
    },
    cotar () {
      this.invoice.usuario_id = this.usuario.id
      axios.post(`${baseApiUrl}/moedas/converter`, this.invoice).then(res => {
        this.cotacao = res.data.cotacao

        showSuccess('Solicitação realizada com sucesso', res.status)
        }).catch(function (error) {
          showError(error)
        })
    },
    comprar () {
      axios.put(`${baseApiUrl}/historico/editar/${this.cotacao.id}`, {statusCotacao: 1}).then(res => {
          this.$router.push({ path: '/historico' })
          showSuccess('Solicitação realizada com sucesso', res.status)
        }).catch(function (error) {
          showError(error)
        })
    },
    desistir () {
      console.log(this.cotacao)
      axios.put(`${baseApiUrl}/historico/editar/${this.cotacao.id}`, {statusCotacao: 2}).then(res => {
          this.$router.push({ path: '/historico' })
          showSuccess('Solicitação realizada com sucesso', res.status)
        }).catch(function (error) {
          showError(error)
        })
    },
    resetMoedas () {
      this.moedas = [{value: null, text:'Selecionar Moeda'}]
    },
    resetCotacao () {
      this.setCotacao(null)
      localStorage.removeItem(cotacaoKey)
    },
    reset () {
      this.invoice =  {
        usuario_id: null,
        moeda_origem: null,
        moeda_destino: null,
        valor: 0,
        pagamento: null
      }
      this.resetCotacao()
      this.getMoedas()
    }

  }
}
</script>

<style>
.titulo{
  font-size: 2em;
  text-align: center;
}
</style>
