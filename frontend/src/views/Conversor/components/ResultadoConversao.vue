<template>
  <div class="exchange_result">
    <div>
      <label class="font-weight-bold">Moeda de origem:</label>
      {{ $attrs.value.origin_currency.name}}
    </div>
    <div>
      <label class="font-weight-bold">Moeda de destino:</label>
      {{ $attrs.value.destination_currency.name}}
    </div>
    <div>
      <label class="font-weight-bold">Forma de pagamento:</label>
      {{ $attrs.value.payment_method.name}}
    </div>
    <div><label class="font-weight-bold">Valor para conversão:</label>
      {{ $attrs.value.origin_value | toCurrency}}
    </div>
    <div>
      <label class="font-weight-bold">Valor usado para conversão:</label>
      {{ $attrs.value.destination_currency.code }} {{ $attrs.value.destination_exchange_rate }}
    </div>
    <div>
      <label class="font-weight-bold">Taxa de pagamento:</label>
      {{ $attrs.value.payment_method_fee_value | toCurrency}}
    </div>
    <div>
      <label class="font-weight-bold">Taxa de conversão:</label>
      {{ $attrs.value.exchange_fee_value | toCurrency}}
    </div>
    <div>
      <label class="font-weight-bold">Valor utilizado para conversão descontando as taxas:</label>
      {{ $attrs.value.origin_value_without_fees | toCurrency}}
    </div>
    <div>
      <label class="font-weight-bold">Valor comprado:</label>
      {{ $attrs.value.destination_currency.code }} {{ $attrs.value.purchased_value }}
    </div>
  </div>
</template>

<script>
export default {
  name: 'ResultadoConversao',
  prop: ['value'],
  model: {
    prop: 'value',
    event: 'input'
  },
  methods: {
    handleInput (e) {
      this.$emit('input', this.content)
    }
  }
}
</script>

<style scoped>
  .exchange_result{

  }
</style>
