<?php 
    session_start();
    //Verifica se o usuário está logado
    if ($_SESSION["logado"] != "ok")
    {
    header ('Location: ../login/index.php');
    } 
    error_reporting(1);
    //Verificando se o enviar foi clicado
    if ($_POST != NULL) 
    {
        
        $descricao  = addslashes($_POST["descricao"]);
        $cod_tipo      = addslashes($_POST["cod_tipo"]);
        
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
        $sql = "INSERT INTO refeicao (descricao, cod_tipo) 
                VALUES ('$descricao', '$cod_tipo')";
        
        //Verifica o estado do cadastro
        $retorno = $conexao->query($sql);
        
        if ($retorno == true)
        {
            echo "<script>
                    alert('Cadastrado com Sucesso!');
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
        <title>Cadastro de Refeições</title>
    </head>
    <body>
        <center>
        <h1>Cadastro de Refeições</h1>
        
        <fieldset style="width:400px">
            <legend>Informações da Refeição</legend>
            <form action="../refeicao/cadastrar_refeicao.php" method=post>
                <div class="form-group">
                Refeição:<br>
                <input type="text" name="descricao" class="form-control" required> <br>
                
                Tipo:                
                <select name="cod_tipo" class="form-control" >
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
                        FROM tipo_refeicao";
                
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
                <br>
                <input type="submit" class="btn btn-default">
                </div>
            </form>
        </fieldset>
        </center>
    </body>
</html>