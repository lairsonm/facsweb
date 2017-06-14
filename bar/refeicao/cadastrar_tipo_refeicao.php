<?php 
    session_start();
    //Verifica se o usuário está logado
    if ($_SESSION["logado"] != "ok"){
    header ('Location: ../login/index.php');
    }
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
        
        <fieldset style="width:300px">
            <legend>Informações de Tipo de Refeição</legend>
            <form action="../refeicao/cadastrar_tipo_refeicao.php" method=post>
                Tipo:<br>
                <input type="text" name="descricao" required><br><br>
                
                <input type="submit">
            </form>
        </fieldset>
        </center>
    </body>
</html>