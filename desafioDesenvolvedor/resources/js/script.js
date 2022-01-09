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
  const url = document.getElementsByTagName('form')[0].getAttribute('action');
  const method = 'POST';

  const settings = {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, */*",
      "X-Requested-With": "XMLHttpRequest",
      "X-CSRF-TOKEN": token
    },
    method: method,
    credentials: "same-origin",
    body: JSON.stringify({
      currencyFrom: currencyFrom,
      currencyTo: currencyTo,
      paymentType: paymentType,
      currencyQuote: currencyQuote
    })
  }

  fetch(url, settings)
  .then(response => response.text())
  .then(result => {console.log(result)})
  .catch(error => console.log('error', error));
}
