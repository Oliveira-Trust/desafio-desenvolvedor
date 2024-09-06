
$(document).ready(function () {
    $('.money').mask('#.##0,00', {reverse: true});

    const numberInput = document.getElementById('valor');
    const rangeInput = document.getElementById('range');
    const moedaOrigemSelect = document.getElementById('moeda_origem');
    const moedaDestinoSelect = document.getElementById('moeda_destino');
    const pagamentoSelect = document.getElementById('pagamento');
    const valorLabel = document.getElementById('valor_label');
    const limparCamposBtn = document.getElementById('limpar_campos');

    function updateValorLabel() {
        const moedaDestino = moedaOrigemSelect.options[moedaOrigemSelect.selectedIndex].text;
        valorLabel.textContent = `Valor de compra em ${moedaDestino}`;
    }

    function updateNumberInput() {
        let rawValue = rangeInput.value;
        numberInput.value = parseFloat(rawValue).toLocaleString('pt-BR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
        $(numberInput).mask('#.##0,00', {reverse: true});
    }

    function updateRangeInput() {
        let rawValue = numberInput.value.replace(/\./g, '').replace(',', '.');
        rangeInput.value = parseFloat(rawValue).toFixed(2);
    }

    limparCamposBtn.addEventListener('click', (e) => {
        e.preventDefault(); // Previne o comportamento padrão do link

        window.location.reload();
    });

    rangeInput.addEventListener('input', updateNumberInput);
    numberInput.addEventListener('input', updateRangeInput);
    moedaDestinoSelect.addEventListener('change', updateValorLabel);

    updateNumberInput();
    updateValorLabel();
});
