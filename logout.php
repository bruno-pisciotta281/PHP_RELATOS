<?php
// logout.php

// Iniciar a sessão (caso ainda não esteja iniciada)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Encerrar a sessão (limpar todas as variáveis de sessão)
session_unset();

// Destruir a sessão
session_destroy();

// Redirecionar o usuário para a página de login (ou qualquer outra página desejada após o logout)
header("Location: login.php");
exit();
?>
