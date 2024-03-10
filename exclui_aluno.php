<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nomeAluno = $_POST["nome_aluno"];

    try {
        // Conecta ao banco de dados SQLite
        $pdo = new PDO('sqlite:cadastro_aluno.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepara a instrução SQL de exclusão
        $stmt = $pdo->prepare("DELETE FROM nomeAluno WHERE nomeAluno = :nomeAluno");

        // Binda os parâmetros
        $stmt->bindParam(':nomeAluno', $nomeAluno);

        // Executa a instrução SQL
        $stmt->execute();

        echo "Aluno excluído com sucesso!";
    } catch (PDOException $e) {
        die("Erro: " . $e->getMessage());
    }

    // Fecha a conexão
    $pdo = null;
}
?>
