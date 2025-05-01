<?php
    session_start();
    include_once('../php/conectar.php');
    if (! empty($_POST)) {
        $consulta = pg_exec("select insertar_carta_lista('".$_POST['idcarta']."','".$_POST['idlista']."','".$_POST['estampado']."')") or die('Consulta fallida');
        header("Location: dashboard.php");
    }
?>