<?php
    session_start();
    include_once('../php/conectar.php');
    if (! empty($_POST)) {
        $correo = pg_fetch_assoc(pg_exec("select correo from mostrar_usuarios() where nombreusuario='".$_SESSION['user_id']."'"));

        $consulta = pg_exec("select insertar_lista('".$_POST['nombrelista']."','".$_SESSION['user_id']."','".$correo['correo']."')") or die('Consulta fallida');
        header("Location: dashboard.php");
    }
?>