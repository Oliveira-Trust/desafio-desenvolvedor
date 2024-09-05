$(document).ready(function() {
    // Aplica a máscara ao campo numérico
    $('.money').mask('#.##0,00', {reverse: true});

    const numberInput = document.getElementById('valor');
    const rangeInput = document.getElementById('range');
    const moedaDestinoSelect = document.getElementById('moeda_origem');
    const valorLabel = document.getElementById('valor_label');

    // Atualiza o rótulo do valor com a moeda selecionada
    function updateValorLabel() {
        const moedaDestino = moedaDestinoSelect.options[moedaDestinoSelect.selectedIndex].text;
        valorLabel.textContent = `Valor de compra em ${moedaDestino}`;
    }

    // Atualiza o campo numérico com o valor do controle deslizante
    function updateNumberInput() {
        // Remove a máscara temporariamente para obter o valor puro
        let rawValue = rangeInput.value;
        numberInput.value = parseFloat(rawValue).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        $(numberInput).mask('#.##0,00', {reverse: true});
    }

    // Atualiza o controle deslizante com o valor do campo numérico
    function updateRangeInput() {
        // Remove a máscara para obter o valor puro
        let rawValue = numberInput.value.replace(/\./g, '').replace(',', '.');
        rangeInput.value = parseFloat(rawValue).toFixed(2);
    }

    // Adiciona ouvintes de eventos
    rangeInput.addEventListener('input', updateNumberInput);
    numberInput.addEventListener('input', updateRangeInput);
    moedaDestinoSelect.addEventListener('change', updateValorLabel);

    // Inicializa os valores
    updateNumberInput();
    updateValorLabel();
});
