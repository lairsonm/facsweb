<?php 
    if ($_POST != null)
    {
        error_reporting(1);
        
        session_start();
        
       //Conectando ao banco
    $conexao = new mysqli("localhost", "root", "","bar_php");
        
    if($conexao->connect_error == true)
    {
        $msg_erro = $conexao->connect_error;
        echo "Erro de conexão: $msg_erro";
        exit;
    }
        
        $usuario       = addslashes($_POST["usuario"]);
        $senha         = addslashes($_POST["senha"]);
        $senha         = md5($senha);
        
        $sql = "SELECT * 
                FROM usuario
                WHERE usuario = '$usuario'
                AND senha = '$senha'";
        
        $retorno = $conexao->query($sql);

                //Erro de execução no SQL
                if ($retorno == false) 
                {
                    echo $conexao->error;
                }
                
                //Obtem cada registro do BD
                if ( $registro = $retorno->fetch_array()) 
                {
                    $id     = $registro["id"];
                    $nome   = $registro["nome"];
                    $perfil = $registro["perfil"];
                    
                    //Criando variáveis na sessão
                    $_SESSION['logado']         = 'ok';
                    $_SESSION['id_usuario']     = $id;
                    $_SESSION['nome_usuario']   = $nome;
                    $_SESSION['perfil_usuario'] = $perfil;
                    
                    if ($_SESSION['perfil_usuario'] == 1)
                    {
                    header('Location: ../menu/index.php');
                    } else {
                    header ('Location: ../pedido/listar_pedido.php');
                    }
                } else {
                    echo"<script>
                         alert('Usuário ou Senha Inválido!')
                         </script>";
                }
    }
    
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>
  <div class="login">
	<h1>Login</h1>
    <form method="post">
    	<input type="text" name="usuario" placeholder="Usuário" required="required" />
        <input type="password" name="senha" placeholder="Senha" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large">Entrar</button> 
        <br>
        <a  class="btn btn-primary btn-block btn-large" href="../index.html">Voltar</a>
    </form>
</div>
  
    <script src="js/index.js"></script>

</body>
</html>
