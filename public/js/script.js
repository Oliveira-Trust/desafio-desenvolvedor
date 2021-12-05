fromCurrency = document.querySelector(".from select"),
toCurrency = document.querySelector(".to select"),
getButton = document.querySelector("form button");

let country_list = {
    "USD" : "US",
    "EUR" : "FR",
}

let i = 0;
for(let currency_code in country_list){
    let selected = i == 0 ? currency_code == "USD" ? "selected" : "" : "";
    let optionTag = `<option value="${currency_code}" ${selected}>${currency_code}</option>`;
    toCurrency.insertAdjacentHTML("beforeend", optionTag);
    i++;
}

toCurrency.addEventListener("change", e =>{
    changeFlag(e.target);
});

function changeFlag(element){
    let imgTag = element.parentElement.querySelector("img");
    imgTag.src = `https://flagcdn.com/48x36/${country_list[element.value].toLowerCase()}.png`;
}

getButton.addEventListener("click", e => {
    e.preventDefault();
    sendConversion();
});

function sendConversion(){
    const amount          = document.querySelector("form input");
    const exchangeRateTxt = document.querySelector("form .exchange-rate");
    const typePayment     = document.querySelector("form .typePayment");
    
    let amountVal = amount.value;

    if(amountVal == "" || amountVal == "0"){
        amount.value = "1000";
        amountVal = 1000;
    }

    if( amountVal < 1000 || amountVal > 100000 ){
        exchangeRateTxt.innerText = "Valor permitido entre 1.000 e 100.000";    
        return;
    }

    exchangeRateTxt.innerText = "Carregando...";
    
    let url = `https://economia.awesomeapi.com.br/json/last/${toCurrency.value}-${fromCurrency.value}`;

    fetch(url).then(response => response.json()).then(data => {
        const result = data[toCurrency.value + fromCurrency.value];
        result['amount'] = amountVal;
        result['typePayment'] = typePayment.value;
        exchangeRateTxt.innerHTML = calculate(result);
    }).catch(() =>{
        exchangeRateTxt.innerText = "Opss!!! Algo deu errado";
    });
}

function calculate(result) {

    let txPayment    = 0;
    let txConversion = 0;
    let vlConversion = 0;

    if( result.typePayment == 'BOLETO' ) {
        txPayment = (1.45 / 100) * result.amount;
    }else{
        txPayment = (7.63 / 100) * result.amount;
    }

    if( result.amount < 3000 ) {
        txConversion = 0.02 * result.amount;
    }else{
        txConversion = 0.01 * result.amount;
    }

    vlConversion = result.amount - txPayment - txConversion;

    let html = `<ul class="list-result">
        <li>Moeda de origem: ${result.codein}</li>
        <li>Moeda de destino: ${result.code}</li>
        <li>Valor para conversão: R$ ${parseFloat(result.amount).toFixed(2)}</li>
        <li>Forma de pagamento: ${result.typePayment}</li>
        <li>Valor da "Moeda de destino" usado para conversão: $ ${parseFloat(result.bid).toFixed(2)}</li>
        <li>Valor comprado em "Moeda de destino": $ ${(vlConversion / result.bid).toFixed(2)} (taxas aplicadas no valor de compra diminuindo no valor total de conversão)</li>
        <li>Taxa de pagamento: R$ ${(txPayment).toFixed(2)}</li>
        <li>Taxa de conversão: R$ ${(txConversion).toFixed(2)}</li>
        <li>Valor utilizado para conversão descontando as taxas: R$ ${(vlConversion).toFixed(2)}</li>         
    </ul>`;

    return html;
}