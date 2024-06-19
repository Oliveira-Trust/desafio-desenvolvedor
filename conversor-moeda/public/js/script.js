function formatCurrency(input) {
    // Remove todos os caracteres que não são números ou pontos
    let value = input.value.replace(/\D/g, '');

    // Formata o valor como moeda BRL
    value = (value / 100).toLocaleString('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    });

    // Atualiza o valor do input
    input.value = value;
}

async function salvarTaxas() {
    const boleto = document.getElementById('boleto').value;
    const cartaoCredito = document.getElementById('cartao_credito').value;
    const conversaoMaior3000 = document.getElementById('conversao_maior_3000').value;
    const conversaoMenor3000 = document.getElementById('conversao_menor_3000').value;

    try {
        const response = await fetch("/salvar-taxas-editadas", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                boleto: boleto,
                cartao_credito: cartaoCredito,
                conversao_maior_3000: conversaoMaior3000,
                conversao_menor_3000: conversaoMenor3000
            })
        });

        const data = await response.json();

        if (response.ok) {
            document.getElementById('result').innerHTML = `
                <div class="alert alert-success">
                    <strong>Taxas salvas com sucesso!</strong>
                </div>
            `;

            // Atualiza os valores na tabela
            document.querySelector('tr[data-taxa="BO"] .taxa-valor').textContent = boleto;
            document.querySelector('tr[data-taxa="CC"] .taxa-valor').textContent = cartaoCredito;
            document.querySelector('tr[data-taxa="CMA"] .taxa-valor').textContent = conversaoMaior3000;
            document.querySelector('tr[data-taxa="CME"] .taxa-valor').textContent = conversaoMenor3000;

            // Exibe a tabela atualizada e esconde o formulário de edição
            document.getElementById('taxaTableContainer').style.display = 'block';
            document.getElementById('editFormContainer').style.display = 'none';
            document.getElementById('editButton').style.display = 'inline-block';
            document.getElementById('cancelButton').style.display = 'none';

        } else {
            document.getElementById('result').innerHTML = `
                <div class="alert alert-danger">
                    <strong>Erro ao salvar as taxas:</strong> ${data.error}
                </div>
            `;
        }
    } catch (error) {
        document.getElementById('result').innerHTML = `
            <div class="alert alert-danger">
                <strong>Erro ao salvar as taxas:</strong> ${error.message}
            </div>
        `;
    }
}

async function converterValor() {
    const moedaOrigem = 'BRL';
    const moedaDestino = document.getElementById('moeda_destino').value;
    const valor = document.getElementById('valor').value.replace(/[^\d,]/g, '').replace(',', '.'); // Remove o prefixo e converte para número real
    const formaPagamento = document.getElementById('forma_pagamento').value;

    // Verifica se todos os campos estão preenchidos
    if (!moedaDestino || !valor || !formaPagamento) {
        document.getElementById('result').innerHTML = `
            <div class="alert alert-danger" role="alert">
                Por favor, preencha todos os campos.
            </div>
        `;
        return;
    }

    // Verifica se o valor está dentro do intervalo permitido
    if (valor < 1000) {
        document.getElementById('result').innerHTML = `
            <div class="alert alert-danger" role="alert">
                Por favor, insira um valor maior que 1.000,00.
            </div>
        `;
        return;
    }
    if (valor > 100000) {
        document.getElementById('result').innerHTML = `
            <div class="alert alert-danger" role="alert">
                Por favor, insira um valor menor que 100.000,00.
            </div>
        `;
        return;
    }

    const response = await fetch("/converter-valor", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            moeda_origem: moedaOrigem,
            moeda_destino: moedaDestino,
            valor: valor,
            forma_pagamento: formaPagamento
        })
    });

    const data = await response.json();

    if (response.ok) {
        document.getElementById('result').innerHTML = `
                <div class="alert alert-success">
                    <strong>Conversão realizada com sucesso!</strong>
                    <p>Moeda de Origem: ${data.data.moeda_origem}</p>
                    <p>Moeda de Destino: ${data.data.moeda_destino}</p>
                    <p>Valor para Conversão: ${data.data.valor_para_conversao}</p>
                    <p>Forma de Pagamento: ${data.data.forma_pagamento}</p>
                    <p>Valor da Moeda de destino: ${data.data.bid_destino}</p>
                    <p>Valor Comprado: ${data.data.valor_comprado}</p>
                    <p>Taxa de Pagamento: ${data.data.taxa_pagamento}</p>
                    <p>Taxa de Conversão: ${data.data.taxa_conversao}</p>
                    <p>Valor Utilizado para Conversão: ${data.data.valor_utilizado_para_conversao}</p>
                </div>
            `;
    } else {
        document.getElementById('result').innerHTML = `
                <div class="alert alert-danger">
                    <strong>Erro ao realizar a conversão:</strong> ${data.error}
                </div>
            `;
    }

}

document.addEventListener('DOMContentLoaded', function () {
    const valorInput = document.getElementById('valor');
    if (valorInput) {
        valorInput.addEventListener('input', function () {
            formatCurrency(this);
        });
    }

    const saveButton = document.getElementById('saveButton');
    if (saveButton) {
        saveButton.addEventListener('click', salvarTaxas);
    }

    const convertButton = document.getElementById('convertButton');
    if (convertButton) {
        convertButton.addEventListener('click', converterValor);
    }

    const editButton = document.getElementById('editButton');
    if (editButton) {
        editButton.addEventListener('click', function () {
            document.getElementById('taxaTableContainer').style.display = 'none';
            document.getElementById('editFormContainer').style.display = 'block';
            document.getElementById('editButton').style.display = 'none';
            document.getElementById('cancelButton').style.display = 'inline-block';
        });
    }

    const cancelButton = document.getElementById('cancelButton');
    if (cancelButton) {
        cancelButton.addEventListener('click', function () {
            document.getElementById('taxaTableContainer').style.display = 'block';
            document.getElementById('editFormContainer').style.display = 'none';
            document.getElementById('editButton').style.display = 'inline-block';
            document.getElementById('cancelButton').style.display = 'none';
        });
    }
});
