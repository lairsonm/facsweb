<?php 
    
    session_start();
    //Verifica se o usuário está logado
    if ($_SESSION["logado"] != "ok"){
    header ('Location: ../login/index.php');
    }

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
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Listagem de Tipo de Bebida</title>
        <script src="js/edit.js"></script>
    </head>
    <body>
        <center>
            <h1>Listagem de Tipo de Bebida</h1>
            <div class="table-responsive">
            
            <table border="1" class="table">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Editar</th>
                <th>Apagar</th>
            </tr>
                <?php 
                
                $sql = "SELECT *
                        FROM tipo_bebida
                        ORDER BY descricao";
                
                $retorno = $conexao->query($sql);
                
                //Erro de execução no SQL
                if ($retorno == false) 
                {
                    echo $conexao->error;
                }
                
                //Obtem cada registro do BD
                while ( $registro = $retorno->fetch_array()) 
                {
                    $id   = $registro["id"];
                    $descricao = $registro["descricao"];
                    
                    //Colocando os registros na tabela
                    echo "
                         <tr>
                            <td>$id</td>
                            <td>$descricao</td>
                            <td><a onclick='editarbebidas($id);'><img src='../img/edit.png'></a></td>
                            <td><a href='../bebida/apagar_tipo_bebida.php?id=$id'><img src='../img/delete.png'></a></td>
                         </tr>";
                    
                }
                ?>
            <tr>
            </tr>    
            </table>
            </div>
        </center>
    </body>
</html>