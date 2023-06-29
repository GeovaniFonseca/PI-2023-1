<?php
    include('protect.php');
    include('conexao.php');


    if(isset($_POST['nomePaciente']) || isset($_POST['nomeMedico']) || isset($_POST['quantidadeDias']) || isset($_POST['dataEmissao']) || isset($_FILES['atestado'])) {

        $atestado = $_FILES['atestado'];

        if ($atestado['size'] > 5000000)
            die("Max 5MB");
        if ($atestado['error'])
            die("Falha ao enviar arquivo");
    
        $pasta = "atestados/";
        $nomeDoAtestado = $atestado['name'];
        $novoNomeAtestado = uniqid();
        $extensao = strtolower(pathinfo($nomeDoAtestado, PATHINFO_EXTENSION));
    
        if ($extensao != "pdf") {
            echo "<p>Somente PDF</p>";
        } else {
            echo "<p>Arquivo enviado com sucesso</p>";
        }

        $path = $pasta . $novoNomeAtestado . "." . $extensao;

        $deu_certo = move_uploaded_file($atestado["tmp_name"], $pasta . $novoNomeAtestado . "." . $extensao);


        $nomePaciente = $mysqli->real_escape_string($_POST['nomePaciente']);
        $nomeMedico = $mysqli->real_escape_string($_POST['nomeMedico']);
        $quantidadeDias = $mysqli->real_escape_string($_POST['quantidadeDias']);
        $dataEmissao = $mysqli->real_escape_string($_POST['dataEmissao']);

        $idFuncionario = $_SESSION['idFuncionario'];

        $sql = "INSERT INTO atestados (fk_idFuncionario, nomePaciente, nomeMedico, quantidadeDias, dataEmissao, statusAtestado, path) VALUES ('$idFuncionario', '$nomePaciente', '$nomeMedico', '$quantidadeDias', '$dataEmissao', 'Pendente', '$path')";
        $sql_query = $mysqli->query($sql) or die("Falha na execução do código SQL: " . $mysqli->error);

        header("Location: painel.php");
    }

    
    

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu site de atestados médicos</title>
    <link href="CSS\atestadoForm.css" rel="stylesheet">
</head>

<body>

    <div id="site">
        <header id="header">
            <div id="logo">
                <img src="IMG/logo.png" alt="" width="150px"
                    style="margin-left: 10px;">
            </div>
            <div class="logout">
                <label for="logout"></label><br>
                    <form action="logout.php">
                        <input type="submit" class="logout" name="logout" value="Logout" />
                    </form>
            </div>
        </header>

        <div id="container">
            <div id="box">
                <h1>Insira as informações</h1>
                <form enctype="multipart/form-data" method="post">
                    <label for="nomePaciente">Nome do paciente:</label>
                    <input type="text" id="nome" name="nomePaciente" class="inputs" required><br>

                    <label for="nomeMedico">Nome do médico:</label>
                    <input type="text" id="nome_medico" name="nomeMedico" class="inputs" required><br>

                    <label for="quantidadeDias">Quantidade de dias:</label>
                    <input type="number" id="dias_atestado" name="quantidadeDias" class="inputs" required><br>

                    <label for="dataEmissao">Data de emissão:</label>
                    <input type="date" id="data_emissao" name="dataEmissao" class="inputs" required><br>

                    <label for="">Enviar atestado (PDF):</label>
                    <input name="atestado" type="file" id="pdf" accept="application/pdf" class="inputs" required><br>
                    <button type="submit" value="Enviar" class="bt">Enviar</button>
                </form>
                
                <label for="bt"></label><br>
                    <form action="painel.php">
                        <input type="submit" class="bt" name="bt" value="Voltar" />
                    </form>
            </div>
        </div>
        
        <div id="footer">
            <p>E-atestados - Todos os direitos Reservados - 2023</p>
        </div>
    </div>
</body>
</html>