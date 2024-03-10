<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nomeTurma = $_POST["nome_turma"];

    try {
        // Conecta ao banco de dados SQLite
        $pdo = new PDO('sqlite:cadastro_aluno.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepara a instrução SQL de consulta
        $stmt = $pdo->prepare("SELECT * FROM cadastroTurma WHERE turma = :nomeTurma");

        // Binda os parâmetros
        $stmt->bindParam(':nomeTurma', $nomeTurma);

        // Executa a instrução SQL
        $stmt->execute();

        // Obtém o resultado da consulta
        $turma = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erro: " . $e->getMessage());
    }

    // Fecha a conexão
    $pdo = null;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da Consulta de Turma</title>
    <link rel="stylesheet" href="seu-estilo.css">
</head>
<body>
    <h2>Resultado da Consulta</h2>

    <?php if (isset($turma) && $turma): ?>
        <ul>
            <li>Série: <?php echo $turma['serie']; ?></li>
            <li>Turma: <?php echo $turma['turma']; ?></li>
            <li>Turno: <?php echo $turma['turno']; ?></li>
        </ul>
    <?php else: ?>
        <p>Nenhuma turma encontrada.</p>
    <?php endif; ?>
</body>
</html>