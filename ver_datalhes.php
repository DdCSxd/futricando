<?php
// Conectar ao banco de dados
$host = 'localhost';
$dbname = 'login_system';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o ID foi passado corretamente
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Buscar informações detalhadas do paraquedas
    $sql = "SELECT * FROM inspecao_inicial WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Inspeção</title>
    <!-- Referenciando o arquivo CSS externo -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Detalhes da Inspeção do Paraquedas</h1>

        <div class="info">
            <p><strong>Tipo de PQD:</strong> <?php echo $row['tipo_pqd']; ?></p>
            <p><strong>Número do Velame:</strong> <?php echo $row['numero_velame']; ?></p>
            <p><strong>Número do Invólucro:</strong> <?php echo $row['numero_involucro']; ?></p>
            <p><strong>Data de Fabricação:</strong> <?php echo $row['data_fabricacao']; ?></p>
            <p><strong>Inspecionado por:</strong> <?php echo $row['inspecionado_por']; ?></p>
            <p><strong>Data de Inspeção:</strong> <?php echo $row['data_inspecao']; ?></p>
            <p><strong>Observações:</strong> <?php echo $row['observacoes']; ?></p>
        </div>

        <div class="details">
            <div class="section-title">Informações de Remendo</div>
            <p class="<?php echo $row['remendo'] === 'sim' ? 'status' : 'no-status'; ?>">
                Remendo: <?php echo $row['remendo'] === 'sim' ? 'Sim' : 'Não'; ?>
            </p>
            <?php if ($row['remendo'] === 'sim'): ?>
                <p><strong>Painel do Remendo:</strong> <?php echo $row['remendo_painel']; ?></p>
                <p><strong>Seção do Remendo:</strong> <?php echo $row['remendo_secao']; ?></p>
            <?php endif; ?>

            <div class="section-title">Informações de Substituição</div>
            <p class="<?php echo $row['substituicao'] === 'sim' ? 'status' : 'no-status'; ?>">
                Substituição: <?php echo $row['substituicao'] === 'sim' ? 'Sim' : 'Não'; ?>
            </p>
            <?php if ($row['substituicao'] === 'sim'): ?>
                <p><strong>Painel da Substituição:</strong> <?php echo $row['substituicao_painel']; ?></p>
                <p><strong>Seção da Substituição:</strong> <?php echo $row['substituicao_secao']; ?></p>
            <?php endif; ?>

            <div class="section-title">Informações de Recostura</div>
            <p class="<?php echo $row['recostura'] === 'sim' ? 'status' : 'no-status'; ?>">
                Recostura: <?php echo $row['recostura'] === 'sim' ? 'Sim' : 'Não'; ?>
            </p>
            <?php if ($row['recostura'] === 'sim'): ?>
                <p><strong>Painel da Recostura:</strong> <?php echo $row['recostura_painel']; ?></p>
                <p><strong>Seção da Recostura:</strong> <?php echo $row['recostura_secao']; ?></p>
            <?php endif; ?>

            <div class="section-title">Informações de Troca de Linha</div>
            <p class="<?php echo $row['troca_linha'] === 'sim' ? 'status' : 'no-status'; ?>">
                Troca de Linha: <?php echo $row['troca_linha'] === 'sim' ? 'Sim' : 'Não'; ?>
            </p>
            <?php if ($row['troca_linha'] === 'sim'): ?>
                <p><strong>Número da Linha Trocada:</strong> <?php echo $row['troca_linha_numero']; ?></p>
            <?php endif; ?>
        </div>

        <a href="index.php" class="button">Voltar</a>
    </div>
</body>
</html>
<?php
    } else {
        echo "Nenhum detalhe encontrado para esse paraquedas.";
    }
} else {
    echo "ID não fornecido.";
}

$conn->close();
?>
