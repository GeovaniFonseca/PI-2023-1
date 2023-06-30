<?php
include('protect.php');
include('conexao.php');

$idFuncionario = $_SESSION['idFuncionario'];

if(isset($_POST['dataPeriodoInicial']) || isset($_POST['dataPeriodoFinal'])){
    $dataInicial = $_POST['dataPeriodoInicial'];
    $dataFinal = $_POST['dataPeriodoFinal'];

    $sql = "SELECT * FROM atestados WHERE fk_idFuncionario = $idFuncionario AND dataEmissao BETWEEN '$dataInicial' AND '$dataFinal'";
} else {
    $sql = "SELECT * FROM atestados WHERE fk_idFuncionario = $idFuncionario";
}

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data = array();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de atestados</title>
    <link href="CSS/histAtestado.css" rel="stylesheet">
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
                <form enctype="multipart/form-data" method="post">
                    <label for="data_emissao">Data inicial:</label>
                    <input type="date" id="data_emissao" name="dataPeriodoInicial" class="inputs" required>

                    <label for="data_emissao">Data final:</label>
                    <input type="date" id="data_emissao" name="dataPeriodoFinal" class="inputs" required>

                    <button type="submit" value="Buscar" class="bt">Buscar</button>
                </form>
                <div class="list">
                    <div class="itens">
                        <table>
                            <tr>
                            <th>ID</th>
                                <th>Nome do paciente</th>
                                <th>Nome do médico</th>
                                <th>Quantidade de dias</th>
                                <th>Data de emissão</th>
                                <th>Status</th>
                            </tr>
                            <?php 
                                if (!empty($data)){
                                    foreach ($data as $row) {
                                        echo "<tr>";
                                        echo "<td class='id-column'>".(isset($row['idAtestado']) ? $row['idAtestado'] : "")."</td>";
                                        echo "<td>".(isset($row['nomePaciente']) ? $row['nomePaciente'] : "")."</td>";
                                        echo "<td>".(isset($row['nomeMedico']) ? $row['nomeMedico'] : "")."</td>";
                                        echo "<td>".(isset($row['quantidadeDias']) ? $row['quantidadeDias'] : "")."</td>";
                                        echo "<td>".(isset($row['dataEmissao']) ? $row['dataEmissao'] : "")."</td>";
                                        echo "<td>".(isset($row['statusAtestado']) ? $row['statusAtestado'] : "")."</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>Nenhum atestado encontrado.</td></tr>";
                                }
                            ?>
                        </table>
                    </div>
                </div>
                <label for="bt"></label><br>
                <form action="painel.php">
                    <input type="submit" class="bt" name="bt" value="Voltar" />
                </form>
            </div>
        </div>
        
        <div id="footer">
            <p>E-atestados - Todos os direitos Reservados - 2022</p>
        </div>
    </div>
</body>
</html>
