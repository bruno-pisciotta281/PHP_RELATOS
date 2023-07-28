<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    <title>Enviado com Sucesso!</title>
</head>
<body>
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
            height: 100vh;
            margin: 0;
        }

        .content-box {
            background-color: #fff;
            border-radius: 10px;
            padding: 50px;
            max-width: 600px;
            width: 80%;
        }

        h1 {
            color: #00acc1;
        }

        p {
            margin: 10px;
            color: #1d1d1d; /* Defina a cor do texto para #1d1d1d para legibilidade */
        }

        .button-container {
            margin-top: 20px;
        }

        .button {
            font-family: 'Montserrat', sans-serif;
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            background-color: #00acc1;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }

        .button:hover {
            background-color: #1d1d1d;
            color: #00acc1;
            transition: background-color 0.3s, color 0.3s;
        }
    </style>

    <div class="content-box">
        <?php
        // sucesso.php

        // Verifica se o ID do relato foi enviado através da URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            echo "<h1>Relato Enviado com Sucesso</h1>";
            echo "<p>Obrigado por nos informar, nossa equipe fará uma análise e retornará em breve com uma tratativa quanto ao seu Relato!</p>";
            echo "<hr>"; 
            echo "<br>";
            echo "<p>Não se esqueça de guardar o seu ID para consultar futuras tratativas</p>";
            echo "<p>ID do Relato: <b>$id</b></p>";
            echo "<button class='button' onclick='copyToClipboard(\"$id\")'>Copiar ID</button>";
        } else {
            echo "<h1>ID do relato não disponível</h1>";
        }
        ?>
        <!-- Botão para retornar à página "index.php" -->
        <div class="button-container">
            <button class="button" onclick="window.location.href = 'index.php';">Voltar para a Página Inicial</button>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            // Cria um elemento temporário para realizar a cópia
            const tempInput = document.createElement("input");
            tempInput.value = text;
            document.body.appendChild(tempInput);

            // Seleciona o texto dentro do elemento
            tempInput.select();

            // Copia o texto para a área de transferência
            document.execCommand("copy");

            // Remove o elemento temporário
            document.body.removeChild(tempInput);

            // Mostra um alerta ou mensagem para o usuário
            alert("ID copiado para a área de transferência: " + text);
        }
    </script>
</body>
</html>
