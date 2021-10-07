<template>
  <div class="hitorico">
    <PageTitle
      icon="fa fa-history"
      main="Conversor de Moedas"
      sub="Historico de Conversões"
    />
    <b-table
      id="historicos"
      hover
      striped
      :items="historicos"
      :fields="fieldsHistorico"
    />
    <p class="mt-3">
      Pagina Atual: {{ currentPage }}
    </p>
    <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="historicos"
    />
  </div>
</template>

<script>
import { mapState } from 'vuex'
import PageTitle from '@/components/template/PageTitle'
import axios from 'axios'
import { baseApiUrl, showError } from '@/config/global'
export default {
    name: 'Historico',
    components: { PageTitle },
    data () {
    return {
      historico: {},
      historicos: [],
      rows: 0,
      perPage: 5,
      currentPage: 1,
      fieldsHistorico: [
        { key: 'id', label: 'ID', sortable: true },
        { key: 'usuario.nome', label: 'Usuario', sortable: true },
        { key: 'data_cotacao', label: 'Data Cotação', sortable: true },
        { key: 'valorEntrada', label: 'Valor para Conversão', sortable: true },
        { key: 'moeda_origem', label: 'Moeda de Origem', sortable: true },
        { key: 'moeda_destino', label: 'Moeda de Destino', sortable: true },
        { key: 'formaPagamento', label: 'Forma de Pagamento', sortable: true },
        { key: 'valor_moeda_destino', label: 'Valor da "Moeda de destino"', sortable: true },
        { key: 'taxaPagamento', label: 'Taxa de pagamento', sortable: true },
        { key: 'taxaConversao', label: 'Taxa de conversão', sortable: true },
        { key: 'valorMoedaDestino', label: 'Valor utilizado para conversão', sortable: true },
        { key: 'valorPagamento', label: 'Valor Convertido', sortable: true },
        { key: 'statusCotacao', label: 'Status', sortable: true, formatter: value => value === 0 ? 'Em Aberto' : value === 1 ? 'Aguardando Pagamento': 'Cotação Cancelado'}
      ]
    }
    },
    computed: mapState(['isSideMenuVisible', 'usuario']),
    watch:{
      currentPage: {
      handler: function (value) {
        this.fetch().catch(error => {
          console.error(error)
        }).catch(showError)
      }
    }
    },
    mounted () {
      this.loadHistoricos()
    },
    methods: {
      loadHistoricos () {
        const url = `${baseApiUrl}/historico/listar`
        const data = { usuario_id: this.usuario.id, admin: this.usuario.admin }
        axios.get(url, data).then( res => {
          this.historicos = res.data.historicos
          this.rows = res.data.rows
          showSuccess('Solicitação realizada com sucesso', res.status)
        }).catch(function (error) {
          showError(error)
        })
      },
      async fecth () {
        const url = `${baseApiUrl}/historico/listar`
        const data = { usuario_id: this.usuario.id, admin: this.usuario.admin }
        axios.get(url, data).then( res => {
          this.historicos = res.data.historicos
          this.rows = res.data.rows
          showSuccess('Solicitação realizada com sucesso', res.status)
        }).catch(function (error) {
          showError(error)
        })
      },
    }
}
</script>

<style>

</style>
