<html>
    <head>
        <meta charset="utf-8">
        <title>Listagem de Usuários</title>
    </head>
    <body>
        <center>
            <h1>Listagem de Usuários</h1>
            
            <a href="cadastrar_usuario.php"><img src="img/add.png">Cadastrar Usuário</a>
            <br><br>
            
            <table border="1">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Editar</th>
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
                
                $sql = "SELECT *
                        FROM usuario";
                
                $retorno = $conexao->query($sql);
                
                //Erro de execução no SQL
                if ($retorno == false) 
                {
                    echo $conexao->error;
                }
                
                // Configurando delete
                if (isset($_GET['delete_id'])) {
                    // Recebe o valor do id da URL
                    $delete_id = (int) $_GET['delete_id'];

                    // Executa o delete
                    $sql_delete="DELETE FROM usuario WHERE id='$delete_id'";
                    $retorno_delete = $conexao->query($sql_delete);

                    // Verifica a execução do delete
                    if ($retorno_delete){
                    echo "<script>
                        alert('Excluído com Sucesso!');
                        location.href = 'listar_usuario.php';
                        </script>";
                    echo "<BR>";
                        } else {
                            echo "<script>
                            alert('Falha ao excluir!');
                            location.href = 'listar_usuario.php';
                            </script>";
                        }
                    }
                
                //Obtem cada registro do BD
                while ( $registro = $retorno->fetch_array()) 
                {
                    $id   = $registro["id"];
                    $nome = $registro["nome"];
                    
                    //Colocando os registros na tabela
                    echo "
                         <tr>
                            <td>$id</td>
                            <td>$nome</td>
                            <td><a href='editar_usuario.php?id=$id'><img src='img/edit.png'></a></td>
                            <td><a onclick=\"return confirm('Deseja realmente apagar?');\" href=\"?delete_id={$id['id']}\"><img src='img/delete.png'></a></td>
                         </tr>";
                }
                ?>
            <tr>
            </tr>    
            </table>
        </center>
    </body>
</html>