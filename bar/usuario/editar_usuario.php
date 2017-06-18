<?php 
    error_reporting(1);
    session_start();
    //Verifica se o usuário está logado
    if ($_SESSION["logado"] != "ok"){
    header ('Location: ../login/index.php');
    }

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
        
        $nome       = addslashes($_POST["nome"]);
        $usuario    = addslashes($_POST["usuario"]);
        $perfil     = addslashes($_POST["perfil"]);
        $senha      = addslashes($_POST["senha"]);
        $senha      = md5($senha);

        //Configurando Insert
        $sql = "UPDATE usuario 
                SET nome = '$nome',
                usuario = '$usuario', 
                senha = '$senha',
                perfil = $perfil
                WHERE id = $id_GET";
        
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
                   FROM usuario
                   WHERE id = $id_GET";

        $retorno_select = $conexao->query($sql_select);
        
        if($retorno_select == false)
        {
            echo $conexao->error;
        }
        while ($registro_select = $retorno_select->fetch_array())
        {
            $id_select       = $registro_select['id'];
            $nome_select     = $registro_select['nome'];
            $usuario_select  = $registro_select['usuario'];
            $senha_select    = $registro_select['senha'];
            $perfil_select   = $registro_select['perfil'];
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
            <form action='../usuario/editar_usuario.php?id=<?php echo $id_GET; ?>' method=post>
                 <div class="form-group">
                <div class="col-md-4">     
                Nome:<br>
                <input type="text" name="nome" class="form-control" value='<?php echo $nome_select; ?>' required><br>
                </div>
                      <div class="col-md-4"> 
                Usuário:<br>
                <input type="text" name="usuario" class="form-control" value='<?php echo $usuario_select; ?>' required><br>
                           </div>
                 <div class="col-md-4"> 
                Senha:<br>
                <input type="password" name="senha" class="form-control" required><br>
                      </div>
                 <div class="col-md-4"> 
                Perfil:<br>
                <input type="number" name="perfil" class="form-control" value='<?php echo $perfil_select; ?>' required><br>
                </div>
                
                <input type="submit" class="btn btn-default">
            </form>
        </fieldset>
        </center>
    </body>
</html>