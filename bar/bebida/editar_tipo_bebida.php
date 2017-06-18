<?php
    session_start();
    //Verifica se o usuário está logado
    if ($_SESSION["logado"] != "ok"){
    header ('Location: ../login/index.php');
    }
    error_reporting(1);

    //Configurando conexão com o banco
    $conexao = new mysqli("localhost", "root", "", "bar_php");
        
    //Verificando falha na conexão
    if ($conexao->connect_error == true)
    {
        $msg_error = $conexao->connect_error;
        echo "Erro de conexão: $msg_error";
        exit;
    }
        
    $id_GET = $_GET['id'];

    //Verificando se o enviar foi clicado
    if ($_POST != NULL) 
    {
          
        $descricao  = addslashes($_POST["descricao"]);
        
        //Configurando Update
        $sql = "UPDATE tipo_bebida
                SET descricao = '$descricao',
                WHERE id = $id_GET";
        echo $sql;
        
        //Verifica o estado do cadastro
        $retorno = $conexao->query($sql);
        
        if ($retorno == true)
        {
            echo "<script>
                    alert('Atualizado com Sucesso!');
                    location.href = '../menu/index.php';
                    </script>";
        } else {
            echo "<script>
                    alert('Erro ao Atualizar!');
                    </script>";
            
            echo $conexao->erro;
        }
    } 
        $sql_select = "SELECT *
                       FROM tipo_bebida
                       WHERE id = $id_GET";

        $retorno_select = $conexao->query($sql_select);
        
        if($retorno_select == false)
        {
            echo $conexao->error;
        }
        while ($registro_select = $retorno_select->fetch_array())
        {
            $id_select            = $registro_select['id'];
            $descricao_select     = $registro_select['descricao'];
        }
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cadastro de Tipo de Bebida</title>
    </head>
    <body>
        <center>
        <h1>Cadastro de Tipo de Bebida</h1>
       
        <fieldset style="width:400px">
            <legend>Informações de Tipo de Bebida</legend>
            <form action='../bebida/cadastrar_tipo_bebida.php?id=<?php echo "$id_GET"; ?>' method=post>
                 <div class="form-group">
                Tipo:<br>
                <input type="text" name="descricao" class="form-control" 
                       value='<?php echo "$descricao_select";?>' required><br>
                
                <input type="submit" class="btn btn-default" >
                </div>
            </form>
        </fieldset>
        </center>
    </body>
</html>