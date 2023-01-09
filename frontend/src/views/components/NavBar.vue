<template>
  <div class="mb-3">
    <b-navbar type="dark" variant="dark">
      <b-navbar-nav>
        <b-nav-item :to="{name:'home'}">Home</b-nav-item>
        <b-nav-item :to="{name:'taxas'}">Taxas</b-nav-item>
        <b-nav-item href="#">Conversor</b-nav-item>
        <b-nav-item href="#">Histórico de conversões</b-nav-item>
      </b-navbar-nav>
      <b-navbar-nav class="ml-auto">
        <b-nav-item :to="{name:'login'}" right>Sair</b-nav-item>
      </b-navbar-nav>
    </b-navbar>
  </div>
</template>

<script>
export default {
  name: 'NavBar'
}
</script>

<style scoped>

</style>
