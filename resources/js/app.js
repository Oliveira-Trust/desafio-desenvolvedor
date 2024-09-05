import './bootstrap';


document.addEventListener('DOMContentLoaded', (event) => {
    // Seleciona os elementos de entrada
    const numberInput = document.getElementById('valor');
    const rangeInput = document.getElementById('range');

    // Função para atualizar o campo numérico com o valor do controle deslizante
    function updateNumberInput() {
        numberInput.value = rangeInput.value;
    }

    // Adiciona um ouvinte de eventos para atualizar o campo numérico ao mover o controle deslizante
    rangeInput.addEventListener('input', updateNumberInput);

    // Inicializa o campo numérico com o valor do controle deslizante na carga da página
    updateNumberInput();

    // Função para atualizar o controle deslizante com o valor do campo numérico
    function updateRangeInput() {
        rangeInput.value = numberInput.value;
    }

    // Adiciona um ouvinte de eventos para atualizar o controle deslizante ao alterar o campo numérico
    numberInput.addEventListener('input', updateRangeInput);
});







