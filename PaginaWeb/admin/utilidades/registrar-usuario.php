
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
    <h2>Registrar usuario</h2>
    <form action="register-usuario-check.php" method="post">
        <div>
            Nombre
            <input type="text" name="nombre">
            Nombre de usuario
            <input type="text" name="username">
            Correo
            <input type="text" name="correo">
            Contrase&ntilde;a
            <input type="password" name="pass1">
            Repetir contrase&ntilde;a
            <input type="password" name="pass2">
            Tipo de cuenta
            <select name="cuenta">
                <option value='U'>Usuario</option>
                <option value='A'>Administrador</option>
            </select>
            <input type="submit" value="Registrar">
        </div>
        <a href="../dashboard.php">Volver</a>
    </form>
</html>