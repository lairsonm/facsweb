<?php 
    session_start();
    //Verifica se o usuário está logado
    if ($_SESSION["logado"] != "ok"){
    header ('Location: ../login/index.php');
    }

    if($_POST != null)
    {
        
        $cod_bebida            =   addslashes($_POST["cod_bebida"]);
        $qtd_bebida            =   addslashes($_POST["qtd_bebida"]);
        $cod_refeicao          =   addslashes($_POST["cod_refeicao"]);
        $qtd_refeicao          =   addslashes($_POST["qtd_refeicao"]);
        $cod_usuario           =   addslashes($_SESSION['id_usuario']);
        
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
        
            
        <br><br>
        <fieldset style="width:300px;"> 
            <legend>Informações do Pedido</legend>
            <form action="../pedido/cadastrar_pedido.php" method="post">
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
            <input style="width:20px;" type="text" name="qtd_bebida" required><br><br>
                
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
            <input style="width:20px;" type="text" name="qtd_refeicao" required><br><br>

            <input type="submit" value="Cadastrar">
            </form>
        </fieldset>
        </center>
    </body>
</html>