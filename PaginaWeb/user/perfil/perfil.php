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
        echo "<a href='perfil.php'><img src='".$_SESSION['avatar']."' width='30'></a>";
    ?>

    <h3>Perfil</h3>
    <?php
        echo "<p>Nombre: ".$_SESSION['name']."</p>";
        echo "<p>Usuario: ".$_SESSION['user_id']."</p>";
        echo "<p>Correo: ".$_SESSION['correo']."</p>";
    ?>
    <form action="modificar-usuario.php" method='post'>
        <input type="submit" value="Modificar datos"/>
    </form>
    
</html>