<?php 
    error_reporting(1);
    session_start();
    //Verifica se o usuário está logado
    if ($_SESSION["logado"] != "ok"){
    header ('Location: ../login/index.php');
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Listagem de Pedidos</title>
    </head>
    <body>
        <center>
            <h1>Listagem de Pedidos</h1>
            
            <?php 
            if ($_SESSION["perfil_usuario"] == "0")
            {
                echo "<a href='../pedido/cadastrar_pedido.php'><img src='../img/add.png'>Cadastrar Pedidos</a>
                <br>
                <a href='../login/logout.php'><img src='../img/logout.png''>Logout</a>";
            }
            ?>
            
            <br><br>
            <div class="table-responsive">
            <table border="1" class="table">
            <tr>
                <th>ID</th>
                <th>Bebida</th>
                <th>Quantidade</th>
                <th>Comida</th>
                <th>Quantidade</th>
                <th>Garçom</th>
                <th>Apagar</th>
            </tr>
                <?php 
                
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
               
                $sql = "SELECT p.id as id, b.descricao as bebida, qtd_bebida, r.descricao as refeicao, qtd_refeicao, nome
                        FROM pedido p
                        INNER JOIN bebida b ON p.cod_bebida = b.id
                        INNER JOIN refeicao r ON p.cod_refeicao = r.id
                        INNER JOIN usuario u ON p.cod_usuario = u.id
                        ORDER BY p.id";
                
                
                $retorno = $conexao->query($sql);
                
                //Erro de execução no SQL
                if ($retorno == false) 
                {
                    echo $conexao->error;
                }
                
                //Obtem cada registro do BD
                while ( $registro = $retorno->fetch_array()) 
                {
                    $id                = $registro["id"];
                    $bebida            = $registro["bebida"];
                    $qtd_bebida        = $registro["qtd_bebida"];
                    $refeicao          = $registro["refeicao"];
                    $qtd_refeicao      = $registro["qtd_refeicao"];
                    $nome              = $registro["nome"];
                    
                    //Colocando os registros na tabela
                    echo "
                         <tr>
                            <td>$id</td>
                            <td>$bebida</td>
                            <td>$qtd_bebida</td>
                            <td>$refeicao</td>
                            <td>$qtd_refeicao</td>
                            <td>$nome</td>
                            <td><a href='../pedido/apagar_pedido.php?id=$id'><img src='../img/delete.png'></a></td>
                         </tr>";
                }
                ?>   
            </table>
            </div>
        </center>
    </body>
</html>