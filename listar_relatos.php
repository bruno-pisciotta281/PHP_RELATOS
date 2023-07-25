<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    <title>Listagem de Relatos</title>
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
            margin-top: 1%;
        }

        .content-box {
            position: relative;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            max-width: 600px;
            width: 80%;
            overflow-y: auto;
        }

        h1 {
            color: #00acc1;
        }

        p {
            margin: 10px;
            color: #1d1d1d;
            text-align: justify;
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

        textarea {
            width: 80%;
            padding: 5px;
            margin: 10px 0;
            border: 1px solid #00acc1;
            border-radius: 5px;
            background-color: #fff;
            color: #1d1d1d;
        }

        .variable {
            color: #1d1d1d;
            font-weight: bold;
        }

        .button-container {
            display: flex;
            justify-content: flex-start;
            margin-top: 10px;
        }

        .button-container button {
            background-color: #00acc1;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
        }

        .button-container button:hover {
            background-color: #1d1d1d;
            color: #00acc1;
        }

        button[type="submit"] {
            transition: background-color 0.3s, color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #1d1d1d;
            color: #00acc1;
        }

        .dot {
            height: 12px;
            width: 12px;
            border-radius: 50%;
            margin-right: 6px;
        }

        .dot-green {
            background-color: green;
        }

        .dot-red {
            background-color: red;
        }

        /* Style the scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #00acc1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #1d1d1d;
        }

        ::-webkit-scrollbar-track {
            background-color: #fff;
            border-radius: 10px;
        }

        /* Style the "X" button for relato deletion */
        .delete-button {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 18px;
            background-color: transparent;
            color: #00acc1;
            cursor: pointer;
            border: none;
            width: 20px;
            height: 20px;
            line-height: 20px;
            text-align: center;
        }

        .delete-button:hover {
            background-color: transparent !important;
            color: red !important;
        }

        /* Place the dots before the ID of each relato */
        .relato-info {
            display: flex;
            align-items: center;
        }

        .relato{
            color:red;
            font-weight: bold; 
        }
        .respostaRelato{
            color:green;
            font-weight: bold; 
        }
    </style>
</head>
<body>
    <div class="content-box">
        <div class="button-container">
            <button onclick="window.location.href = 'index.php';">Voltar para Página Inicial</button>
        </div>
        <h1>Lista de Relatos</h1>
        <?php
        // Inclua o arquivo de conexão
        require 'db_connection.php';

        // Função para atualizar a resposta do relato
        function atualizarResposta($pdo, $relatoId, $resposta)
        {
            try {
                $stmt = $pdo->prepare("UPDATE tabela_de_relatos SET resposta = ? WHERE relato_id = ?");
                $stmt->execute([$resposta, $relatoId]);
            } catch (PDOException $e) {
                // Em caso de erro, exibe uma mensagem de erro
                echo 'Erro ao atualizar a resposta do relato: ' . $e->getMessage();
            }
        }

        // Função para excluir o relato
        function excluirRelato($pdo, $relatoId)
        {
            try {
                $stmt = $pdo->prepare("DELETE FROM tabela_de_relatos WHERE relato_id = ?");
                $stmt->execute([$relatoId]);
            } catch (PDOException $e) {
                // Em caso de erro, exibe uma mensagem de erro
                echo 'Erro ao excluir o relato: ' . $e->getMessage();
            }
        }

        try {
            // Verifica se o formulário foi submetido para atualizar a resposta
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["relato_id"]) && isset($_POST["resposta"])) {
                $relatoId = $_POST["relato_id"];
                $resposta = $_POST["resposta"];

                // Check if the response is empty (indicating an edit) or not (indicating a new response)
                if (!empty($resposta)) {
                    // Update the response
                    atualizarResposta($pdo, $relatoId, $resposta);
                }
            }

            // Verifica se o formulário foi submetido para excluir o relato
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["relato_id"]) && isset($_POST["excluir"])) {
                $relatoId = $_POST["relato_id"];

                // Exclui o relato da tabela
                excluirRelato($pdo, $relatoId);
            }

            // Prepara a consulta SQL para obter todos os relatos cadastrados, ordenados pela data de criação
            $consultaQuery = "SELECT * FROM tabela_de_relatos ORDER BY data_criacao DESC";
            $consultaStmt = $pdo->query($consultaQuery);

            // Verifica se existem relatos cadastrados
            if ($consultaStmt->rowCount() > 0) {
                // Exibe a lista de relatos
                while ($relato = $consultaStmt->fetch(PDO::FETCH_ASSOC)) {
                    $relatoId = $relato['relato_id'];
                    $nomeUsuario = $relato['nome'];
                    $emailUsuario = $relato['email'];
                    $relatoTexto = $relato['relato'];
                    $resposta = $relato['resposta'];

                    // Add dot based on response status
                    $dotClass = empty($resposta) ? 'dot-red' : 'dot-green';

                    echo "<hr>";
                    echo "<div style='position: relative;'>";
                    echo "<div class='relato-info'>";
                    echo "<span class='$dotClass dot'></span>";
                    echo "<p><span class='variable'>ID do relato:</span> $relatoId</p>";
                    echo "</div>";
                    echo "<p><span class='variable'>Nome do usuário:</span> $nomeUsuario</p>";
                    echo "<p><span class='variable'>Email do usuário:</span> $emailUsuario</p>";
                    echo "<p><span class='relato'>Relato:</span></p>";
                    echo "<p>$relatoTexto</p>";

                    // Add the "X" button for relato deletion
                    echo "<form action=\"\" method=\"POST\">";
                    echo "<input type=\"hidden\" name=\"relato_id\" value=\"$relatoId\">";
                    echo "<button type=\"submit\" class=\"delete-button\" name=\"excluir\" title=\"Excluir relato\">X</button>";
                    echo "</form>"; 

                    // Exibe o campo de resposta apenas se o relato ainda não tiver sido respondido
                    if (empty($resposta)) {
                        echo "<form action=\"\" method=\"POST\">";
                        echo "<input type=\"hidden\" name=\"relato_id\" value=\"$relatoId\">";
                        echo "<textarea name=\"resposta\" placeholder=\"Insira a resposta ou faça a edição aqui\" required></textarea>";
                        echo "<button type=\"submit\">Enviar Resposta</button>";
                        echo "</form>";
                    } else {
                        echo "<p><span class='respostaRelato'>Resposta do relato:</span></p>";
                        echo "<p>$resposta</p>";
                        echo "<form action=\"\" method=\"POST\">";
                        echo "<input type=\"hidden\" name=\"relato_id\" value=\"$relatoId\">";
                        echo "<textarea name=\"resposta\" placeholder=\"Insira a resposta ou faça a edição aqui\" required></textarea>";
                        echo "<button type=\"submit\" name=\"editar\">Editar Resposta</button>";
                        echo "</form>";
                    }

                    echo "</div>";
                    echo "<hr>";
                }
            } else {
                echo "<p>Nenhum relato cadastrado.</p>";
            }
        } catch (PDOException $e) {
            // Em caso de erro, exibe uma mensagem de erro
            echo 'Erro ao consultar o banco de dados: ' . $e->getMessage();
        }
        ?>
    </div>
</body>
</html>
