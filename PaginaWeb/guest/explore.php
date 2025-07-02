<?php include_once('../php/conectar.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ordenaditto</title>
    </head>
    <h1>Ordenaditto</h1>
    <a href="../login.php">Iniciar sesi&oacute;n</a>
    <a href="../register.php">Registrarse</a>
    <a href="explore.php">Explorar</a>
        <div>
        <?php 
            $consulta = pg_exec("select distinct id, nombre, imagen from mostrar_cartas() order by id") or die("Consulta fallida");
            while ($contenido = pg_fetch_assoc($consulta)) {
                echo "<b>".$contenido['nombre']."</b>";
                echo "<a href='visualizator.php?id=".$contenido['id']."'> <img src='".$contenido['imagen']."' width='200'> </a>";
            }
        ?>
        </div>
        <a href="../index.php">Volver</a>
</html>