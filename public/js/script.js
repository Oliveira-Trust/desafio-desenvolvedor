function clearTextarea() {
    var textarea = document.getElementById('resultfinal');
    textarea.value = '';
    textarea.style.display = 'none';
}

function applyDecimalMask() {
  $('.decimal-input').inputmask('decimal', {
      radixPoint: '.',
      groupSeparator: '',
      digits: 2,
      autoGroup: true,
      rightAlign: false,
      allowMinus: false
  });
}

/* function formatValue(input) {
    // Remove caracteres não numéricos, exceto o ponto decimal
    let value = input.value.replace(/[^0-9.]/g, '');
  
    // Limita o valor máximo a 100000
    if (parseFloat(value) > 100000) {
      value = '100000';
    }
  
    // Formata o valor com duas casas decimais e separador de milhar
    const formattedValue = parseFloat(value).toLocaleString('pt-BR', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    });
  
    input.value = formattedValue;
  } */