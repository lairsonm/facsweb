<?php 
    session_start();
    //Verifica se o usuário está logado
    if ($_SESSION["logado"] != "ok")
    {
        header ('Location: ../login/index.php');
    }
    error_reporting(1);
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
                  location.href = '../menu/index.php';
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
            
            <?php 
            if ($_SESSION["perfil_usuario"] == "0")
            {
                echo "<a href='../pedido/listar_pedido.php'><img src='../img/voltar.gif''>Listar Pedidos</a>
                <br>
                <a href='../login/logout.php'><img src='../img/logout.png''>Logout</a>";
            }
            ?>

        <br><br>
        <fieldset style="width:300px;" > 
            <legend>Informações do Pedido</legend>
            <form action="../pedido/cadastrar_pedido.php"  method="post">
            <div class="form-group">
            <div class="col-md-12 center">
                <div class="col-md-2"></div>
                <div class="col-md-5">
            Bebida: 
            <select style="width:200px;" name="cod_bebida" class="form-control" >
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
                    $idbebida       = $registro["id"];
                    $descricaobebida = $registro["descricao"];
                
                    //Colocando os registros no select
                    echo 
                        "<option value=$idbebida>$descricaobebida</option>";
                }
                ?>
                        
                    </select>
                </div>
                <div class="col-md-2">
            Quantidade: 
            <input style="width:90px;" type="number" name="qtd_bebida" class="form-control"  required><br><br>
                </div>
                </div>
                <div class="col-md-12">
                <div class="col-md-2"></div>
                <div class="col-md-5">
            Refeição: 
            <select style="width:200px;" name="cod_refeicao" class="form-control" >
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
                    $idrefeicao        = $registro["id"];
                    $descricaorefeicao = $registro["descricao"];
                
                    //Colocando os registros no select
                    echo 
                        "<option value=$idrefeicao>$descricaorefeicao</option>";
                }
                ?>
                        
            </select> </div> 
                <div class="col-md-2">
            Quantidade: 
                
            <input style="width:90px;" type="number" name="qtd_refeicao" class="form-control" 
                   required><br>
                </div>
                </div>

            <input type="submit" value="Cadastrar" class="btn btn-default">
                </div>
            </form>
        </fieldset>
        </center>
    </body>
</html>