const currency_from = document.getElementById('currency_from');
const currency_to = document.getElementById('currency_to');
const payment_type = document.getElementById('payment_type');

// validates if BRL is in range
document.getElementById('convert').addEventListener('click', () => {

  const message = document.getElementById('validation_range_value');

  currency_from.classList.remove('is-invalid');

  if (currency_from.value < 1000 || currency_from.value == '') {
    message.innerText = 'Valor deve ser maior que R$ 1.000,00';
    currency_from.classList.add('is-invalid');
    return false;
  }

  if (currency_from.value > 100000) {
    message.innerText = 'Valor deve ser menor que R$ 100.000,00';
    currency_from.classList.add('is-invalid');
    return false;
  }

  /**
   * TODO Criar via fecth requisão para enviar os dados abaixo para o controle, para o tratamento
   */
  console.log(currency_from.value);
  console.log(currency_to.value);
  console.log(payment_type.value);

});
