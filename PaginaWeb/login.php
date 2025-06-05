<!DOCTYPE html>
<html>
    <head>
        <title>Ordenaditto</title>
    </head>
    <h1>Ordenaditto</h1>
    <a href="login.php">Iniciar sesi&oacute;n</a>
    <a href="register.php">Registrarse</a> 
    <a href="guest/explore.php">Explorar</a>
    <h2>Iniciar sesi&oacute;n</h2>
    <form action="login-check.php" method="post">
        <div>
            Usuario
            <input type="text" name="username">
            Contrase&ntilde;a
            <input type="password" name="pass">
            Cuenta
            <select name="cuenta">
                <option value="U">Usuario</option>
                <option value="A">Administrador</option>
            </select>
            <input type="submit" value="Iniciar sesi&oacute;n">
        </div>
    </form>
    <a href="index.php">Volver</a>
</html>