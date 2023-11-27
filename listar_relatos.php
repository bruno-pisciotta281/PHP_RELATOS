<?php
// Inclua o arquivo de configuração
include_once 'config.php';

// Inicie a sessão (caso ainda não esteja iniciada)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado e se é o USUARIO_TRATATIVA
if (!isset($_SESSION["nivel_acesso"]) || $_SESSION["nivel_acesso"] !== "usuario_tratativa") {
    echo "Redirecionando para login.php";
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    <title>Listagem de Relatos</title>
</head>

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
            margin: 0px;
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
            height: 14px;
            width: 14px;
            border-radius: 50%;
            margin-right: -5px;
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

        .px{
            color: #00acc1;
            font-weight: bold;
        }

        footer p{
            text-align: center;
        }

        .filter{
            color: #00acc1;
            font-weight: bold;
            text-align: center;
        }

        textarea{
            font-family: 'Montserrat', sans-serif;
        }

        /* Style the filter container */
        /* Style the select input */
        .filter-container select,
        .filter-container input[type="date"] {
            
            font-family: 'Montserrat', sans-serif;
            border: 1px solid #00acc1;
            border-radius: 5px;
            background-color: #fff;
            color: #1d1d1d;
            width: 200px;
            height: 25px;
        }

        /* Style the submit button for filters */
        .filter-container button[type="submit"] {
            background-color: #00acc1;
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Hover effect for the submit button */
        .filter-container button[type="submit"]:hover {
            background-color: #1d1d1d;
        }

        /* Adjust margins for the filter elements */
        .filter-container select {
            margin-right: 10px;
        }

        /* Clear the default input styles for date input */
        .filter-container input[type="date"]::-webkit-inner-spin-button,
        .filter-container input[type="date"]::-webkit-clear-button,
        .filter-container input[type="date"]::-webkit-calendar-picker-indicator {
            color: #00acc1;
            -webkit-appearance: none;
        }

        .select{
            align-items: left;
        }

        .select select{
            margin-right: 1%;
            border-style: solid;
            border-color: #00acc1 !important;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
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

       

    </style>

<script>
    // Função para confirmar a exclusão de um relato com base no ID
    function confirmarExclusao(relatoId) {
        return confirm("Tem certeza que deseja excluir o relato com ID " + relatoId + "? Essa ação não poderá ser desfeita.");
    }
</script>
<body>
    <div class="content-box">
        <div class="button-container">
            <button onclick="window.location.href = 'index.php';">Página Inicial</button>
        </div>
        <h1>Lista de Relatos</h1>
        <p>Esta página contém todos os relatos já efetuados por usuários, aqui você pode enviar tratativas únicas quanto a cada relato ou editar uma tratativa já efetuada. Também é possível excluir um relato caso ele já tenha sido totalmente efetuado clicando no botão <span class="px">X</span>. As bolinhas antes do identificador de ID representam se o Relato já recebeu uma tratativa, se a bolinha for <span class="green">verde</span> já houve resposta para o relato, se não a cor da bolinha será <span class="red">vermelha</span> e ainda há necessidade de tratar o respectivo Relato.</p>

        <hr>
        <p class="filter">Filtros de Pesquisa</p>
        <div class="filter-container">
            <form action="listar_relatos.php" method="GET">
                <select class="filter-select" name="status">
                    <option value="">Todos</option>
                    <option value="respondidos">Respondidos</option>
                    <option value="nao_respondidos">Não Respondidos</option>
                </select>
                <input class="filter-input" type="date" name="data" placeholder="Filtrar por data">
                <button type="submit">Filtrar</button>
            </form>
        </div>    

        <?php
        // Inclua o arquivo de conexão
        require 'db_connection.php';

        $status = isset($_GET['status']) ? $_GET['status'] : '';
        $data = isset($_GET['data']) ? $_GET['data'] : '';

        $consultaQuery = "SELECT * FROM tabela_de_relatos";

        $status = isset($_GET['status']) ? $_GET['status'] : '';
        $data = isset($_GET['data']) ? $_GET['data'] : '';
        $username = isset($_GET['username']) ? $_GET['username'] : ''; // Captura o nome de usuário

        $consultaQuery = "SELECT * FROM tabela_de_relatos";

        $conditions = [];
        $parameters = [];

        if ($status == 'respondidos') {
            $conditions[] = "resposta IS NOT NULL";
        } elseif ($status == 'nao_respondidos') {
            $conditions[] = "resposta IS NULL";
        }

        if (!empty($data)) {
            $formattedDate = date("Y-m-d", strtotime($data)); // Formata a data no formato do banco de dados
            $conditions[] = "DATE(data_criacao) = '$formattedDate'";
        }

        if (!empty($conditions)) {
            $consultaQuery .= " WHERE " . implode(" AND ", $conditions);
        }

        $consultaQuery .= " ORDER BY data_criacao DESC";
        $consultaStmt = $pdo->prepare($consultaQuery);
        $consultaStmt->execute();

        
        foreach ($parameters as $key => $value) {
            if ($key == ':keyword_value') {
                $consultaStmt->bindValue($key, $value, PDO::PARAM_STR);
            } else {
                $consultaStmt->bindValue($key, $value);
            }
        }
        
        $consultaStmt->execute();

        
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

        function atualizarStatus($pdo, $relatoId, $novoStatus)
        {
            try {
                $stmt = $pdo->prepare("UPDATE tabela_de_relatos SET status = ? WHERE relato_id = ?");
                $stmt->execute([$novoStatus, $relatoId]);
            } catch (PDOException $e) {
                // Em caso de erro, exibe uma mensagem de erro
                echo 'Erro ao atualizar o status do relato: ' . $e->getMessage();
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

                // Verifica se a resposta não está vazia (indicando uma edição) ou não (indicando uma nova resposta)
                if (!empty($resposta)) {
                    // Atualiza a resposta
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
            $consultaStmt = $pdo->query($consultaQuery);

            function getStatusDotClass($status) {
                $status = strtolower($status);  // Converta para minúsculas
                switch ($status) {
                    case 'em aberto':
                        return 'dot-red';
                    case 'em tratativa':
                        return 'dot-yellow';
                    case 'fechado':
                    case 'fechado':
                        return 'dot-red';
                    case 'em_aberto':
                        return 'dot-green';
                    case 'fechado':  
                        return 'dot-red';
                    default:
                        return 'dot-yellow'; // Se o status não coincidir com nenhum dos anteriores
                }
            }

            // Verifica se existem relatos cadastrados
            if ($consultaStmt->rowCount() > 0) {
                // Exibe a lista de relatos
                while ($relato = $consultaStmt->fetch(PDO::FETCH_ASSOC)) {
                    $relatoId = $relato['relato_id'];
                    $nomeUsuario = $relato['nome'];
                    $emailUsuario = $relato['email'];
                    $relatoTexto = $relato['relato'];
                    $resposta = $relato['resposta'];

                    // Converte o timestamp para um formato de data e hora legíveis
                    $dataCriacao = date("d/m/Y H:i", strtotime($relato['data_criacao']));

                     // Exibe o estado do relato
                    if (isset($_POST["novo_status_$relatoId"])) {
                        $statusRelato = $_POST["novo_status_$relatoId"];
                    } else {
                        $statusRelato = $relato['status'];
                    }

                    var_dump($statusRelato);  // Adicione esta linha para depurar
                    $dotClass = getStatusDotClass($statusRelato);
                    var_dump($dotClass);  // Adicione esta linha também

                    echo "<hr>";
                    echo "<div style='position: relative;'>";
                    echo "<div class='relato-info'>";
                    echo "<span class='$dotClass dot'></span>";
                    echo "<p><span class='variable'>ID do relato:</span> $relatoId</p>";
                    echo "</div>";
                    echo "<p><span class='variable'>Status do relato:</span> $statusRelato</p>";
                    echo "<p><span class='variable'>Nome do usuário:</span> $nomeUsuario</p>";
                    echo "<p><span class='variable'>Email do usuário:</span> $emailUsuario</p>";
                    echo "<p><span class='variable'>Data e Hora do relato:</span> $dataCriacao</p>";

                    // Processamento do formulário
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["relato_id"]) && isset($_POST["novo_status_$relatoId"])) {
                        $relatoId = $_POST["relato_id"];
                        $novoStatus = $_POST["novo_status_$relatoId"];

                        // Atualiza o estado do relato no banco de dados
                        atualizarStatus($pdo, $relatoId, $novoStatus);
                        
                        // Atualiza a variável local para refletir a mudança
                        $statusRelato = $novoStatus;
                    }

                    // Verifica se o formulário foi submetido para atualizar o status
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["novo_status"])) {
                        $novoStatus = $_POST["novo_status"];
                        // Atualiza o estado do relato
                        atualizarStatus($pdo, $relatoId, $novoStatus);
                    }

                    echo "<div class = 'relatos'>";
                    echo "<p><span class='relato'>Relato:</span></p>";
                    echo "<p>$relatoTexto</p>";
                    // Botão para excluir o relato com alerta de confirmação
                    echo "<form action=\"\" method=\"POST\" onsubmit=\"return confirmarExclusao('$relatoId');\">";
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
                        echo "</div>";
                        echo "<form action=\"\" method=\"POST\">";
                        echo "<input type=\"hidden\" name=\"relato_id\" value=\"$relatoId\">";
                        echo "<textarea name=\"resposta\" placeholder=\"Insira a resposta ou faça a edição aqui\" required></textarea>";
                        echo "<button type=\"submit\" name=\"editar\">Editar Resposta</button>";
                        echo "</form>";
                    }

                    echo "<br>";
                        // Adiciona um menu suspenso para selecionar o estado
                        echo "<div class ='select'>";
                        echo "<form action=\"\" method=\"POST\">";
                        echo "<input type=\"hidden\" name=\"relato_id\" value=\"$relatoId\">";
                        echo "<select name=\"novo_status_$relatoId\">";
                        echo "<option value=\"em_aberto\" " . ($statusRelato == 'Em Aberto' ? 'selected' : '') . ">Em Aberto</option>";
                        echo "<option value=\"em_tratativa\" " . ($statusRelato == 'Em Tratativa' ? 'selected' : '') . ">Em Tratativa</option>";
                        echo "<option value=\"fechado\" " . ($statusRelato == 'Fechado' ? 'selected' : '') . ">Fechado</option>";
                        echo "</select>";
                        echo "<button type=\"submit\">Atualizar Status</button>";
                        echo "</form>";
                        echo "</div>";                       
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
        <footer>
            <br>
            <p><b>RelatosNVT©️</b> - Todos os direitos reservados.</p>
        </footer>
    </div>
</body>
</html>