<?php 

    //Verificando se o enviar foi clicado
    if ($_POST != NULL) 
    {
        //Verifica se o usuário está logado
        if ($_SESSION["logado"] != "ok"){
        header ('Location: ../login/index.php');
        }
        
        $descricao  = addslashes($_POST["descricao"]);
        
        //Configurando conexão com o banco
        $conexao = new mysqli("localhost", "root", "", "bar_php");
        
        //Verificando falha na conexão
        if ($conexao->connect_error == true)
        {
            $msg_error = $conexao->connect_error;
            echo "Erro de conexão: $msg_error";
            exit;
        }
        
        //Configurando Insert
        $sql = "INSERT INTO tipo_refeicao (descricao) 
                VALUES ('$descricao')";
        
        //Verifica o estado do cadastro
        $retorno = $conexao->query($sql);
        
        if ($retorno == true)
        {
            echo "<script>
                    alert('Cadastrado com Sucesso!');
                    location.href = 'cadastrar_tipo_refeicao.php';
                    </script>";
        } else {
            echo "<script>
                    alert('Erro ao Cadastrar!');
                    </script>";
            
            echo $conexao->erro;
        }
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cadastro de Tipo de Refeição</title>
    </head>
    <body>
        <center>
        <h1>Cadastro de Tipo de Refeição</h1>
         <a href="../bebida/cadastrar_bebida.php"><img src="../img/add.png">Cadastrar Bebida</a>
        <a href="../bebida/listar_bebida.php"><img src="../img/add.png">Listar Bebida</a>
        <a href="../bebida/cadastrar_tipo_bebida.php"><img src="../img/add.png">Cadastrar Tipo de Bebida</a>
        <a href="../bebida/listar_tipo_bebida.php"><img src="../img/add.png">Listar Tipo de Bebida</a>
            <br>
        <a href="../refeicao/cadastrar_refeicao.php"><img src="../img/add.png">Cadastrar Refeição</a>
        <a href="../refeicao/listar_refeicao.php"><img src="../img/add.png">Listar Refeição</a>
        <a href="../refeicao/cadastrar_tipo_refeicao.php"><img src="../img/add.png">Cadastrar Tipo de Refeição</a>
        <a href="../refeicao/listar_tipo_refeicao.php"><img src="../img/add.png">Listar Tipo de Refeição</a>
            <br>
        <a href="../pedido/cadastrar_pedido.php"><img src="../img/add.png">Cadastrar Pedido</a>
        <a href="../pedido/listar_pedido.php"><img src="../img/add.png">Listar Pedido</a>
            <br>
        <a href="../usuario/cadastrar_usuario.php"><img src="../img/add.png">Cadastrar Usuário</a>
        <a href="../usuario/listar_usuario.php"><img src="../img/add.png">Listar Usuário</a>
        <br><br>
        <fieldset style="width:300px">
            <legend>Informações de Tipo de Refeição</legend>
            <form method=post>
                Tipo:<br>
                <input type="text" name="descricao" required><br><br>
                
                <input type="submit">
            </form>
        </fieldset>
        </center>
    </body>
</html>