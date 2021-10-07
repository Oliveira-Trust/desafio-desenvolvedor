<template>
  <div class="page-title">
    <h1>
      <i
        v-if="icon"
        :class="icon"
      /> {{ main }}
    </h1>
    <h2>{{ sub }}</h2>
    <hr>
  </div>
</template>

<script>
export default {
    name: 'PageTitle',
    props: {
        // eslint-disable-next-line vue/require-default-prop
        icon: String,
        // eslint-disable-next-line vue/require-default-prop
        main: String,
        // eslint-disable-next-line vue/require-default-prop
        sub: String
    }
}
</script>

<style>
    .page-title h1 {
        margin: 0px;
    }

    .page-title h2 {
        color: #777;
        margin-top: 5px;
        font-size: 1.3rem;
    }
</style>
