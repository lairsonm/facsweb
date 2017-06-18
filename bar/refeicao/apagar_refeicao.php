<?php 
    error_reporting(1);
    session_start();
    //Verifica se o usuário está logado
    if ($_SESSION["logado"] != "ok"){
    header ('Location: ../login/index.php');
    }

    if ($_GET["id"] != NULL) {
        
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
        $sql = "DELETE FROM refeicao
                WHERE id = $id_GET";
        
        $retorno = $conexao -> query($sql);
        
        if ($retorno == false)
        {
            echo $conexao->error;
        } else {
            echo "<script>
                  alert('Refeição Excluída!');
                  location.href = '../menu/index.php';
                  </script>";
        }
        
    } else {
        echo "<script>
                  alert('ID Não Encontrado!');
                  location.href = '../menu/index.php';
                  </script>";
    }
?>
<html>
    <head>
        <meta charset="utf-8">
    </head>
</html>