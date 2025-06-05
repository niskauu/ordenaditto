<?php 
    session_start();
    include_once('../php/conectar.php');
    if (isset($_SESSION["user_id"]))
        {
            if ($_SESSION['tipocuenta'] == 'U'){
                header("location: user/dashboard.php");
            } else {
                header("location: admin/dashboard.php");
            }
        }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ordenaditto</title>
    </head>
    <h1>Ordenaditto</h1>
    <a href="login.php">Iniciar sesi&oacute;n</a>
    <a href="register.php">Registrarse</a>
    <a href="guest/explore.php">Explorar</a>
</html>