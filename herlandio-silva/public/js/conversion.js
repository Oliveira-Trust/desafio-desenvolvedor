document.getElementById('conversion-form').addEventListener('submit', function(event) {
    event.preventDefault();

    let formData        = new FormData(this);
    let successMessage  = document.getElementById('success-message');
    let errorMessage    = document.getElementById('error-message');
    let rmimg           = document.getElementById('rm-img');

    fetch('/conversion', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            addConversionData(data.data);
            const details = `
                    <p>Moeda de origem: ${data.data.fromCurrency}</p>
                    <p>Moeda de destino: ${data.data.toCurrency}</p>
                    <p>Valor para conversão: R$${data.data.valueToConversion}</p>
                    <p>Forma de pagamento: ${data.data.paymentType === "ticket" ? "Boleto" : "Cartão de crédito"}</p>
                    <p>Valor da "Moeda de destino" usado para conversão: $${data.data.usedValueToConversion}</p>
                    <p>Valor comprado em "Moeda de destino": $${data.data.purchasedValue} (taxas aplicadas no valor de compra diminuindo no valor total de conversão)</p>
                    <p>Taxa de pagamento: R$  ${data.data.feePayment}</p>
                    <p>Taxa de conversão: R$  ${data.data.feeConversion}</p>
                    <p>Valor utilizado para conversão descontando as taxas: R$${data.data.conversionWithoutFee}</p>
                `;
            successMessage.innerHTML = details;
            successMessage.classList.remove('d-none');
            errorMessage.classList.add('d-none');
            rmimg?.remove();
        } else {
            errorMessage.textContent = data.error;
            errorMessage.classList.remove('d-none');
            successMessage.classList.add('d-none');
            rmimg?.remove();
        }
    })
    .catch(error => {
        console.log(error);
        errorMessage.textContent = "Erro ao fazer cotação";
        errorMessage.classList.remove('d-none');
        successMessage.classList.add('d-none');
    });
});

function getConversionData() {
    return JSON.parse(localStorage.getItem('conversionData')) || [];
}

function setConversionData(data) {
    localStorage.setItem('conversionData', JSON.stringify(data));
}

function addConversionData(newData) {
    const data = getConversionData();
    data.push(newData);
    setConversionData(data);
    populateTable();
}

function populateTable() {
    const data = getConversionData();
    const tableBody = document.getElementById('conversionDataBody');
    tableBody.innerHTML = '';
    data.forEach(item => {
        const row = document.createElement('tr');
        const fromCurrency = document.createElement('td');
        fromCurrency.textContent = item.fromCurrency;
        row.appendChild(fromCurrency);
        const toCurrency = document.createElement('td');
        toCurrency.textContent = item.toCurrency;
        row.appendChild(toCurrency);
        const valueToConversion = document.createElement('td');
        valueToConversion.textContent = `R$ ${item.valueToConversion}`;
        row.appendChild(valueToConversion);
        const paymentType = document.createElement('td');
        paymentType.textContent = item.paymentType === "ticket" ? "Boleto" : "Cartão de crédito";
        row.appendChild(paymentType);
        const usedValueToConversion = document.createElement('td');
        usedValueToConversion.textContent = `$ ${item.usedValueToConversion}`;
        row.appendChild(usedValueToConversion);
        const purchasedValue = document.createElement('td');
        purchasedValue.textContent = `$ ${item.purchasedValue}`;
        row.appendChild(purchasedValue);
        const feePayment = document.createElement('td');
        feePayment.textContent = `R$ ${item.feePayment}`;
        row.appendChild(feePayment);
        const feeConversion = document.createElement('td');
        feeConversion.textContent = `R$ ${item.feeConversion}`;
        row.appendChild(feeConversion);
        const conversionWithoutFee = document.createElement('td');
        conversionWithoutFee.textContent = `R$ ${item.conversionWithoutFee}`;
        row.appendChild(conversionWithoutFee);
        tableBody.appendChild(row);
    });
}

document.addEventListener('DOMContentLoaded', populateTable);