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
            $consulta = pg_exec("select id, nombre, imagen from mostrar_cartas() where id='".$_GET['id']."';") or die("Consulta fallida");
            $contenido = pg_fetch_assoc($consulta);
            echo "<img src='".$contenido['imagen']."' width='300'>";
            echo "<p>ID ".$contenido['id']."</p>";
            echo "<p>Nombre ".$contenido['nombre']."</p>";
            echo "<p>Impresiones </p>";
            $estampados = pg_exec("select distinct estampado from mostrar_cartas() where id='".$_GET['id']."';") or die("Consulta fallida");
            while ($estampado = pg_fetch_assoc($estampados)) {
                echo $estampado['estampado']." ";
            }
            echo "<form action='add-carta-lista.php' method='post'>
                    <input type='hidden' name='idcarta' value='".$contenido['id']."'/>
                    <input type='submit' value='Agregar a una lista' id='hyperlink-style-button'/>
                </form>";
            echo "<form action='baraja/add-carta-baraja.php' method='post'>
                    <input type='hidden' name='idcarta' value='".$contenido['id']."'/>
                    <input type='submit' value='Agregar a una baraja' id='hyperlink-style-button'/>
                </form>";

        ?>
        </div>
        <a href="../user/explore.php">Volver</a>
</html>