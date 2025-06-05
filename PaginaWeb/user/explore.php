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
        echo " <img src='".$_SESSION['avatar']."' width='30'>";
    ?>
        <div>
        <?php 
            $consulta = pg_exec("select distinct id, nombre, imagen from mostrar_cartas() order by id") or die("Consulta fallida");
            while ($contenido = pg_fetch_assoc($consulta)) {
                echo "<b>".$contenido['nombre']."</b>";
                echo "<a href='visualizator.php?id=".$contenido['id']."'> <img src='".$contenido['imagen']."' width='200'> </a>";
            }
        ?>
        </div>
        <a href="../user/dashboard.php">Volver</a>
</html>