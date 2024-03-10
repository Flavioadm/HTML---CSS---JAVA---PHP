<?php

try {
    // Conectar ao banco de dados SQLite
    $pdo = new PDO('sqlite:cadastro_aluno.sqlite');
    
    // Definir o modo de erro para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Desabilitar a verificação de chave estrangeira temporariamente
    $pdo->exec('PRAGMA foreign_keys=off;');

    // Criar tabela nome_aluno
    $pdo->exec('
        CREATE TABLE IF NOT EXISTS nome_aluno (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nomeAluno TEXT NOT NULL,
            dataNasc DATE NOT NULL,
            cadastro_turma TEXT NOT NULL
        )
    ');

    // Criar tabela cadastro_turma
    $pdo->exec('
        CREATE TABLE IF NOT EXISTS cadastro_turma (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            serie INTEGER NOT NULL,
            letra TEXT NOT NULL,
            turno TEXT NOT NULL
        )
    ');

    // Criar tabela periodo
    $pdo->exec('
        CREATE TABLE IF NOT EXISTS periodo (
            id INTEGER PRIMARY KEY,
            ano INTEGER NOT NULL,
            id_nome_aluno INTEGER NOT NULL,
            id_cadastro_turma INTEGER NOT NULL,
            FOREIGN KEY (id_nome_aluno) REFERENCES nome_aluno (id) ON DELETE RESTRICT ON UPDATE NO ACTION,
            FOREIGN KEY (id_cadastro_turma) REFERENCES cadastro_turma (id) ON DELETE RESTRICT ON UPDATE NO ACTION
        )
    ');

    // Habilitar verificações de chave estrangeira novamente
    $pdo->exec('PRAGMA foreign_keys=on;');

    echo "Tabelas criadas com sucesso!";
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}

// Fechar a conexão
$pdo = null;
?>
