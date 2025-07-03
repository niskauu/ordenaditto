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
                        Set: ".$contenido['nombreset']." 
                        Categor&iacute;a: ".$contenido['nombrecategoria']." 
                        Ilustrador: ".$contenido['nombreilustrador']." 
                        Serie: ".$contenido['nombreserie']."
                        Rareza: ".$contenido['rareza']." 
                        Marca de Regulaci&oacute;n: ".$contenido['marcaregulacion']." 
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
                <option value='rareza'>Rareza</option>
                <option value='marcaregulacion'>Marca de Regulaci&oacute;n</option>
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
        <button onclick="location.href='modificar-set-carta.php'">Modificar set al que pertenece una carta</button>
        <button onclick="location.href='modificar-ilustrador-carta.php'">Modificar ilustrador al que pertenece una carta</button>
        <button onclick="location.href='modificar-categoria-carta.php'">Modificar categor&iacute;a a la que pertenece una carta</button>
    </div>
    <a href="../dashboard.php">Volver</a>
</html>