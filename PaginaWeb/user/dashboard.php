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
    <a href="logout.php">Cerrar sesion</a>
    Bienvenido <?php echo $_SESSION['user_id']?>
    <form action='add-lista.php' method='post'>
        <input type='submit' value='Agregar nueva lista' id='hyperlink-style-button'/>
    </form>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Cantidad de cartas</th>
            <th></th>
        </tr>
    <?php
        $consulta = pg_exec("select id, nombre, cantidadcartas from mostrar_listas() where usuariolista='".$_SESSION['user_id']."'") or die('Consulta fallida');
        while ($contenido = pg_fetch_assoc($consulta)) {
            echo "<tr>
            <td>".$contenido['nombre']."</td>
            <td>".$contenido['cantidadcartas']."</td>
            <td>
            <form action='visualizator-lista.php' method='post'>
                <input type='hidden' name='idlista' value='".$contenido['id']."'/>
                <input type='submit' value='Visualizar' id='hyperlink-style-button'/>
            </form>
            <form action='editar-lista.php' method='post'>
                <input type='hidden' name='idlista' value='".$contenido['id']."'/>
                <input type='submit' value='Editar' id='hyperlink-style-button'/>
            </form>
            <form action='borrar-lista.php' method='post'>
                <input type='hidden' name='idlista' value='".$contenido['id']."'/>
                <input type='submit' value='Borrar' id='hyperlink-style-button'/>
            </form>
            </td>";
            echo "</tr>";
        }
    ?>
    </table>
</html>