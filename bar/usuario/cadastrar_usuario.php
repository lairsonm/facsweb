<?php 
    //Verificando se o enviar foi clicado
    if ($_POST != NULL) 
    {
        $nome       = addslashes($_POST["nome"]);
        $usuario    = addslashes($_POST["usuario"]);
        $senha      = addslashes($_POST["senha"]);
        $senha      = md5($senha);
        
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
        $sql = "INSERT INTO usuario (nome, usuario, senha) 
                VALUES ('$nome', '$usuario', '$senha')";
        
        //Verifica o estado do cadastro
        $retorno = $conexao->query($sql);
        
        if ($retorno == true)
        {
            echo "<script>
                    alert('Cadastrado com Sucesso!');
                    location.href = 'cadastrar_usuario.php';
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
        <title>Cadastro de Usuários</title>
    </head>
    <body>
        <center>
        <h1>Cadastro de Usuário</h1>
        <a href="listar_usuario.php"><img src="img/add.png">Listar Usuários</a>
        <br><br>
        <fieldset style="width:300px">
            <legend>Cadastro de Usuário</legend>
            <form method=post>
                Nome:<br>
                <input type="text" name="nome" required><br><br>
                
                Usuário:<br>
                <input type="text" name="usuario" required><br><br>
                
                Senha:<br>
                <input type="text" name="senha" required><br><br>
                
                <input type="submit">
            </form>
        </fieldset>
        </center>
    </body>
</html>