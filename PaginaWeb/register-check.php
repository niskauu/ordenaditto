<?php
    session_start();
    include_once('php/conectar.php');
    if (! empty($_POST)) {
        if (md5($_POST['pass1']) == md5($_POST['pass2'])) {
            pg_exec("select insertar_usuario('".$_POST['username']."','".$_POST['nombre']."','".md5($_POST['pass1'])."','".$_POST['correo']."','test','U')") or die('Consulta fallida');
            header("Location: index.php");
        }
    }
?>