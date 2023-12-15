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

        footer p{
            text-align: center;
        }

        /* Estilo do botão de logout */
        button.voltar-button {
            position: absolute;
            top: 1px;
            left: 1px;
            background-color: #00acc1;
        }

        /* Efeito de hover do botão de logout */
        button.voltar-button:hover{
            background-color: #00acc1;
            color: white;
            transition: background-color 0.3s, color 0.3s;
        }

    </style>
</head>
<body>
    <div class="content-box">
        <h1>Bem Vindo!</h1>
        <hr>
        <p>Olá, para você que é responsável pela tratativas dos relatos efetue seu login!</p>
        
        <?php
            echo '<button class="voltar-button" onclick="window.location.href = \'index.php\';">Voltar</button>';
            // Verifica se a URL contém o parâmetro "error" com valor igual a 1
            if (isset($_GET["error"]) && $_GET["error"] == 1) {
                echo '<p class="error-message">E-mail ou senha incorretos. Por favor, tente novamente.</p>';
            }
        ?>

        <form action="login_process.php" method="POST">
            <label for="email">Email:</label>
            <input type="text" name="email" value="<?php echo isset($_COOKIE['lembrar_email']) ? $_COOKIE['lembrar_email'] : ''; ?>" required>
            <br>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" value="<?php echo isset($_COOKIE['lembrar_senha']) ? $_COOKIE['lembrar_senha'] : ''; ?>" required>
            <br>
            <p style="text-align:center;">Lembrar Credenciais?</p>
            <input type="checkbox" name="lembrar" <?php echo isset($_COOKIE['lembrar_email']) ? 'checked' : ''; ?>>
            <br>
            <button type="submit">Entrar</button>
        </form>
        <hr>
        <p class="final">Caso não possua um login tratativa entre em contato com seu supervisor!</p>
    </div>
</body>
</html>
