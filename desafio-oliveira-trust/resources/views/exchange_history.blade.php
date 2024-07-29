<!DOCTYPE html>
<html>

<head>
    <title>Histórico de Cotações</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="main">
    <div class="container-result">
        <h1>Histórico de Cotações</h1>
        <table>
            <thead>
                <tr>
                    <th>Moeda de Destino</th>
                    <th>Valor para Conversão</th>
                    <th>Valor da moeda atual</th>
                    <th>Taxa de Pagamento</th>
                    <th>Taxa de Conversão</th>
                    <th>Valor Líquido</th>
                    <th>Método de Pagamento</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody id="history-body">
                <!-- Dados recuperado -->
            </tbody>
        </table>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/api/showHistory', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('jwtToken')
                    }
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Erro na autenticação ou na requisição');
                    }
                })
                .then(data => {
                    const historyBody = document.getElementById('history-body');
                    if (data.data.length === 0) {
                        historyBody.innerHTML = '<tr><td colspan="8">Nenhuma cotação encontrada.</td></tr>';
                    } else {
                        historyBody.innerHTML = data.data.map(item => `
                        <tr>
                            <td>${item.destination_currency}</td>
                            <td>R$ ${parseFloat(item.amount).toFixed(2).replace('.', ',')}</td>
                            <td>$ ${parseFloat(item.conversion_rate).toFixed(2).replace('.', ',')}</td>
                            <td>R$ ${parseFloat(item.payment_fee).toFixed(2).replace('.', ',')}</td>
                            <td>R$ ${parseFloat(item.conversion_fee).toFixed(2).replace('.', ',')}</td>
                            <td>R$ ${parseFloat(item.net_amount).toFixed(2).replace('.', ',')}</td>
                            <td>${item.payment_method}</td>
                            <td>${new Date(item.created_at).toLocaleDateString('pt-BR')} ${new Date(item.created_at).toLocaleTimeString('pt-BR')}</td>
                        </tr>
                    `).join('');
                    }
                })
                .catch(error => {
                    console.error('Erro ao carregar histórico:', error);                    
                });
        });
    </script>
</body>

</html>
