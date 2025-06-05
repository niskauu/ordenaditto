<?php include_once('../php/conectar.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ordenaditto</title>
    </head>
    <h1>Ordenaditto</h1>
    <a href="../login.php">Iniciar sesi&oacute;n</a>
    <a href="explore.php">Explorar</a>
        <div>
        <?php 
            $consulta = pg_exec("select id, nombre, rareza, imagen from mostrar_cartas() where id='".$_GET['id']."';") or die("Consulta fallida");
            $contenido = pg_fetch_assoc($consulta);
            echo "<img src='".$contenido['imagen']."' width='300'>";
            echo "<p>ID ".$contenido['id']."</p>";
            echo "<p>Nombre ".$contenido['nombre']."</p>";
            echo "<p>Rareza ".$contenido['rareza']."</p>";
            echo "<p>Impresiones </p>";
            $estampados = pg_exec("select distinct estampado from mostrar_cartas() where id='".$_GET['id']."';") or die("Consulta fallida");
            while ($estampado = pg_fetch_assoc($estampados)) {
                echo $estampado['estampado']." ";
            }

        ?>
        </div>
        <a href="../guest/explore.php">Volver</a>
</html>