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
    <h2>Ingresar nueva carta</h2>
    <form action="ingresar-carta-check.php" method="post">
        <div>
            ID: 
            <input type="text" name="id">
            Nombre: 
            <input type="text" name="nombre">
            Colecci&oacute;n:
            <select name="coleccion"> 
            <?php
                $consulta = pg_exec("select nombre from mostrar_colecciones();") or die('Consulta fallida');
                while ($contenido = pg_fetch_assoc($consulta)) {
                        echo "<option value='".$contenido['nombre']."'>".ucwords($contenido['nombre'])."</option>";
                    }
            ?>
            </select>
            Expansi&oacute;n: 
            <input type="text" name="expansion">
            Rareza: 
            <input type="text" name="rareza">
            Marca de regulaci&oacute;n: 
            <input type="text" name="marcaderegulacion">
            Ilustrador: 
            <input type="text" name="ilustrador">
            Imagen: 
            <input type="text" name="imagen">
            Idioma: 
            <input type="text" name="idioma">
            Estampado: 
            <input type="text" name="estampado">
            <input type="submit" value="Registrar">
        </div>
    </form>
    <a href="../dashboard.php">Volver</a>
</html>