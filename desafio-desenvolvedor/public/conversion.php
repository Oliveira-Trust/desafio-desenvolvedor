<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: login.php');
    exit;
}

// Função para buscar taxas de câmbio
function buscarTaxasCambio() {
    $url = 'https://economia.awesomeapi.com.br/json/last/BRL-USD,USD-BRL';
    $json = file_get_contents($url);
    return json_decode($json, true);
}

// Inicializa variáveis
$conversionResult = '';
$errorMessage = '';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $moedaOrigem = $_POST['moedaOrigem'];
    $moedaDestino = $_POST['moedaDestino'];
    $valor = $_POST['valor'];

    // Valida o valor
    if (!is_numeric($valor) || $valor <= 0) {
        $errorMessage = 'Por favor, insira um valor válido.';
    } else {
        // Obtém as taxas de câmbio
        $taxasCambio = buscarTaxasCambio();
        
        // Converte as taxas de câmbio para um formato mais acessível
        $taxaCompra = $taxasCambio[$moedaOrigem . $moedaDestino]['bid'];
        $taxaVenda = $taxasCambio[$moedaDestino . $moedaOrigem]['ask'];
        
        // Calcula o valor convertido
        if ($moedaOrigem === 'BRL' && $moedaDestino === 'USD') {
            $conversionResult = $valor * $taxaCompra;
        } elseif ($moedaOrigem === 'USD' && $moedaDestino === 'BRL') {
            $conversionResult = $valor * $taxaVenda;
        } else {
            $errorMessage = 'Conversão não suportada.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversão de Moeda</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Conversão de Moeda</h1>
        <form id="conversionForm" action="conversion.php" method="POST">
            <label for="moedaOrigem">Moeda de origem:</label>
            <select id="moedaOrigem" name="moedaOrigem" required>
                <option value="BRL">BRL - Real Brasileiro</option>
                <option value="USD">USD - Dólar Americano</option>
            </select>
            <br>

            <label for="moedaDestino">Moeda de destino:</label>
            <select id="moedaDestino" name="moedaDestino" required>
                <option value="USD">USD - Dólar Americano</option>
                <option value="BRL">BRL - Real Brasileiro</option>
            </select>
            <br>

            <label for="valor">Valor para conversão (R$):</label>
            <input type="number" id="valor" name="valor" min="1" required>
            <br>

            <label for="formaPagamento">Forma de pagamento:</label>
            <select id="formaPagamento" name="formaPagamento" required>
                <option value="boleto">Boleto</option>
                <option value="cartao">Cartão de Crédito</option>
            </select>
            <br>

            <button type="submit">Converter</button>
        </form>

        <?php if ($errorMessage): ?>
            <div class="error"><?= htmlspecialchars($errorMessage) ?></div>
        <?php endif; ?>

        <?php if ($conversionResult): ?>
            <div class="result">
                <h2>Resultado da Conversão</h2>
                <p><?= htmlspecialchars($valor) ?> <?= $moedaOrigem ?> é igual a <?= number_format($conversionResult, 2, ',', '.') ?> <?= $moedaDestino ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
