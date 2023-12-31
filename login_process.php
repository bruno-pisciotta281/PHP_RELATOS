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

    // Verifica se a opção "Lembrar-me" foi marcada
    if (isset($_POST['lembrar'])) {
        // Armazena as credenciais em cookies
        setcookie('lembrar_email', $email, time() + (30 * 24 * 3600), '/'); // válido por 30 dias
        setcookie('lembrar_senha', $senha, time() + (30 * 24 * 3600), '/'); // válido por 30 dias
    } else {
        // Se "Lembrar-me" não estiver marcada, remove os cookies
        setcookie('lembrar_email', '', time() - 3600, '/');
        setcookie('lembrar_senha', '', time() - 3600, '/');
    }

    // Redireciona para a página index.php
    header("Location: listar_relatos.php");
    exit();
}

} else {
    // Caso a requisição não seja POST, redireciona de volta para a página de login
    header("Location: login.php");
    exit();
}
?>
