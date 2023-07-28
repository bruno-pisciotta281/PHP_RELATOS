<?php
// process_form.php

// Conexão com o banco de dados (seu arquivo de conexão)
require 'db_connection.php';

// Função para gerar o ID único do relato
function generateUniqueId()
{
    // Gera o ID usando a função UUID()
    global $pdo; // Variável de conexão com o banco de dados
    $stmt = $pdo->query("SELECT UUID() AS id");
    $result = $stmt->fetch();
    return $result['id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o formulário foi submetido
    if (isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["relato"])) {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $relato = $_POST["relato"];
        
        // Gera o ID único usando a função generateUniqueId()
        $id = generateUniqueId();

        // Insere o relato no banco de dados
        $stmt = $pdo->prepare("INSERT INTO tabela_de_relatos (relato_id, nome, email, relato) VALUES (?, ?, ?, ?)");
        $stmt->execute([$id, $nome, $email, $relato]);

        // Redireciona para a página de sucesso com o ID gerado
        header("Location: sucesso.php?id=$id");
        exit();
    }
}
?>