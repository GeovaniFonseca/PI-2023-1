<?php

include('protect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS\home.css">
    <title>Document</title>
</head>
<body>
    <div id="site">
        <header id="header">            
            <div id="logo">
                <img src="IMG/logo.png" alt="" width="150px" style="margin-left: 10px;">
            </div>
            <div class="logout">
                <label for="logout"></label><br>
                    <form action="logout.php">
                        <input type="submit" class="logout" name="logout" value="Logout" />
                    </form>
            </div>
            
        </header>
    

        <div class="container">
            <div id="conteudo">
                
                    <div id="box1">   
                        <label for="btn-form">Adicionar atestado</label><br>
                        <form action="novoAtestado.php">
                            <input type="submit" class="bt" name="btn-form" value="Clique aqui" />
                        </form>
                    </div>    
                    <div id="box2">
                        <label for="btn-hist" >Histórico de atestados</label><br>
                        <form action="verAtestado.php">
                            <input type="submit" class="bt" name="btn-hist" value="Clique aqui" />
                        </form>
                    </div>
            </div>
        </div>
    
        <div id="footer">
            <p>E-atestados - Todos os direitos Reservados - 2023</p>
        </div>
    </div>
</body>
</html>