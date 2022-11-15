<template>
  <card>
    <h5 slot="header" class="title">Fazer login</h5>
    <div class="row">
      <div class="col-md-12 pr-md-1">
        <base-input label="Email"
          v-model="model.email"
          placeholder="Email">
        </base-input>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 pr-md-1">
        <base-input label="Senha"
          v-model="model.password"
          placeholder="senha"
          type="password">
        </base-input>
      </div>
    </div>
    <base-button slot="footer" type="primary" fill @click="$emit('login')">Login</base-button>
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
