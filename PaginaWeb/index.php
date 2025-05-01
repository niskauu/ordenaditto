<?php 
    session_start();
    include_once('../php/conectar.php');
    if (isset($_SESSION["user_id"]))
        {
           header("location: user/dashboard.php");
        }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ordenaditto</title>
    </head>
    <h1>Ordenaditto</h1>
    <a href="login.php">Iniciar sesion</a>
    <a href="register.php">Registrarse</a>
    <a href="guest/explore.php">Explorar</a>
</html>