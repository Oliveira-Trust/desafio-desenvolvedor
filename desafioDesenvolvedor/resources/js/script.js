const currencyFrom = document.getElementById('currency_from');
const currencyTo = document.getElementById('currency_to');
const paymentType = document.getElementById('payment_type');

// validates if BRL is in range
document.getElementById('convert').addEventListener('click', () => {

  const message = document.getElementById('validation_range_value');

  currencyFrom.classList.remove('is-invalid');

  if (currencyFrom.value < 1000 || currencyFrom.value == '') {
    message.innerText = 'Valor deve ser maior que R$ 1.000,00';
    currencyFrom.classList.add('is-invalid');
    return false;
  }

  if (currencyFrom.value > 100000) {
    message.innerText = 'Valor deve ser menor que R$ 100.000,00';
    currencyFrom.classList.add('is-invalid');
    return false;
  }

  const price = priceQuotation(currencyTo.value);
  price.then(result => {
    sendValuesToController(currencyFrom.value, currencyTo.value, paymentType.value, result);
  });

});

/**
 *
 * @param {*} currencyTo
 * @returns data
 * @description Function to get the quote value
 */
function priceQuotation(currencyTo) {
  const url = `https://economia.awesomeapi.com.br/last/${currencyTo}-BRL`;
  const settings = {
    method: 'GET',
    redirect: 'follow'
  }

  let data = fetch(url, settings)
              .then(response => response.json());

  return data;
}

/**
 *
 * @param {*} currencyFrom
 * @param {*} currencyTo
 * @param {*} paymentType
 * @param {*} currencyQuote
 * @description Function to send the information to the controller via ajax
 */
function sendValuesToController(currencyFrom, currencyTo, paymentType, currencyQuote) {
  const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const url = document.getElementById('value_quote').getAttribute('action');

  const settings = {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, */*",
      "X-Requested-With": "XMLHttpRequest",
      "X-CSRF-TOKEN": token
    },
    method: 'POST',
    body: JSON.stringify({
      currencyFrom: currencyFrom,
      currencyTo: currencyTo,
      paymentType: paymentType,
      currencyQuote: currencyQuote
    })
  }

  fetch(url, settings)
  .then(response => response.json())
  .then(result => {

    let paymentType = result.paymentType == 1 ? 'Boleto' : 'Cartão de Crédito'

    document.getElementById('quote_result_main').classList.remove('d-none');
    document.getElementById('quote_result_list').innerHTML = `
      <li class="list-group-item">Moeda de origem: BRL</li>
      <li class="list-group-item">Moeda de destino: ${result.currencyTo}</li>
      <li class="list-group-item">Valor para conversão: R$ ${result.valueInit}</li>
      <li class="list-group-item">Forma de pagamento: ${paymentType}</li>
      <li class="list-group-item">Valor da "Moeda de destino" usado para conversão: $ ${result.currencyQuote}</li>
      <li class="list-group-item">Valor comprado em "Moeda de destino": $ ${result.valueFinal} (taxas aplicadas no valor de compra diminuindo no valor total de conversão)</li>
      <li class="list-group-item">Taxa de pagamento: R$ ${result.paymentFee}</li>
      <li class="list-group-item">Taxa de conversão: R$ ${result.quoteFee}</li>
      <li class="list-group-item">Valor utilizado para conversão descontando as taxas: R$ ${result.valueDescountFee}</li>`;
  })
  .catch(error => console.log('error', error));
}
