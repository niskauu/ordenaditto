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
    <h2>Modificar la serie a la que pertenece un set</h2>
    <form action="cambiar-set-check.php" method="post">
        <div>
            Set
            <select name="set">
                <?php 
                    $consulta = pg_exec("select nombre, nombreserie from mostrar_sets()") or die("Consulta fallida");
                    while ($contenido = pg_fetch_assoc($consulta)) {
                        echo "<option value='".$contenido['nombre']."'>".ucwords($contenido['nombre'])."-".ucwords($contenido['nombreserie'])."</option>";
                    }
                ?>
            </select>
            Nueva serie
            <select name="nuevaserie">
                <?php 
                    $consulta = pg_exec("select nombre from mostrar_series()") or die("Consulta fallida");
                    while ($contenido = pg_fetch_assoc($consulta)) {
                        echo "<option value='".$contenido['nombre']."'>".ucwords($contenido['nombre'])."</option>";
                    }
                ?>
            </select>
            <input type="submit" value="Modificar">
        </div>
    </form>
    <a href="javascript:history.back();">Volver</a>
</html>