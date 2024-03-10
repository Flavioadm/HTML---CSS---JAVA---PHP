<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar os dados do formulário
    $nome = $_POST["nome"];
    $turma = $_POST["turma"];
    $dataNascimento = $_POST["data_nascimento"];

    try {
        // Conectar ao banco de dados SQLite
        $pdo = new PDO('sqlite:cadastro_aluno.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Inserir dados na tabela nomeAluno
        $stmt = $pdo->prepare("INSERT INTO nomeAluno (nomeAluno, turma, dataNasc) VALUES (:nome, :turma, :dataNascimento)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':turma', $turma);
        $stmt->bindParam(':dataNascimento', $dataNascimento);
        $stmt->execute();

        echo "Dados inseridos com sucesso!";
    } catch (PDOException $e) {
        die("Erro: " . $e->getMessage());
    }

    // Fechar a conexão
    $pdo = null;
}
?>
