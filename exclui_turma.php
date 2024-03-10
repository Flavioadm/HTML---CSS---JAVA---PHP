<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nomeTurma = $_POST["nome_turma"];

    try {
        // Conecta ao banco de dados SQLite
        $pdo = new PDO('sqlite:cadastro_aluno.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepara a instrução SQL de exclusão
        $stmt = $pdo->prepare("DELETE FROM cadastroTurma WHERE turma = :nomeTurma");

        // Binda os parâmetros
        $stmt->bindParam(':nomeTurma', $nomeTurma);

        // Executa a instrução SQL
        $stmt->execute();

        echo "Turma excluída com sucesso!";
    } catch (PDOException $e) {
        die("Erro: " . $e->getMessage());
    }

    // Fecha a conexão
    $pdo = null;
}
?>