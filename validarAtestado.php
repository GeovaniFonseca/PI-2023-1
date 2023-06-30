<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/validarAtestado.css">
    <title>Validar atestados</title>
</head>

<body>
    <div id="site">
        <header id="header">
            <div id="logo">
                <img src="IMG/logo.png" alt="" width="150px" style="margin-left: 10px;">
            </div>
        </header>

        <div id="container">
            <div id="box">
                <?php
                include('protect.php');
                include('conexao.php');

                $idAtestado = $_GET['idAtestado'];
                $sql = "SELECT * FROM atestados WHERE idAtestado = $idAtestado";

                $result = $mysqli->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $idAtestado = $row['idAtestado'];
                    $nomePaciente = $row['nomePaciente'];
                    $nomeMedico = $row['nomeMedico'];
                    $quantidadeDias = $row['quantidadeDias'];
                    $dataEmissao = $row['dataEmissao'];
                    $statusAtestado = $row['statusAtestado'];
                    $nomeArquivo = $row['path']; // assume que o caminho do arquivo está armazenado na coluna 'path'

                    echo "<p><strong>ID Atestado:</strong> $idAtestado</p>";
                    echo "<p><strong>Nome do paciente:</strong> $nomePaciente</p>";
                    echo "<p><strong>Nome do médico:</strong> $nomeMedico</p>";
                    echo "<p><strong>Quantidade de dias:</strong> $quantidadeDias</p>";
                    echo "<p><strong>Data de emissão:</strong> $dataEmissao</p>";
                    echo "<p><strong>Avaliação do atestado:</strong> $statusAtestado</p>";

                    if (file_exists($nomeArquivo)) {
                        echo '<p><a href="' . $nomeArquivo . '" target="_blank">Visualizar Atestado</a></p>';
                    } else {
                        echo 'O atestado não está disponível para visualização.';
                    }

                    echo '<form action="" method="post">';
                    echo '<label for="status">Novo Status:</label>';
                    echo '<select name="status" id="status">';
                    echo '<option value="Pendente">Pendente</option>';
                    echo '<option value="Aprovado">Aprovado</option>';
                    echo '<option value="Rejeitado">Rejeitado</option>';
                    echo '</select>';
                    echo '<br>';
                    echo '<input type="submit" class="bt" name="bt" value="Salvar" />';
                    echo '</form>';

                    echo '<form action="painelSesmt.php">';
                    echo '<input type="submit" class="bt" name="bt" value="Voltar" />';
                    echo '</form>';
                } else {
                    echo "Nenhum atestado encontrado.";
                }

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $novoStatus = $_POST['status'];
                    $sql = "UPDATE atestados SET statusAtestado = '$novoStatus' WHERE idAtestado = '$idAtestado'";
                    $sql_query = $mysqli->query($sql);

                    header("Location: painelSesmt.php");
                }
                ?>
            </div>
        </div>

        <div id="footer">
            <p>E-atestados - Todos os direitos Reservados - 2022</p>
        </div>
    </div>

</body>

</html>
