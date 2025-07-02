<?php
    session_start();
    include_once('../../php/conectar.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ordenaditto</title>
    </head>
    <h1>Ordenaditto</h1>
    <a href="../dashboard.php">Inicio</a>
    <a href="../explore.php">Explorar</a>
    <a href="../logout.php">Cerrar sesi&oacute;n</a>
    Bienvenido ADMINISTRADOR
    <?php 
        echo $_SESSION['name'];
        echo " <img src='".$_SESSION['avatar']."' width='30'>";
    ?>
    <h2>Cambiar redes sociales ilustrador</h2>
    <form action="cambiar-rrss-check.php" method="post">
        <div>
            <select name="ilustrador">
                <?php 
                    $consulta = pg_exec("select nombre, rrss from mostrar_ilustradores()") or die("Consulta fallida");
                    while ($contenido = pg_fetch_assoc($consulta)) {
                        echo "<option value='".$contenido['nombre']."'>".ucwords($contenido['nombre'])."-".ucwords($contenido['rrss'])."</option>";
                    }
                ?>
            </select>
            Nuevo contacto de redes sociales: 
            <input type="text" name="nuevorrss">
            <input type="submit" value="Modificar">
        </div>
    </form>
    <a href="../dashboard.php">Volver</a>
</html>