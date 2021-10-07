<template>
  <div class="usuarios">
    <PageTitle
      icon="fa fa-coin"
      main="Conversor de usuarios"
      sub="Lista e Cadastro de Usuarios"
    />
    <b-form />

    <b-table
      id="usuarios"
      hover
      striped
      :items="usuarios"
      :fields="fieldsusuarios"
    >
      <template v-slot:cell(actions)="data">
        <b-button
          variant="warning"
          class="mr-2"
          @click="loadUsuario(data.item,'Editar')"
        >
          <i class="fa fa-pencil" />
        </b-button>
        <b-button
          variant="danger"
          @click="loadUsuario(data.item, 'Remover')"
        >
          <i class="fa fa-trash" />
        </b-button>
      </template>
    </b-table>
    <p class="mt-3">
      Pagina Atual: {{ currentPage }}
    </p>
    <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="usuarios"
    />
    <hr>
    <b-button
      v-if="save===null"
      variant="success"
      @click="loadUsuario(null,'Adicionar')"
    >
      Novo Usuário
    </b-button>

    <b-form v-else>
      <b-row>
        <b-col>
          <b-form-group
            label="Nome do Usuário:"
            label-form="usuario-nome"
          >
            <b-form-input v-model="formUser.nome" />
          </b-form-group>
        </b-col>
        <b-col>
          <b-form-group
            label="E-mail do Usuário:"
            label-form="usuario-email"
          >
            <b-form-input v-model="formUser.email" />
          </b-form-group>
        </b-col>
      </b-row>
      <b-row>
        <b-col>
          <b-form-group
            label="Taxa Boleto:"
            label-form="usuario-admin"
          >
            <b-form-select
              id="moeda-pagamento"
              v-model="formUser.admin"
              :options="optionAdmin"
            />
          </b-form-group>
        </b-col>
        <b-col>
          <b-form-group
            label="Status:"
            label-form="usuario-status"
          >
            <b-form-select
              id="moeda-pagamento"
              v-model="formUser.ativo"
              :options="optionStatus"
            />
          </b-form-group>
        </b-col>
      </b-row>
      <hr>
      <b-row>
        <b-col>
          <b-button
            variant="primary"
            @click="salvar"
          >
            Salvar Usuario
          </b-button>
        </b-col>
        <b-col>
          <b-button
            @click="reset"
          >
            Limpar Formulario
          </b-button>
        </b-col>
      </b-row>
    </b-form>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import PageTitle from '@/components/template/PageTitle'
import axios from 'axios'
import { baseApiUrl, showError } from '@/config/global'
export default {
    name: 'Usuarios',
    components: { PageTitle },
    data () {
    return {
      save: null,
      formUser: {},
      usuarios: [],
      rows: 0,
      perPage: 5,
      currentPage: 1,
      fieldsusuarios: [
        { key: 'id', label: 'ID', sortable: true },
        { key: 'nome', label: 'Nome', sortable: true },
        { key: 'email', label: 'E-mail', sortable: true },
        { key: 'ativo', label: 'Status', sortable: true, formatter: value => value === 0 ? 'Inativo' : 'Ativo'},
        { key: 'admin', label: 'Administrador', sortable: true, formatter: value => value === 0 ? 'Não' : 'Sim'},
        { key: 'actions', label: 'Ações' }
      ],
      optionStatus: [{value:0,text:'Inativo'},{value:1,text:'Ativo'}],
      optionAdmin: [{value:0,text:'Não'},{value:1,text:'Sim'}]
    }
    },
    watch:{
      currentPage: {
      handler: function (value) {
        this.fetch().catch(error => {
           showSuccess('Solicitação realizada com sucesso', res.status)
        }).catch(function (error) {
          showError(error)
        })
      }
    }
    },
    mounted () {
      this.loadUsuarios()
    },
    methods: {
      loadUsuarios () {
        const url = `${baseApiUrl}/usuarios/listar`
        axios.get(url).then( res => {
          this.usuarios = res.data.usuarios
          this.rows = res.data.rows
          showSuccess('Solicitação realizada com sucesso', res.status)
        }).catch(function (error) {
          showError(error)
        })
      },
      async fecth () {
        const url = `${baseApiUrl}/usuarios/listar`
        axios.get(url).then( res => {
          this.usuarios = res.data.usuarios
          this.rows = res.data.rows
            showSuccess('Solicitação realizada com sucesso', res.status)
        }).catch(function (error) {
          showError(error)
        })
      },
      reset () {
        this.formUser = null
        this.save = null
        this.loadUsuarios()
      },
      salvar () {
        const path = this.save==='Adicionar' ? "nova":this.save==='Editar'? "editar":"deletar"
        const method = this.save==='Adicionar' ? "post":this.save==='Editar'? "put":"delete"
        const id = this.moeda.id ? `${path}/${this.moeda.id}`: path
        const url = `${baseApiUrl}/usuarios/${id}`

        axios[method](url, this.moeda).then(() => {
          this.$toasted.global.defaultSuccess()
          this.reset()
          this.loadUsuarios()
           showSuccess('Solicitação realizada com sucesso', res.status)
        }).catch(function (error) {
          showError(error)
        })
      },
      loadUsuario (formUser, save = 'Adicionar') {
          if(save!=='Adicionar'){
            this.formUser = { ...formUser }
          }
          this.save = save
      }
    }
}
</script>

<style>

</style>
