

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
    Bienvenido 
    <?php 
        echo $_SESSION['name'];
        echo "<a href='perfil/perfil.php'><img src='".$_SESSION['avatar']."' width='30'></a>";
    ?>
        <div>
        <?php 
            $consulta = pg_exec("select id, nombre, imagen from mostrar_cartas() where id='".$_POST['idcarta']."';") or die("Consulta fallida");
            $contenido = pg_fetch_assoc($consulta);
            echo "<img src='".$contenido['imagen']."' width='300'>";
            echo "Agregando la carta con ID: ".$_POST['idcarta'];

            $estampados = pg_exec("select distinct estampado from mostrar_cartas() where id='".$_POST['idcarta']."';") or die("Consulta fallida");
            $estampados = pg_fetch_result($estampados,'estampado');
            echo "<form action='add-carta-baraja-check.php' method='post'>
            <input type='hidden' name='idcarta' value='".$_POST['idcarta']."'/>
            <input type='hidden' name='estampado' value='".$estampados."'/>";

            echo "Baraja: ";
            $barajas = pg_exec("select id,nombre from mostrar_barajas() where usuariobaraja='".$_SESSION['user_id']."';") or die("Consulta fallida");
            echo "<select name='idbaraja'>";
            while ($baraja = pg_fetch_assoc($barajas)) {
                echo "<option label='".$baraja['nombre']."'>".$baraja['id']."</option>";
            }
            echo "</select>";

            $idiomas = pg_exec("select distinct id, idioma from mostrar_cartas() where id='".$_POST['idcarta']."';") or die("Consulta fallida");
            $idiomas = pg_fetch_result($idiomas,'idioma');
            echo "<input type='hidden' name='idioma' value='".$idiomas."'>";
            if ( str_contains(strtolower($contenido['nombre']),'basic')) {
                echo "Cantidad: <input type='number' name='cantidad' min='1'>";
                echo "<input type='hidden' name='esenergia' value='1'/>";
            } else {
                echo "Cantidad: <input type='number' name='cantidad' min='1' max='4'>";
            }
            
            echo "<input type='submit' value='Agregar'>
            </form>";

        ?>
        </div>
        <a href="../explore.php">Volver</a>
</html>