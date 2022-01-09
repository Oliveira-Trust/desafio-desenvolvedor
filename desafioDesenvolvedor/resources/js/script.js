const brl = document.getElementById('brl_value');

brl.addEventListener('focusout', () => {
  const message = document.getElementById('validation_range_value');

  brl.classList.remove('is-invalid');

  if (brl.value < 1000) {
    message.innerText = 'Valor deve ser maior que R$ 1.000,00';
    brl.classList.add('is-invalid');
  }

  if (brl.value > 100000) {
    message.innerText = 'Valor deve ser menor que R$ 100.000,00';
    brl.classList.add('is-invalid');
  }

});

