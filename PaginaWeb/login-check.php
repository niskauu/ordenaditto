<?php
    session_start();
    include_once('php/conectar.php');
    if (! empty($_POST)) {
        if (isset( $_POST['username'] ) && isset( $_POST['pass'] )) {
            $check = pg_exec("select mu.nombreusuario, clave from mostrar_usuarios() as mu, usuario where mu.nombreusuario='".$_POST['username']."'");
            if ($check) {
                if (pg_fetch_assoc($check)['clave'] == md5($_POST['pass'])) {
                    $_SESSION['user_id'] = $_POST['username'];
                    header("Location: user/dashboard.php");
                }
            }
        }
    }
?>