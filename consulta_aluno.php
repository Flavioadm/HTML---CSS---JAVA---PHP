<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nomeAluno = $_POST["nome_aluno"];

    try {
        // Conecta ao banco de dados SQLite
        $pdo = new PDO('sqlite:cadastro_aluno.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM nome_aluno WHERE nomeAluno LIKE :nome_aluno");

        $nomeAluno = "%$nome_aluno%";
        $stmt->bindParam(':nome_aluno', $nomeAluno);

        // Executa a instrução SQL
        $stmt->execute();

        // Obtém os resultados da consulta
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Resultado da Consulta de Alunos</title>
    <link rel="stylesheet" href="seu-estilo.css">
</head>
<body>
    <h2>Resultados da Consulta</h2>

    <?php if (isset($resultados) && count($resultados) > 0): ?>
        <ul>
            <?php foreach ($resultados as $aluno): ?>
                <li>Nome: <?php echo $aluno['nome_aluno']; ?>, Data de Nascimento: <?php echo $aluno['dataNasc']; ?>, Turma: <?php echo $aluno['turma']; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Nenhum aluno encontrado.</p>
    <?php endif; ?>
</body>
</html>
