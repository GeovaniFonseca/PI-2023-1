<?php
include('conexao.php');

if(isset($_POST['cpf']) || isset($_POST['senha'])) {

    if(strlen($_POST['cpf']) == 0) {
        echo "Preencha seu e-mail";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {

        $cpf = $mysqli->real_escape_string($_POST['cpf']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM funcionarios WHERE cpf = '$cpf' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $funcionario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['idFuncionario'] = $funcionario['idFuncionario'];
            $_SESSION['nome'] = $funcionario['nome'];
            $_SESSION['sesmt'] = $funcionario['sesmt'];

            // Redirecionar para a página de destino após o login
            if($_SESSION['sesmt'] == 'sim'){
                header("Location: painelSesmt.php");
            } else {
                header("Location: painel.php");
            }

            exit(); // Terminar o script para evitar que o restante do código seja executado

        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }

    }

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="CSS\login-page.css">
</head>
<body>
    <div class="container">
        <div class="form-signin">
            <form method="post" name="login_form">
                <div class="logo">
                    <img src="IMG/logo.png" alt="logo" width="60%">
                </div>
                <div class="form-group">
                    <input oninput="CPF_format(this)" type="text" class="form-control" name="cpf" placeholder="CPF">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control input-block-level" placeholder="Senha" name="senha" value="" required="">
                </div>
                <button type="submit" class="btn-entrar">Entrar</button>
            </form>
            <hr style="margin:5px auto; opacity: 0;">
            <hr style="width:50%;margin:5px auto; opacity: 0;">
        </div>
    </div>
</body>
</html>
