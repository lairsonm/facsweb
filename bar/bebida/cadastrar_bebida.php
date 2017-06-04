<?php 
    //Verificando se o enviar foi clicado
    if ($_POST != NULL) 
    {
        $descricao  = addslashes($_POST["descricao"]);
        $cod_tipo       = addslashes($_POST["cod_tipo"]);
        
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
        $sql = "INSERT INTO bebida (descricao, cod_tipo) 
                VALUES ('$descricao', '$cod_tipo')";
        
        //Verifica o estado do cadastro
        $retorno = $conexao->query($sql);
        
        if ($retorno == true)
        {
            echo "<script>
                    alert('Cadastrado com Sucesso!');
                    location.href = 'cadastrar_bebida.php';
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
        <title>Cadastro de Bebidas</title>
    </head>
    <body>
        <center>
        <h1>Cadastro de Bebidas</h1>
        <a href="listar_bebida.php"><img src="img/add.png">Listar Bebidas</a>
        <br><br>
        <fieldset style="width:300px">
            <legend>Informações da Bebida</legend>
            <form method=post>
                Bebida:<br>
                <input type="text" name="descricao" required><br><br>
                
                Tipo:               
                <select name="cod_tipo">
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
                        FROM tipo_bebida";
                
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
                <br><br>
                <input type="submit">
            </form>
        </fieldset>
        </center>
    </body>
</html>