
    $(document).ready(function() {
    $('.money').mask('#.##0,00', {reverse: true});

    const numberInput = document.getElementById('valor');
    const rangeInput = document.getElementById('range');

    function updateNumberInput() {
    let rawValue = rangeInput.value;
    numberInput.value = parseFloat(rawValue).toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    $(numberInput).mask('#.##0,00', {reverse: true});
}

    function updateRangeInput() {
    let rawValue = numberInput.value.replace(/\./g, '').replace(',', '.');
    rangeInput.value = parseFloat(rawValue).toFixed(2);
}

    rangeInput.addEventListener('input', updateNumberInput);
    numberInput.addEventListener('input', updateRangeInput);

    updateNumberInput();
});


