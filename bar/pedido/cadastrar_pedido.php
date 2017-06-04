<?php 
    
    if($_POST != null)
    {
        $cod_bebida            =   addslashes($_POST["cod_bebida"]);
        $qtd_bebida            =   addslashes($_POST["qtd_bebida"]);
        $cod_refeicao          =   addslashes($_POST["cod_refeicao"]);
        $qtd_refeicao          =   addslashes($_POST["qtd_refeicao"]);
        $cod_usuario           =   addslashes($_POST["cod_usuario"]);
        
        $conexao = new mysqli("localhost", "root", "","bar_php");
        
        if($conexao->connect_error == true)
        {
            $msg_erro = $conexao->connect_error;
            echo "Erro de conexão: $msg_erro";
            exit;
        }
        
        
        $sql = "INSERT INTO pedido 
        (cod_bebida, qtd_bebida, cod_refeicao, qtd_refeicao, cod_usuario) 
        VALUES('$cod_bebida', '$qtd_bebida', '$cod_refeicao', '$qtd_refeicao', '$cod_usuario')";
        
        $retorno = $conexao->query($sql);
        if ($retorno)
        {
            echo "<script>
            alert('Cadastrado com sucesso!');
            location.href = 'cadastrar_pedido.php';
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
        <title>Cadastro de Pedidos</title>
    </head>
    <body>
        <center>
        <h1>Cadastro de Pedido</h1>
        <a href="listar_pedido.php"><img src="img/add.png">Listar Pedidos</a>
        <br><br>
        <fieldset style="width:300px;"> 
            <legend>Informações do Pedido</legend>
            <form method="post">
            Bebida: 
            <select name="cod_bebida">
                 <?php 
                
                //Não exibe mensagens de erro de variável vazia
                error_reporting(1);
                
                //Conectando ao banco
                $conexao = new mysqli("localhost", "root", "","bar_php");
        
                if($conexao->connect_error == true)
                {
                    $msg_erro = $conexao->connect_error;
                    echo "Erro de conexão: $msg_erro";
                    exit;
                }
                
                $sql = "SELECT * 
                        FROM bebida";
                
                $retorno = $conexao->query($sql);
                
                //Obtem cada registro do BD
                while ( $registro = $retorno->fetch_array()) 
                {
                    $id        = $registro["id"];
                    $descricao = $registro["descricao"];
                
                    //Colocando os registros no select
                    echo 
                        "<option value=$id>$descricao</option>";
                }
                ?>
                        
            </select>  
            Quantidade: 
            <input type="text" name="qtd_bebida" required><br><br>
                
            Refeição: 
            <select name="cod_refeicao">
                 <?php 
                
                //Não exibe mensagens de erro de variável vazia
                error_reporting(1);
                
                //Conectando ao banco
                $conexao = new mysqli("localhost", "root", "","bar_php");
        
                if($conexao->connect_error == true)
                {
                    $msg_erro = $conexao->connect_error;
                    echo "Erro de conexão: $msg_erro";
                    exit;
                }
                
                $sql = "SELECT * 
                        FROM refeicao";
                
                $retorno = $conexao->query($sql);
                
                //Obtem cada registro do BD
                while ( $registro = $retorno->fetch_array()) 
                {
                    $id        = $registro["id"];
                    $descricao = $registro["descricao"];
                
                    //Colocando os registros no select
                    echo 
                        "<option value=$id>$descricao</option>";
                }
                ?>
                        
            </select>    
            Quantidade: 
            <input type="text" name="qtd_refeicao" required><br><br>
            
            Usuário: 
            <select name="cod_usuario">
                 <?php 
                
                //Não exibe mensagens de erro de variável vazia
                error_reporting(1);
                
                //Conectando ao banco
                $conexao = new mysqli("localhost", "root", "","bar_php");
        
                if($conexao->connect_error == true)
                {
                    $msg_erro = $conexao->connect_error;
                    echo "Erro de conexão: $msg_erro";
                    exit;
                }
                
                $sql = "SELECT * 
                        FROM usuario";
                
                $retorno = $conexao->query($sql);
                
                //Obtem cada registro do BD
                while ( $registro = $retorno->fetch_array()) 
                {
                    $id        = $registro["id"];
                    $nome      = $registro["nome"];
                
                    //Colocando os registros no select
                    echo 
                        "<option value=$id>$nome</option>";
                }
                ?>
           

            <input type="submit" value="Cadastrar">
            </form>
        </fieldset>
        </center>
    </body>
</html>