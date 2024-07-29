<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da Conversão</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $moedaOrigem = $_POST['moedaOrigem'];
    $moedaDestino = $_POST['moedaDestino'];
    $valor = (float)$_POST['valor'];
    $formaPagamento = $_POST['formaPagamento'];

    $taxaPagamento = $formaPagamento == 'boleto' ? 72.50 : 100.00;
    $taxaConversao = 50.00;

    // Consome a API para obter a taxa de câmbio
    $moedas = $moedaOrigem . '-' . $moedaDestino;
    $url = "https://economia.awesomeapi.com.br/json/last/$moedas";
    $json = file_get_contents($url);
    $data = json_decode($json, true);

    // Verifica se a resposta da API contém os dados esperados
    if ($data && isset($data["{$moedaOrigem}{$moedaDestino}"])) {
        $taxaMoedaDestino = (float)$data["{$moedaOrigem}{$moedaDestino}"]['bid'];

        if ($taxaMoedaDestino > 0) {
            $valorUtilizado = $valor - $taxaPagamento - $taxaConversao;
            $valorMoedaDestino = $valorUtilizado / $taxaMoedaDestino;

            echo "<h1>Resultado da Conversão</h1>";
            echo "<div class='result'><strong>Moeda de origem:</strong> $moedaOrigem</div>";
            echo "<div class='result'><strong>Moeda de destino:</strong> $moedaDestino</div>";
            echo "<div class='result'><strong>Valor para conversão:</strong> R$ " . number_format($valor, 2, ',', '.') . "</div>";
            echo "<div class='result'><strong>Forma de pagamento:</strong> " . ucfirst($formaPagamento) . "</div>";
            echo "<div class='result'><strong>Valor da Moeda de destino usada para conversão:</strong> $ " . number_format($taxaMoedaDestino, 2, ',', '.') . "</div>";
            echo "<div class='result'><strong>Valor comprado em Moeda de destino:</strong> $ " . number_format($valorMoedaDestino, 2, ',', '.') . "</div>";
            echo "<div class='result'><strong>Taxa de pagamento:</strong> R$ " . number_format($taxaPagamento, 2, ',', '.') . "</div>";
            echo "<div class='result'><strong>Taxa de conversão:</strong> R$ " . number_format($taxaConversao, 2, ',', '.') . "</div>";
            echo "<div class='result'><strong>Valor utilizado para conversão descontando as taxas:</strong> R$ " . number_format($valorUtilizado, 2, ',', '.') . "</div>";
        } else {
            echo "<div class='error'>Erro: Taxa de câmbio inválida.</div>";
        }
    } else {
        echo "<div class='error'>Erro: Não foi possível obter a taxa de câmbio. Verifique a combinação de moedas e tente novamente.</div>";
    }
}
?>
    </div>
</body>
</html>
