<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    <title>NVT - RELATOS</title>  
    <style>
        /* Estilo do corpo da página */
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
        }

        /* Estilo do contêiner principal */
        .content-box {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            max-width: 600px;
            max-height: 100vh;
            width: 80%;
            position: relative;
            overflow-y: auto;
        }

        /* Estilo do título principal */
        h1 {
            color: #00acc1;
        }

        /* Estilo dos subtítulos */
        h2 {
            color: #00acc1;
            margin: 0;
            text-align: justify;
        }

        /* Estilo do parágrafo de texto */
        p {
            margin: 5px;
            color:  #1d1d1d;
            text-align: justify;
            font-size: 14px;
        }

        /* Estilo do campo de entrada de texto */
        input[type="text"] {
            padding: 10px;
            margin: 10px;
            border: 1px solid #00acc1;
            border-radius: 5px;
            background-color: #fff;
            color: #1d1d1d;
        }

        /* Estilo do botão */
        button {
            height: 28px;
            padding: 3px 13px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            background-color: #00acc1;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            font-family: 'Montserrat', sans-serif;
        }

        /* Efeito de hover do botão */
        button:hover {
            background-color: #1d1d1d;
            color: #00acc1;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Estilo do campo de entrada de texto */
        input[type="text"] {
            font-family: 'Montserrat', sans-serif;
            text-align: center;
        }

        /* Estilo do botão na content-box */
        button.button-relatos {
            position: absolute;
            top: 9px;
            right: 10px;
            color: white;
            background-color: #00acc1;
        }

        /* Estilo do botão de logout */
        button.logout-button {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #00acc1;
        }

        /* Efeito de hover do botão de logout */
        button.logout-button:hover{
            background-color: red;
            color: white;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Estilo do parágrafo secundário */
        .p2 {
            text-align: center;
            font-size: 13px;
        }

        /* Estilo da barra de rolagem */
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
            font-size: 12px;
            margin: 0px !important;
            text-align: center;
        }

    </style>
</head>
<body>  
    <div class="content-box">
    <?php
    // index.php
    // Incluir o arquivo de configuração
    include_once 'config.php';
    echo '<button class="button-relatos" onclick="window.location.href = \'login_process.php\';"> RELATOS</button>';
    echo '<button class="logout-button" onclick="window.location.href = \'logout.php\';">SAIR</button>';
    ?>
        <!-- Título principal -->
        <h1>NVT - RELATOS</h1>
        <hr>
        <!-- Subtítulo -->
        <h2>Confidencialidade e Anonimato</h2>
        <!-- Parágrafo 1 -->
        <p>Este é o canal de Relatos da Novo TempoRH. Ele uma ferramenta confidencial para que os funcionários possam informar ou buscar apoio sobre questões éticas e de comportamento relacionado a possíveis violações das políticas do Grupo NVT ou das Leis e Regulamentos.</p>
        <!-- Parágrafo 2 -->
        <p>O Grupo NVT não tolera retaliações com quem relata uma preocupação de boa fé.</p>
        <!-- Parágrafo 3 -->
        <p>Todos os relatos serão tratados de forma confidencial e anônima, e o solicitante determina na abertura do relato se deseja se identificar ou não, de qualquer forma manteremos o anonimato das tratativas.</p>
        <!-- Parágrafo 4 -->
        <p>Para adicionar um relato, clique no botão abaixo:</p>
        <!-- Botão para adicionar relato -->
        <button onclick="window.location.href = 'form.php';"> Adicionar Relato </button>
        <form action="consulta.php" method="GET">
        <hr>
        <!-- Parágrafo secundário -->
        <p class="p2">Caso já tenha efetuado um relato faça sua consulta por meio de seu respectivo <b>ID</b> no campo abaixo:</p>
        <!-- Input para inserção do ID -->
        <input type="text" name="relato_id" required id="relato_id" value="Insira aqui o ID do Relato" onfocus="limparTextoInicial()">  
            <br>
            <!-- Botão para consultar o relato a partir do ID inserido -->
            <div class="button-container">
                <button type="submit">Consultar Relato</button>
            </div>
        </form>
        <footer>
            <hr>
            <br>
            <p><b>RelatosNVT©️</b> - Todos os direitos reservados.</p>
        </footer>
    </div>

        <script>
            const meuInput = document.getElementById('relato_id');

            // Limpar o texto inicial ao clicar no campo de consulta
            meuInput.addEventListener('focus', function() {
                if (this.value === 'Insira aqui o ID do Relato') {
                    this.value = '';
                }
                });

                // Restaurar o texto inicial caso o campo esteja vazio ao perder o foco
                meuInput.addEventListener('blur', function() {
                if (this.value === '') {
                    this.value = 'Insira aqui o ID do Relato';
                }
                });
        </script>

</body>
</html>
