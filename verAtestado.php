<?php
// Obtém os valores dos filtros enviados pelo formulário
$nome = $_POST["nome"];
$cpf = $_POST["cpf"];
$data_emissao = $_POST["dataEmissao"];

// Estabelece a conexão com o banco de dados
$dsn = "mysql:host=nome_do_servidor;dbname=nome_do_banco_de_dados";
$username = "nome_do_usuario";
$password = "senha_do_usuario";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Constrói a consulta SQL dinamicamente com base nos filtros
    $sql = "SELECT * FROM tabela WHERE 1 = 1";

    if (!empty($nomePaciente)) {
        $sql .= " AND nomePaciente = :nomePaciente";
    }

    if (!empty($cpf)) {
        $sql .= " AND cpf = :cpf";
    }

    if (!empty($dataEmissao)) {
        $sql .= " AND dataEmissao = :dataEmissao";
    }

    // Prepara a consulta
    $stmt = $pdo->prepare($sql);

    // Binda os valores dos filtros
    if (!empty($nome)) {
        $stmt->bindValue(':nome', $nomePaciente);
    }

    if (!empty($cpf)) {
        $stmt->bindValue(':cpf', $cpf);
    }

    if (!empty($dataEmissao)) {
        $stmt->bindValue(':data_emissao', $dataEmissao);
    }

    // Executa a consulta
    $stmt->execute();

    // Obtém os resultados da consulta
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Exibe os resultados
    if (count($resultados) > 0) {
        echo "<div class='itens'>";
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>nomePaciente</th>";
        echo "<th>nomMedico</th>";
        echo "<th>quantidadedias</th>";
        echo "<th>dataEmissao</th>";
        echo "<th>Status</th>";
        echo "</tr>";

        foreach ($resultados as $row) {
            echo "<tr>";
            echo "<td>" . $row['idAtestado'] . "</td>";
            echo "<td>" . $row['nomePaciente'] . "</td>";
            echo "<td>" . $row['nomeMedico'] . "</td>";
            echo "<td>" . $row['quantidadeDias'] . "</td>";
            echo "<td>" . $row['dataEmissao'] . "</td>";
            echo "<td>" . $row['statusAtestado'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";
    } else {
        echo "<p>Nenhum atestado encontrado.</p>";
    }
} catch (PDOException $e) {
    echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
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
            <form enctype="multipart/form-data" method="post">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nomePaciente" name="nomePaciente" class="inputs" >

                    <label for="cpf">CPF:</label>
                    <input type="text"  id="cpf" name="cpf"  class="inputs" >

                    <label for="data_emissao">Data de emissão:</label>
                    <input type="date" id="dataEmissao" name="dataEmissao" class="inputs" >

                    <button type="submit" value="Buscar" class="bt" name="buscar">Buscar</button>
                </form>
                <div class="list">
                    <?php 
                        // Verifica se o formulário foi enviado
                        if (isset($_POST["buscar"])) {
                            // Verifica se os campos de filtro estão preenchidos
                            if (!empty($_POST["nomePaciente"]) || !empty($_POST["cpf"]) || !empty($_POST["dataEmissao"])) {
                                // Obtém os valores dos filtros
                                $nome = $_POST["nome"];
                                $cpf = $_POST["cpf"];
                                $dataEmissao = $_POST["dataEmissao"];

                                // Execute a consulta SQL usando os filtros
                                // Substitua as linhas abaixo com sua lógica de consulta ao banco de dados
                                //$data = realizarConsulta($nomePaciente, $cpf, $data_emissao);

                                // Exiba os resultados
                                if (!empty($data)){
                                     echo "<div class='itens'>";
                                     echo "<table>";
                                     echo "<tr>";
                                     echo "<th>ID</th>";
                                     echo "<th>nomePaciente</th>";
                                     echo "<th>nomMedico</th>";
                                     echo "<th>quantidadedias</th>";
                                     echo "<th>dataEmissao</th>";
                                     echo "<th>Status</th>";
                                     echo "</tr>";

                                     foreach ($data as $row) {
                                         echo "<tr>";
                                         echo "<td>".(isset($row['idAtestado']) ? $row['idAtestado'] : "")."</td>";
                                         echo "<td>".(isset($row['nomePaciente']) ? $row['nomePaciente'] : "")."</td>";
                                         echo "<td>".(isset($row['nomeMedico']) ? $row['nomeMedico'] : "")."</td>";
                                         echo "<td>".(isset($row['quantidadeDias']) ? $row['quantidadeDias'] : "")."</td>";
                                         echo "<td>".(isset($row['dataEmissao']) ? $row['dataEmissao'] : "")."</td>";
                                         echo "<td>".(isset($row['statusAtestado']) ? $row['statusAtestado'] : "")."</td>";
                                         echo "</tr>";
                                     }

                                     echo "</table>";
                                     echo "</div>";
                                 } else {
                                     echo "<p>Nenhum atestado encontrado.</p>";
                                 }
                            } else {
                                echo "<p>Preencha pelo menos um campo de filtro.</p>";
                            }
                        }
                    ?>
                </div>
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
