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
        echo "<a href='perfil/perfil.php'><img src='".$_SESSION['avatar']."' width='30'></a>";
    ?>
        <div>
        <?php 
            $consulta = pg_exec("select id, nombre, imagen from mostrar_cartas() where id='".$_POST['idcarta']."';") or die("Consulta fallida");
            $contenido = pg_fetch_assoc($consulta);
            echo "<img src='".$contenido['imagen']."' width='300'>";
            echo "Agregando la carta con ID: ".$_POST['idcarta'];
            $estampados = pg_exec("select distinct estampado from mostrar_cartas() where id='".$_POST['idcarta']."';") or die("Consulta fallida");
            echo "Impresi&oacute;n: ";
            echo "<form action='add-carta-lista-check.php' method='post'>
            <input type='hidden' name='idcarta' value='".$_POST['idcarta']."'/>
            <select name='estampado'>";
            while ($estampado = pg_fetch_assoc($estampados)) {
                echo "<option>".$estampado['estampado']."</option>";
            }
            echo "</select>";
            echo "Lista: ";
            $listas = pg_exec("select id,nombre from mostrar_listas() where usuariolista='".$_SESSION['user_id']."';") or die("Consulta fallida");
            echo "<select name='idlista'>";
            while ($lista = pg_fetch_assoc($listas)) {
                echo "<option label='".$lista['nombre']."'>".$lista['id']."</option>";
            }
            echo "</select>";
            echo "Idioma: ";
            $idiomas = pg_exec("select distinct id, idioma from mostrar_cartas() where id='".$_POST['idcarta']."';") or die("Consulta fallida");
            echo "<select name='idioma'>";
            while ($idioma = pg_fetch_assoc($idiomas)) {
                echo "<option>".$idioma['idioma']."</option>";
            }
            echo "</select>
            <input type='submit' value='Agregar'>
            </form>";

        ?>
        </div>
        <a href="../user/explore.php">Volver</a>
</html>