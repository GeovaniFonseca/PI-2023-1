<?php
    include('protect.php');
    include('conexao.php');

    $idAtestado = $_GET['idAtestado'];
    $sql = "SELECT * FROM atestados WHERE idAtestado = $idAtestado";
    echo "<p>$idAtestado</p>";

    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            echo "<p><strong>ID Atestado:</strong> " . $row['idAtestado'] . "</p>";
            echo "<p><strong>Nome do paciente:</strong> " . $row['nomePaciente'] . "</p>";
            echo "<p><strong>Nome do médico:</strong> " . $row['nomeMedico'] . "</p>";
            echo "<p><strong>Quantidade de dias:</strong> " . $row['quantidadeDias'] . "</p>";
            echo "<p><strong>Data de emissão:</strong> " . $row['dataEmissao'] . "</p>";
            echo "<p><strong>Avaliação do atestado:</strong> " . $row['statusAtestado'] . "</p>";
            echo "<hr>";
        }
    } else {
        echo "Nenhum atestado encontrado.";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $novoStatus = $_POST['status'];
        $sql = "UPDATE atestados SET statusAtestado = '$novoStatus' WHERE idAtestado = '$idAtestado'";
        $sql_query = $mysqli->query($sql);

        header("Location: painelSesmt.php");
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validar atestados</title>
</head>
<body>
    <form action="" method="post">
        <label for="status">Novo Status:</label>
        <select name="status" id="status">
            <option value="Pendente">Pendente</option>
            <option value="Aprovado">Aprovado</option>
            <option value="Rejeitado">Rejeitado</option>
        </select>
        
        <br>
        
        <input type="submit" value="Salvar">
    </form>
    <p>
        <a href="painelSesmt.php">Voltar ao painel</a>
    </p>
</body>
</html>