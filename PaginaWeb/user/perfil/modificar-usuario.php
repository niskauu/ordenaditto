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
        echo "<form action='modificar-usuario-check.php' method='post'>
        <p>Nombre: <input type='text' name='nuevodato' value='".$_SESSION['name']."'></p>
        <input type='hidden' name='atributo' value='nombrevisual'>
        <input type='submit' value='Modificar nombre'>
        </form>";
        echo "<form action='modificar-usuario-check.php' method='post'>
        <p>Nombre: <input type='text' name='nuevodato' value='".$_SESSION['user_id']."'></p>
        <input type='hidden' name='atributo' value='nombreusuario'>
        <input type='submit' value='Modificar nombre de usuario'>
        </form>";
        echo "<form action='modificar-usuario-check.php' method='post'>
        <p>Nombre: <input type='text' name='nuevodato' value='".$_SESSION['correo']."'></p>
        <input type='hidden' name='atributo' value='correo'>
        <input type='submit' value='Modificar correo'>
        </form>";
    ?>
    <p><a href="javascript:history.back();">Volver</a></p>
</html>