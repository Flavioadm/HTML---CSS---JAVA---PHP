<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // **Recupera os dados do formulário:**

    $serie = $_POST["serie"];
    $letra = strtoupper($_POST["letra"]); // Converte para maiúsculas
    $turno = $_POST["turno"];

    // **Conecta ao banco de dados SQLite:**

    try {
        $pdo = new PDO('sqlite:cadastro_aluno.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erro ao conectar ao banco de dados: " . $e->getMessage());
    }

    // **Prepara a instrução SQL de inserção:**

    try {
        $stmt = $pdo->prepare("INSERT INTO cadastro_turma (serie, letra, turno) VALUES (:serie, :letra, :turno)");
    } catch (PDOException $e) {
        die("Erro ao preparar a instrução SQL: " . $e->getMessage());
    }

    try {
        $stmt->bindParam(':serie', $serie);
        $stmt->bindParam(':letra', $letra);
        $stmt->bindParam(':turno', $turno);
     
    } catch (PDOException $e) {
        die("Erro ao bindar os parâmetros: " . $e->getMessage());
    }

    // **Executa a instrução SQL:**

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        die("Erro ao executar a instrução SQL: " . $e->getMessage());
    }

    // **Fecha a conexão:**

    $pdo = null;

    // **Redireciona para a página cadastrar_turma.html após o cadastro:**
    
    header("Location:Turma cadastrada com sucesso!");
    sleep(2);
    header("Location: cadastrar_turma.html");
    exit();
}
?>