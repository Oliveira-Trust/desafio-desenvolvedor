<template>
  <card>
    <h5 slot="header" class="title">Criar conta</h5>
    <div class="row">
      <div class="col-md-6 pr-md-1">
        <base-input label="Nome"
          v-model="model.name"
          placeholder="Nome">
        </base-input>
      </div>
      <div class="col-md-6 pl-md-1">
        <base-input label="Email"
          type="email"
          v-model="model.email"
          placeholder="mike@email.com">
        </base-input>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 pr-md-1">
        <base-input label="Senha"
          v-model="model.password"
          placeholder="senha"
          type="password">
        </base-input>
      </div>
      <div class="col-md-6 px-md-1">
        <base-input label="Confirmar senha"
          v-model="model.confirm_password"
          placeholder="senha"
          type="password">
        </base-input>
      </div>
    </div>
    <base-button slot="footer" type="primary" fill @click="$emit('register')">Registrar</base-button>
  </card>
</template>
<script>
  export default {
    props: {
      model: {
        type: Object,
        default: () => {
          return {};
        }
      }
    }
  }
</script>
<style>
</style>
