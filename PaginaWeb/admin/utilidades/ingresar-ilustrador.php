<?php
    session_start();
    include_once('../../php/conectar.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ordenaditto</title>
    </head>
    <h1>Ordenaditto</h1>
    <a href="../dashboard.php">Inicio</a>
    <a href="../explore.php">Explorar</a>
    <a href="../logout.php">Cerrar sesi&oacute;n</a>
    Bienvenido ADMINISTRADOR
    <?php 
        echo $_SESSION['name'];
        echo " <img src='".$_SESSION['avatar']."' width='30'>";
    ?>
    <h2>Ingresar nuevo ilustrador</h2>
    <form action="ingresar-ilustrador-check.php" method="post">
        <div>
            Nombre
            <input type="text" name="nombre">
            RRSS
            <input type="text" name="rrss">
            <input type="submit" value="Registrar">
        </div>
    </form>
    <a href="../dashboard.php">Volver</a>
</html>