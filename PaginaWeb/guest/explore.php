<?php include_once('../php/conectar.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ordenaditto</title>
        <style>
            .grid-container{
                clear: both;
            }
            .grid {
             /* border: 4px solid #444; */
             overflow: hidden;
             float: left;
             width: 200px;
             margin: 15px 27px;
             text-align: center;
          }
        </style>
    </head>
    <h1>Ordenaditto</h1>
    <a href="../login.php">Iniciar sesi&oacute;n</a>
    <a href="../register.php">Registrarse</a>
    <a href="explore.php">Explorar</a>
    <?php 
        $consulta = pg_exec("select distinct id, nombre, imagen from mostrar_cartas() order by id") or die("Consulta fallida");
        if (pg_num_rows($consulta)>0) {
            echo "<div class='grid-container'>";
            while ($contenido = pg_fetch_assoc($consulta)) {
                echo "<div class='grid'>";
                echo "<a href='visualizator.php?id=".$contenido['id']."'> <img src='".$contenido['imagen']."' width='200'> </a>";
                echo "<b>".$contenido['nombre']."</b> </div>";
            }
            echo "</div>";
        } else {
            echo "<p>No hay cartas en el sistema</p>";
        }
    ?>
    <a href="../index.php">Volver</a>
</html>