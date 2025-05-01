<?php
    session_start();
    include_once('../php/conectar.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ordenaditto</title>
    </head>
    <h1>Ordenaditto</h1>
    <a href="dashboard.php">Inicio</a>
    <a href="explore.php">Explorar</a>
    <a href="logout.php">Cerrar sesion</a>
    Bienvenido <?php echo $_SESSION['user_id']?>
    <form action="add-lista-check.php" method="post">
        Nombre de la nueva lista: 
        <input type="text" name="nombrelista"/> 
        <input type="submit" value="Agregar"/>
    </form>

</html>