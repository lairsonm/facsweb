<?php
//Iniciando a sessão
session_start();

//Destruir a sessão
session_destroy();

//Redirecionando
header('Location: ../index.html');
?>