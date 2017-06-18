    function listarbebidas() {
        $(function() {
            $('#DisplayDiv').load('../bebida/listar_bebida.php');
            return false;
        });
    }
    function cadastrarbebidas() {
        $(function() {
            $('#DisplayDiv').load('../bebida/cadastrar_bebida.php');
            return false;
        });
    }
    function editarBebidas(id) {
        $(function() {
            $('#DisplayDiv').load('../bebida/editar_bebida.php?id='+id);
            return false;
        });
    }
    function editarTipoBebidas(id) {
        $(function() {
            $('#DisplayDiv').load('../bebida/editar_tipo_bebida.php?id='+id);
            return false;
        });
    }
    function editarRefeicao(id) {
        $(function() {
            $('#DisplayDiv').load('../refeicao/editar_refeicao.php?id='+id);
            return false;
        });
    }
    function editarTipoRefeicao(id) {
        $(function() {
            $('#DisplayDiv').load('../refeicao/editar_tipo_refeicao.php?id='+id);
            return false;
        });
    }
    function editarUsuario(id) {
        $(function() {
            $('#DisplayDiv').load('../usuario/editar_usuario.php?id='+id);
            return false;
        });
    }
    function editarbebidas(id) {
        $(function() {
            $('#DisplayDiv').load('../bebida/editar_bebida.php?id='+id);
            return false;
        });
    }
    function listartipobebidas() {
        $(function() {
            $('#DisplayDiv').load('../bebida/listar_tipo_bebida.php');
            return false;
        });
    }
    function cadasrartipobebidas() {
        $(function() {
            $('#DisplayDiv').load('../bebida/cadastrar_tipo_bebida.php');
            return false;
        });
    }
    function listarrefeicao() {
        $(function() {
            $('#DisplayDiv').load('../refeicao/listar_refeicao.php');
            return false;
        });
    }
    function cadastrarrefeicao() {
        $(function() {
            $('#DisplayDiv').load('../refeicao/cadastrar_refeicao.php');
            return false;
        });
    }
    function listartiporefeicao() {
        $(function() {
            $('#DisplayDiv').load('../refeicao/listar_tipo_refeicao.php');
            return false;
        });
    }
    function cadastrartiporefeicao() {
        $(function() {
            $('#DisplayDiv').load('../refeicao/cadastrar_tipo_refeicao.php');
            return false;
        });
    }
    function listarpedido() {
        $(function() {
            $('#DisplayDiv').load('../pedido/listar_pedido.php');
            return false;
        });
    }
    function cadastrarpedido() {
        $(function() {
            $('#DisplayDiv').load('../pedido/cadastrar_pedido.php');
            return false;
        });
    }
    function listarusuario() {
        $(function() {
            $('#DisplayDiv').load('../usuario/listar_usuario.php');
            return false;
        });
    }
    function cadastrarusuario() {
        $(function() {
            $('#DisplayDiv').load('../usuario/cadastrar_usuario.php');
            return false;
        });
    }
    function logout() {
        $(function() {
            window.location.replace("../index.html");
            return false;
        });
    }
