<?php
// Definir as credenciais de acesso como constantes
define('USUARIO_COMUM_EMAIL', 'relato@nvt.com');
define('USUARIO_COMUM_SENHA', 'relato123');

define('USUARIO_TRATATIVA_EMAIL', 'tratativa@nvt.com');
define('USUARIO_TRATATIVA_SENHA', 'tratativa123');

include_once 'config.php';  

// Função para verificar as credenciais de login
function verificarCredenciais($email, $senha)
{
    // Verificar as credenciais do usuário comum
    if ($email === USUARIO_COMUM_EMAIL && $senha === USUARIO_COMUM_SENHA) {
        return array("usuario_comum", 1); // Neste exemplo, o ID do usuário comum é 1
    }

    // Verificar as credenciais do usuário de tratativa
    if ($email === USUARIO_TRATATIVA_EMAIL && $senha === USUARIO_TRATATIVA_SENHA) {
        return array("usuario_tratativa", 2); // Neste exemplo, o ID do usuário de tratativa é 2
    }

    // Caso as credenciais estejam incorretas
    return false;
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtém as credenciais do formulário de login
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Verifica as credenciais
    $credenciais = verificarCredenciais($email, $senha);

    // Se as credenciais estiverem corretas, redireciona para a página index.php
    if ($credenciais) {
        // Inicia a sessão (caso ainda não esteja iniciada)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Define o nível de acesso do usuário na sessão
        $_SESSION["nivel_acesso"] = $credenciais[0];

        // Define o ID do usuário na sessão
        $_SESSION["user_id"] = $credenciais[1];

        // Redireciona para a página index.php
        header("Location: index.php");
        exit();
    } else {
        // Caso as credenciais estejam incorretas, redireciona de volta para a página de login com uma mensagem de erro
        header("Location: login.php?error=1");
        exit();
    }
} else {
    // Caso a requisição não seja POST, redireciona de volta para a página de login
    header("Location: login.php");
    exit();
}
?>
