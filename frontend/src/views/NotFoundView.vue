<template>
  <div class="d-flex align-items-center justify-content-center vh-100">
    <div class="text-center">
      <p class="fs-3"> <span class="text-danger">Opps!</span> Página não encontrada.</p>
      <b-link
        class="nav-link"
        :to="{ name: 'login' }"
      >
        <a class="btn btn-primary">Voltar para página inicial</a>
      </b-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'NotFoundView',
  data() {
    return {}
  },
}
</script>

<style scoped>
</style>
