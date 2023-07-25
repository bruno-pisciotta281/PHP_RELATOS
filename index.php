<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    <title>NVT - RELATOS</title>
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
            height: 100vh; /* Ocupar toda a altura da janela para centralizar verticalmente */
            margin: 0;
        }

        .content-box {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            max-width: 600px;
            width: 80%;
            position: relative;
        }

        h1 {
            color: #00acc1;
        }

        h2 {
            color: #00acc1;
            margin: 0;
            text-align: justify;
        }

        p {
            margin: 10px;
            color:  #1d1d1d;
            text-align: justify;
        }

        input[type="text"] {
            padding: 10px;
            margin: 10px;
            border: 1px solid #00acc1;
            border-radius: 5px;
            background-color: #fff;
            color: #1d1d1d;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
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

        input[type="text"] {
            font-family: 'Montserrat', sans-serif;
            text-align: center;
        }

        .button-content {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .button-content a {
            text-decoration: none;
            display: inline-block; /* Add display: inline-block; to make the link inline with the text */
        }

        .button-content a:hover div {
            background-color: #1d1d1d;
            color: #00acc1;
            
        }


    </style>
</head>
<body>  
    <div class="content-box">
        <h1>NVT - RELATOS</h1>
        <h2>Confidencialidade e Anonimato</h2>
        <p>O canal de Relatos é uma ferramenta confidencial para que os funcionários possam informar ou buscar apoio sobre questões éticas e de comportamento relacionado a possíveis violações das políticas do Grupo NVT ou das Leis e Regulamentos.</p>
        <p>O Grupo NVT não tolera retaliações com quem relata uma preocupação de boa fé.</p>
        <p>Todos os relatos serão tratados de forma confidencial e anônima, o solicitante determina na abertura do relato se deseja se identificar ou não, de qualquer forma manteremos o anonimato das tratativas.</p>
        <p>Caso queira apenas adicionar um relato, clique no botão abaixo:</p>
        <button onclick="window.location.href = 'form.php';">Adicionar Relato</button>
        <form action="consulta.php" method="GET">
        <input type="text" name="relato_id" required id="relato_id" value="Consulte Relato por ID" onfocus="limparTextoInicial()">  
            <br>
            <div class="button-container">
                <button type="submit">Consultar Relato</button>
            </div>
            <div class="button-content" style="position: absolute; top: 10px; right: 10px;">
                <a href="listar_relatos.php">
                    <div style="padding: 5px 15px; margin: 1px; border: none; border-radius: 5px; background-color: #00acc1; color: #fff; font-weight: bold; cursor: pointer;">
                        Lista de Relatos
                    </div>
                </a>
            </div>
        </form>
        
    </div>

        <script>
            const meuInput = document.getElementById('relato_id');


            meuInput.addEventListener('focus', function() {
                if (this.value === 'Consulte Relato por ID') {
                    this.value = '';
                }
                });

                meuInput.addEventListener('blur', function() {
                if (this.value === '') {
                    this.value = 'Consulte Relato por ID';
                }
                });

                function limparTextoInicial() {
                const meuInput = document.getElementById('relato_id');
                if (meuInput.value === 'Consulte Relato por ID') {
                    meuInput.value = '';
                }
                }
        </script>

</body>
</html>
