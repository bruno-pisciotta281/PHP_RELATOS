<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    <title>Login - Sistema de Relatos</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #1d1d1d;
            color: #fff;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 96vh;
            margin: 0;
        }

        .content-box {
            position: relative;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            max-width: 500px;
            width: 80%;
        }

        h1 {
            color: #00acc1;
            margin-bottom: 20px;
        }

        label {
            color: #00acc1;
            margin: 5px;
        }

        input[type="text"],
        input[type="password"] {
            padding: 8px;
            margin: 5px;
            border: 1px solid #00acc1;
            border-radius: 5px;
            background-color: #fff;
            color: #1d1d1d;
        }

        button {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            background-color: #00acc1;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            font-family: 'Montserrat', sans-serif;
        }

        button:hover {
            background-color: #1d1d1d;
            color: #00acc1;
            transition: background-color 0.3s, color 0.3s;
        }

        .error-message {
            color: red;
            margin: 10px;
        }

        p {
            margin: 10px;
            color:  #1d1d1d;
            text-align: justify;
        }

        .final{
            margin: 10px;
            color:  #1d1d1d;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="content-box">
        <h1>Bem Vindo!</h1>
        <hr>
        <p>Olá, este é o sistema de Relatos da Novo TempoRH. Para acessar a plataforma e iniciar um <b>Relato</b> efetue login com as credênciais abaixo: <br><br>E-mail: <b>relato@nvt.com</b> <br> Senha: <b>relato123</b> <br><br></p>
        
        <?php
            // login.php

            include_once 'config.php';

            // Iniciar a sessão (caso ainda não esteja iniciada)
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Verifica se o usuário está logado
            if (isset($_SESSION["nivel_acesso"])) {
                // Se o usuário já estiver logado, redireciona para a página de index
                header("Location: index.php");
                exit();
            }

            // Verifica se o usuário está logado e se é o USUARIO_TRATATIVA
            if (isset($_SESSION["nivel_acesso"]) && $_SESSION["nivel_acesso"] === "usuario_tratativa") {
                echo '<div style="padding: 5px 15px; margin: 1px; border: none; border-radius: 5px; background-color: #00acc1; color: #fff; font-weight: bold; cursor: pointer;" onclick="window.location.href = \'listagem_relatos.php\';">Lista de Relatos</div>';
            }

                // Verifica se a URL contém o parâmetro "error" com valor igual a 1
            if (isset($_GET["error"]) && $_GET["error"] == 1) {
                echo '<p class="error-message">E-mail ou senha incorretos. Por favor, tente novamente.</p>';
            }
        ?>

        <form action="login_process.php" method="POST">
            <label for="email">Email:</label>
            <input type="text" name="email" required>
            <br>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" required>
            <br>
            <button type="submit">Entrar</button>
        </form>
        <hr>
        <p class="final">Caso deseje efetuar tratativas, entre em contato com seu gestor e obtenha o acesso!</p>
    </div>
</body>
</html>
