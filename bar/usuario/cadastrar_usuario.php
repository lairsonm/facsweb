<?php 
    error_reporting(1);
    session_start();
    //Verifica se o usuário está logado
    if ($_SESSION["logado"] != "ok"){
    header ('Location: ../login/index.php');
    }
    
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
        <title>Cadastro de Usuários</title>
    </head>
    <body>
        <center>
        <h1>Cadastro de Usuário</h1>
        
        <fieldset>
            <legend>Cadastro de Usuário</legend>
            <form action="../usuario/cadastrar_usuario.php" method=post>
                 <div class="form-group">
                <div class="col-md-4">     
                Nome:<br>
                <input type="text" name="nome" class="form-control" required><br>
                </div>
                      <div class="col-md-4"> 
                Usuário:<br>
                <input type="text" name="usuario" class="form-control" required><br>
                           </div>
                 <div class="col-md-4"> 
                Senha:<br>
                <input type="text" name="senha" class="form-control" required><br>
                      </div>
                </div>
                
                <input type="submit" class="btn btn-default">
            </form>
        </fieldset>
        </center>
    </body>
</html>