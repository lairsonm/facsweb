<?php 
    session_start();
    //Verifica se o usuário está logado
    if ($_SESSION["logado"] != "ok")
    {
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

    $id_GET = $_GET["id"];

    //Verificando se o enviar foi clicado
    if ($_POST != NULL) 
    {
        
        $descricao  = addslashes($_POST["descricao"]);
        $cod_tipo      = addslashes($_POST["cod_tipo"]);
        
        
        
        //Configurando Insert
        $sql = "UPDATE refeicao
                SET descricao = '$descricao', 
                cod_tipo =  $cod_tipo
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

    $sql_select = "SELECT r.id, r.descricao, r.cod_tipo as tipo
                   FROM refeicao AS r 
                   INNER JOIN tipo_refeicao AS tr ON r.cod_tipo = tr.id
                   WHERE r.id = $id_GET";

    $retorno_select = $conexao->query($sql_select);
    
    if($retorno_select == false)
    {
        echo $conexao->error;
    }
    while ($registro_select = $retorno_select->fetch_array())
    {
        $id_select            = $registro_select["id"];
        $descricao_select     = $registro_select["descricao"];
        $cod_tipo_select      = $registro_select["tipo"];
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
            <form action='../refeicao/editar_refeicao.php?id=<?php echo "$id_GET" ?>' method=post>
                <div class="form-group">
                Refeição:<br>
                <input type="text" name="descricao" class="form-control" value='<?php echo $descricao_select ?>' required> <br>
                
                Tipo:                
                <select name="cod_tipo" class="form-control" >
                 <?php 
                    
                
                //Conectando ao banco
                $conexao = new mysqli("localhost", "root", "","bar_php");
        
                if($conexao->connect_error == true)
                {
                    $msg_erro = $conexao->connect_error;
                    echo "Erro de conexão: $msg_erro";
                    exit;
                }
                
                $sql_tipo = "SELECT * 
                             FROM tipo_refeicao";
                
                $retorno_tipo = $conexao->query($sql_tipo);
                
                //Obtem cada registro do BD
                while ( $registro_tipo = $retorno_tipo->fetch_array()) 
                {
                    $id_tipo        = $registro_tipo["id"];
                    $descricao_tipo = $registro_tipo["descricao"];
                    
                    //Premarca o tipo 
                    if ($cod_tipo_select == $id_tipo)
                    {
                       echo 
                        "<option value=$id_tipo selected>$descricao_tipo</option>"; 
                    } else {
                        echo 
                        "<option value=$id_tipo>$descricao_tipo</option>";
                    }
                   
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