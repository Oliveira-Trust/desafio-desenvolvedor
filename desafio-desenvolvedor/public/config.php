<?php
session_start();
if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taxaAplicada = $_POST['taxa'];
    file_put_contents('taxa_configurada.txt', $taxaAplicada);
    echo 'Taxa configurada com sucesso';
}

$taxaConfigurada = file_exists('taxa_configurada.txt') ? file_get_contents('taxa_configurada.txt') : '';
?>
<form method="post" action="">
    <label for="taxa">Taxa Aplicada:</label>
    <input type="text" id="taxa" name="taxa" value="<?php echo htmlspecialchars($taxaConfigurada); ?>" required>
    <button type="submit">Salvar</button>
</form>
