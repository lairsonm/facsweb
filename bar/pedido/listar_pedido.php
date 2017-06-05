<?php 
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
            
        <a href="../bebida/cadastrar_bebida.php"><img src="../img/add.png">Cadastrar Bebida</a>
        <a href="../bebida/listar_bebida.php"><img src="../img/add.png">Listar Bebida</a>
        <a href="../bebida/cadastrar_tipo_bebida.php"><img src="../img/add.png">Cadastrar Tipo de Bebida</a>
        <a href="../bebida/listar_tipo_bebida.php"><img src="../img/add.png">Listar Tipo de Bebida</a>
            <br>
        <a href="../refeicao/cadastrar_refeicao.php"><img src="../img/add.png">Cadastrar Refeição</a>
        <a href="../refeicao/listar_refeicao.php"><img src="../img/add.png">Listar Refeição</a>
        <a href="../refeicao/cadastrar_tipo_refeicao.php"><img src="../img/add.png">Cadastrar Tipo de Refeição</a>
        <a href="../refeicao/listar_tipo_refeicao.php"><img src="../img/add.png">Listar Tipo de Refeição</a>
            <br>
        <a href="../pedido/cadastrar_pedido.php"><img src="../img/add.png">Cadastrar Pedido</a>
        <a href="../pedido/listar_pedido.php"><img src="../img/add.png">Listar Pedido</a>
            <br>
        <a href="../usuario/cadastrar_usuario.php"><img src="../img/add.png">Cadastrar Usuário</a>
        <a href="../usuario/listar_usuario.php"><img src="../img/add.png">Listar Usuário</a>
            <br><br>
            
            <table border="1">
            <tr>
                <th>ID</th>
                <th>Bebida</th>
                <th>Quantidade</th>
                <th>Comida</th>
                <th>Quantidade</th>
                <th>Usuário</th>
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
                
                // Configurando delete
                if (isset($_GET['delete_id'])) {
                    // Recebe o valor do id da URL
                    $delete_id = (int) $_GET['delete_id'];

                    // Executa o delete
                    $sql_delete="DELETE FROM pedido WHERE id='$delete_id'";
                    $retorno_delete = $conexao->query($sql_delete);

                    // Verifica a execução do delete
                    if ($retorno_delete){
                    echo "<script>
                        alert('Excluído com Sucesso!');
                        location.href = 'listar_pedido.php';
                        </script>";
                    echo "<BR>";
                        } else {
                            echo "<script>
                            alert('Falha ao excluir!');
                            location.href = 'listar_pedido.php';
                            </script>";
                        }
                    }
                
                
                $sql = "SELECT p.id as id, b.descricao as bebida, qtd_bebida, r.descricao as refeicao, qtd_refeicao, nome
                        FROM pedido p
                        INNER JOIN bebida b ON p.cod_bebida = b.id
                        INNER JOIN refeicao r ON p.cod_refeicao = r.id
                        INNER JOIN usuario u ON p.cod_usuario = u.id";
                
                
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
                            <td><a onclick=\"return confirm('Deseja realmente apagar?');\" href=\"?delete_id={$id['id']}\"><img src='img/delete.png'></a></td>
                         </tr>";
                }
                ?>   
            </table>
        </center>
    </body>
</html>