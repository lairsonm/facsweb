<?php 
    session_start();
    //Verifica se o usuário está logado
    if ($_SESSION["logado"] != "ok"){
    header ('Location: ../login/index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Sidebar - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    
    <script src="js/menu.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        BarGod
                    </a>
                </li>
                <li>
                    <a onclick="listarbebidas();">Listagem de bebidas</a>
                </li>
                <li>
                    <a onclick="cadastrarbebidas();">Cadastro de bebidas</a>
                </li>
                <li>
                    <a onclick="listartipobebidas();">Listagem de bebidas</a>
                </li>
                <li>
                    <a onclick="cadasrartipobebidas();">Cadastrar tipos de bebidas</a>
                </li>
                <li>
                    <a onclick="listarrefeicao();">Listagem de refeições</a>
                </li>
                <li>
                    <a onclick="cadastrarrefeicao();">Cadastrar refeições</a>
                </li>
                <li>
                    <a onclick="listartiporefeicao();">Listagem tipos de refeições</a>
                </li>
                <li>
                    <a onclick="cadastrartiporefeicao();">Cadastrar tipos de refeições</a>
                </li>
                <li>
                    <a onclick="listarpedido();">Listagem de pedidos</a>
                </li>
                <li>
                    <a onclick="cadastrarpedido();">Cadastrar pedidos</a>
                </li>
                <li>
                    <a onclick="listarusuario();">Listar usuarios</a>
                </li>
                <li>
                    <a onclick="cadastrarusuario();">Cadastrar usuarios</a>
                </li>
                <li>
                    <a href="../login/logout.php">Logout</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Bem vindo ao acesso de administrador</h1>
                        <p>Clique no botão abaixo para abrir o menu</p>
                        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Ver Menu</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
        <div id="DisplayDiv">
        
        
        </div>

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>


    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
   

</body>

</html>
