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
    <a href="logout.php">Cerrar sesi&oacute;n</a>
    Bienvenido 
    <?php 
        echo $_SESSION['name'];
        echo "<a href='perfil/perfil.php'><img src='".$_SESSION['avatar']."' width='30'></a>";
    ?>
    <form action="cambiar-nombre-lista-check.php" method="post">
        <?php
        echo "<input type='hidden' name='idlista' value='".$_POST['idlista']."'/>"
        ?>
        Nuevo nombre para la lista: 
        <input type="text" name="nombrelista"/> 
        <input type="submit" value="Editar"/>
    </form>
    <a href="../user/dashboard.php">Volver</a>
</html>