<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    <title>Formulário de Relatos</title>
</head>
<body>
    <?php
    // Conexão com o banco de dados (seu arquivo de conexão)
    require 'db_connection.php';

    // Função para gerar o ID único do relato
    function generateUniqueId()
    {
        global $pdo; // Variável de conexão com o banco de dados

        // Consulta para obter um novo UUID
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

            // Verifica se a opção "Relato Anônimo" está marcada
            if (isset($_POST["anonimo"]) && $_POST["anonimo"] === "on") {
                // Se sim, define os campos "nome" e "email" como vazios
                $nome = "";
                $email = "";
            }

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
    p {
            margin: 10px;
            color:  #1d1d1d;
            text-align: justify;
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

    label {
        display: block;
        color: #1d1d1d;
        text-align: left;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #00acc1;
        border-radius: 5px;
        background-color: #fff;
        color: #1d1d1d;
    }

    .relato-container {
        display: none;
    }

    .relato-only {
        display: none;
    }

    button {
        padding: 10px 20px;
        margin-top: 10px;
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

        /* Estilização personalizada para a checkbox */
        input[type="checkbox"] {
        appearance: none; /* Remove a aparência padrão da checkbox */
        -webkit-appearance: none;
        -moz-appearance: none;
        display: inline-block;
        width: 20px;
        height: 20px;
        background-color: #fff;
        border: 2px solid #00acc1;
        border-radius: 5px;
        cursor: pointer;
        position: relative;
        }

        /* Estilo do checkmark (marcador da checkbox) */
        input[type="checkbox"]::before {
        content: "\2713"; /* Código Unicode para o símbolo de checkmark */
        font-size: 16px;
        color: #00acc1;
        position: absolute;
        top: -3px;
        left: 2px;
        opacity: 0; /* Inicialmente invisível */
        pointer-events: none; /* Impede que o checkmark seja clicável */
        }

        /* Estilo da checkbox personalizada quando está marcada */
        input[type="checkbox"]:checked::before {
        opacity: 1; /* Torna o checkmark visível quando a checkbox está marcada */
        }

</style>

    <div class="content-box">
        <h1>Formulário de Relatos</h1>
        <p>Esta é a página de formulário para a criação de um relato. Insira seus dados e seu relato, caso prefira optar por não se identificar, selecione a opção "anônimo" e preencha somente o campo "Relato".</p>
        <hr>
        <br>
        <label for="anonimo">Relato Anônimo:</label>
        <input type="checkbox" class="checkbox-custom" id="chkAnonimo" onclick="toggleRelatoFields();"><br>

        <form action="process_form.php" method="POST" id="form">
            <div id="nomeEmailFields">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome"><br>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email"><br>
            </div>

            <input type="hidden" name="relato_id" value="<?php echo uniqid(); ?>">

            <div id="relatoContainer" class="relato-container">
                <label class="relato-only" for="relato">Relato:</label>
                <textarea class="relato-only" name="relato" required></textarea><br>
            </div>

            <div class="button-container">
                <button type="submit">Enviar Relato</button>
                <button onclick="window.location.href = 'index.php';">Voltar</button>
            </div>
        </form>
    </div>

    <script>
        function toggleRelatoFields() {
            // Função para alternar entre exibir campos de nome/email ou apenas o campo de relato, dependendo da opção "Relato Anônimo"
            var nomeEmailFields = document.getElementById("nomeEmailFields");
            var relatoContainer = document.getElementById("relatoContainer");
            var relatoFields = document.querySelectorAll('.relato-only');
            var relatoLabel = document.querySelector('.relato-only[for="relato"]');
            var nomeInput = document.getElementById("nome");
            var emailInput = document.getElementById("email");
            var relatoIdField = document.getElementById("relato_id");

            if (document.getElementById("chkAnonimo").checked) {
                // Se o checkbox for marcado, esconder os campos "nome" e "email" e exibir o campo de relato
                nomeEmailFields.style.display = "none";
                relatoContainer.style.display = "block";
                relatoFields.forEach(element => {
                    element.style.display = "block";
                });
                relatoLabel.style.display = "block";

                // Preenche os campos "nome" e "email" com "anônimo"
                nomeInput.value = "anônimo";
                emailInput.value = "anonimo@anonimo";
            } else {
                // Se o checkbox não estiver marcado, exibir todos os campos
                nomeEmailFields.style.display = "block";
                relatoContainer.style.display = "block";
                relatoFields.forEach(element => {
                    element.style.display = "none";
                });
                relatoLabel.style.display = "block";
                document.querySelector('textarea[name="relato"]').style.display = "block";

                // Limpar os campos "nome" e "email"
                nomeInput.value = "";
                emailInput.value = "";
            }
        }

        // Gerar um ID único e atribuir ao campo oculto antes de enviar o formulário
        document.querySelector("form").addEventListener("submit", function (event) {
            const relatoIdField = document.getElementById("relato_id");
            const relatoId = generateUniqueId(); // Função que gera o ID único (você pode implementá-la)

            relatoIdField.value = relatoId; // Atribui o ID gerado ao campo oculto
        });

        // Chama a função toggleRelatoFields() no início para garantir que os campos corretos são exibidos inicialmente
        toggleRelatoFields();
    </script>

</body>
</html>
