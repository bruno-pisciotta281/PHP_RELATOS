<?php
// Inclua o arquivo de configuração
include_once 'config.php';

// Inicie a sessão (caso ainda não esteja iniciada)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado e se é o USUARIO_TRATATIVA
if (!isset($_SESSION["nivel_acesso"]) || $_SESSION["nivel_acesso"] !== "usuario_tratativa") {
    // Se não for um usuário de tratativa, redirecione para a página de login
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    <title>Consulta de Relato</title>
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
            margin: 0%;
        }

        .content-box {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            max-width: 600px;
            width: 80%;
            margin-top: 1%;
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

        /* Estilo para destacar as variáveis */
        .variable {
            color:#1d1d1d;
            font-weight: bold;
        }
        
        .semresposta{
            color: red;
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
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #00acc1;
            border-radius: 5px;
            background-color: #fff;
            color: #1d1d1d;
        }

        .relato{
            color:red;
            font-weight: bold; 
        }
        .respostaRelato{
            color:green;
            font-weight: bold; 
        }

        .dot {
            height: 14px;
            width: 14px;
            border-radius: 50%;
            margin-right: -5px;
            display: inline-block;
        }

        .dot-green {
            background-color: green;
        }

        .dot-red {
            background-color: red;
        }

        .dot-yellow {
            background-color: orange;
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

        footer p{
            text-align: center;
        }

        .red{
            color: red;
        }

    </style>
</head>
<body>
    <div class="content-box">
        <h1>Consulta de Relato</h1>
        <?php
        // Verifica se foi fornecido um ID de relato para consulta
        if (isset($_GET["relato_id"])) {
            // Inclua o arquivo de conexão
            require 'db_connection.php';

            try {
                // Prepara a consulta SQL para obter o relato com o ID fornecido
                $consultaStmt = $pdo->prepare("SELECT * FROM tabela_de_relatos WHERE relato_id = ?");
                $consultaStmt->execute([$_GET["relato_id"]]);

                // Verifica se o relato foi encontrado
                if ($consultaStmt->rowCount() > 0) {
                    $relato = $consultaStmt->fetch(PDO::FETCH_ASSOC);
                    $relatoId = $relato['relato_id'];
                    $nomeUsuario = $relato['nome'];
                    $emailUsuario = $relato['email'];
                    $relatoTexto = $relato['relato'];
                    $resposta = $relato['resposta'];

                    // Convertendo o timestamp para formato de data e hora legíveis
                    $dataCriacao = date("d/m/Y H:i", strtotime($relato['data_criacao']));

                    $statusRelato = isset($_POST["novo_status_$relatoId"]) ? $_POST["novo_status_$relatoId"] : $relato['status'];

                    echo "<hr>";
                    $dotClass = getStatusDotClass($statusRelato);
                    echo "<p></span><span class='variable'>ID do relato:</span> $relatoId</p>";
                    $statusRelato = isset($_POST["novo_status_$relatoId"]) ? $_POST["novo_status_$relatoId"] : $relato['status'];
                    echo "<p></span><span class='variable'>Status do relato: </span>$statusRelato <span class='$dotClass dot'></p>";
                    echo "<p><span class='variable'>Nome do usuário:</span> $nomeUsuario</p>";
                    echo "<p><span class='variable'>Email do usuário:</span> $emailUsuario</p>";
                    echo "<p><span class='variable'>Data e Hora do relato:</span> $dataCriacao</p>";
                    echo "<hr>";
                    echo "<p><span class='relato'>Relato:</span></p>";
                    echo "<p>$relatoTexto</p>";

                    // Exibir tratativas
                    $tratativasQuery = "SELECT * FROM tratativas WHERE relato_id = :relato_id";
                    $tratativasStmt = $pdo->prepare($tratativasQuery);
                    $tratativasStmt->bindParam(':relato_id', $relatoId);
                    $tratativasStmt->execute();

                    if ($tratativasStmt->rowCount() > 0) {
                        echo "<p><span class='respostaRelato'>Tratativas:</span></p>";
                        while ($tratativa = $tratativasStmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<p>{$tratativa['resposta']} - {$tratativa['data_tratativa']}</p>";
                        }
                    } else {
                        echo "<p class='red'>Nenhuma tratativa encontrada para este relato.</p>";
                    }
                } else {
                    echo "<p>Nenhum relato encontrado com o ID fornecido ou excluído pela equipe de tratativas.</p>";
                }
            } catch (PDOException $e) {
                // Em caso de erro, exibe uma mensagem de erro
                echo '<p>Erro ao consultar o banco de dados: ' . $e->getMessage() . '</p>';
            }
        } else {
            echo "<p>Nenhum ID de relato fornecido para consulta.</p>";
        }

        // Função para obter a classe da bolinha com base no status
        function getStatusDotClass($status) {
            $status = strtolower($status);  // Converta para minúsculas
            switch ($status) {
                case 'em aberto':
                    return 'dot-green';
                case 'em tratativa':
                    return 'dot-yellow';
                case 'fechado':
                    return 'dot-red';
                default:
                    return 'dot-yellow'; // Se o status não coincidir com nenhum dos anteriores
            }
        }
        ?>
        <button onclick="window.location.href = 'index.php';">Voltar para a Página Inicial</button>
        <footer>
            <br>
            <hr>
            <p><b>RelatosNVT©️</b> - Todos os direitos reservados.</p>
        </footer>
    </div>
</body>
</html>
