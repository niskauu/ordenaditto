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
    Bienvenido 
    <?php 
        echo $_SESSION['name'];
        echo " <img src='".$_SESSION['avatar']."' width='30'>";
    ?>
    <form action="add-baraja-check.php" method="post">
        Nombre de la nueva baraja: 
        <input type="text" name="nombrebaraja"/> 
        <input type="submit" value="Agregar"/>
    </form>
    <a href="../dashboard.php">Volver</a>

</html>