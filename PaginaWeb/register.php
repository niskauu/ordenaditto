<!DOCTYPE html>
<html>
    <head>
        <title>Ordenaditto</title>
    </head>
    <h1>Ordenaditto</h1>
    <a href="login.php">Iniciar sesi&oacute;n</a>
    <a href="register.php">Registrarse</a> 
    <a href="guest/explore.php">Explorar</a>
    <h2>Registrarse</h2>
    <form action="register-check.php" method="post">
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
            <input type="submit" value="Registrarse">
        </div>
    </form>
    <a href="index.php">Volver</a>
</html>