<?php 
    //Verificando se o enviar foi clicado
    if ($_POST != NULL) 
    {
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
        $sql = "INSERT INTO tipo_bebida (descricao) 
                VALUES ('$descricao')";
        
        //Verifica o estado do cadastro
        $retorno = $conexao->query($sql);
        
        if ($retorno == true)
        {
            echo "<script>
                    alert('Cadastrado com Sucesso!');
                    location.href = 'cadastrar_tipo_bebida.php';
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
        <title>Cadastro de Tipo de Bebida</title>
    </head>
    <body>
        <center>
        <h1>Cadastro de Tipo de Bebida</h1>
        <a href="listar_tipo_bebida.php"><img src="img/add.png">Listar Tipo de Bebida</a>
        <br><br>
        <fieldset style="width:300px">
            <legend>Informações de Tipo de Bebida</legend>
            <form method=post>
                Tipo:<br>
                <input type="text" name="descricao" required><br><br>
                
                <input type="submit">
            </form>
        </fieldset>
        </center>
    </body>
</html>