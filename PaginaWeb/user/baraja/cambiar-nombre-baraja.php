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
        echo "<a href='perfil/perfil.php'><img src='".$_SESSION['avatar']."' width='30'></a>";
    ?>
    <form action="cambiar-nombre-baraja-check.php" method="post">
        <?php
        echo "<input type='hidden' name='idbaraja' value='".$_POST['idbaraja']."'/>"
        ?>
        Nuevo nombre para la baraja: 
        <input type="text" name="nombrebaraja"/> 
        <input type="submit" value="Editar"/>
    </form>
    <a href="../user/dashboard.php">Volver</a>
</html>