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
    <h2>Borrar una carta</h2>
    <h2>PRECAUCI&Oacute;N La acci&oacute;n que esta a punto de realizar es irreversible</h2>
    <form action="borrar-carta-check.php" method="post">
        <div>
            <select name="carta">
                <?php 
                    $consulta = pg_exec("select * from mostrar_cartas()") or die("Consulta fallida");
                    while ($contenido = pg_fetch_assoc($consulta)) {
                        echo "<option value='".$contenido['id']."?".$contenido['idioma']."?".$contenido['estampado']."'>
                        ID: ".$contenido['id']." Nombre: ".$contenido['nombre']." 
                        Set: ".$contenido['nombreset']." 
                        Categoria: ".$contenido['nombrecategoria']." 
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
            <input type="submit" value="Borrar">
        </div>
    </form>
    <a href="../dashboard.php">Volver</a>
</html>