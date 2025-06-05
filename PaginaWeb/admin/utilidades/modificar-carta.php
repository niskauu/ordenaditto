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
    <form action="modificar-carta-check.php" method="post">
        <div>
            <select name="carta">
                <?php 
                    $consulta = pg_exec("select * from mostrar_cartas()") or die("Consulta fallida");
                    while ($contenido = pg_fetch_assoc($consulta)) {
                        echo "<option value='".$contenido['id']."?".$contenido['idioma']."?".$contenido['estampado']."'>
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
            Atributo a modificar: 
            <select name="atributo">
                <option value='id'>ID</option>
                <option value='nombre'>Nombre</option>
                <option value='expansion'>Expansi&oacute;n</option>
                <option value='rareza'>Rareza</option>
                <option value='marcaregulacion'>Marca de Regulaci&oacute;n</option>
                <option value='ilustrador'>Ilustrador</option>
                <option value='imagen'>Imagen</option>
                <option value='idioma'>Idioma</option>
                <option value='estampado'>Estampado</option>
            </select>
            Nuevo dato:
            <input type="text" name="nuevodato">
            <input type="submit" value="Modificar">
        </div>
    </form>
    <div>
        <button onclick="location.href='modificar-coleccion-carta.php'">Modificar la colecci&oacute;n a la que pertenece una carta</button>
    </div>
    <a href="../dashboard.php">Volver</a>
</html>