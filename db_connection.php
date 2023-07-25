<?php
// Credenciais do banco de dados local do XAMPP
$host = 'localhost';
$dbname = 'relatos'; // Substitua pelo nome do seu banco de dados
$username = 'root'; // Substitua pelo nome de usuário do seu banco de dados
$password = ''; // Substitua pela senha do seu banco de dados

try {
    // Estabelece a conexão com o banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Define o modo de erro para exceções (Exceptions)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Em caso de erro, exibe uma mensagem de erro
    echo 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
    exit();
}
?>
