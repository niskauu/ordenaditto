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
    <h2>Modificar una carta</h2>
    <form action="modificar-coleccion-carta-check.php" method="post">
        <div>
            <select name="carta">
                <?php 
                    $consulta = pg_exec("select * from mostrar_cartas()") or die("Consulta fallida");
                    while ($contenido = pg_fetch_assoc($consulta)) {
                        echo "<option value='".$contenido['id']."?".$contenido['idioma']."?".$contenido['estampado']."?".$contenido['coleccion']."'>
                        ID: ".$contenido['id']." Nombre: ".$contenido['nombre']." 
                        Colecci&oacute;n: ".$contenido['coleccion']." 
                        Expansion: ".$contenido['expansion']." 
                        Rareza: ".$contenido['rareza']." 
                        Marca de Regulaci&oacute;n: ".$contenido['marcaregulacion']." 
                        Ilustrador: ".$contenido['ilustrador']." 
                        Imagen: ".$contenido['imagen']." 
                        Idioma: ".$contenido['idioma']." 
                        Estampado: ".$contenido['estampado']."</option>";
                    }
                ?>
            </select>
            Escoge la nueva colecci&oacute;n a la que pertenecer&aacute; esta carta: 
            <select name="coleccionnueva">
                <?php 
                    $consulta = pg_exec("select nombre from mostrar_colecciones()") or die("Consulta fallida");
                    while ($contenido = pg_fetch_assoc($consulta)) {
                        echo "<option value='".$contenido['nombre']."'>".ucwords($contenido['nombre'])."</option>";
                    }
                ?>
            <input type="submit" value="Modificar">
        </div>
    </form>
    <a href="modificar-carta.php">Volver</a>
</html>