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
    
    
    <h3>Lista de ilustradores</h3>
    <?php
        $consulta = pg_exec("select * from mostrar_ilustradores()") or die('Consulta fallida');
        if (pg_num_rows($consulta)>0) {
            echo "<table>
                    <tr>
                        <th>Nombre</th>
                        <th>Redes sociales</th>
                        <th>Cantidad de cartas</th>
                        <th>Acciones</th>
                    </tr>";
            while ($contenido = pg_fetch_assoc($consulta)) {
            echo "<tr>
            <td>".$contenido['nombre']."</td>
            <td>".$contenido['rrss']."</td>
            <td>".$contenido['cantidadcartas']."</td>
            <td>
                    <form action='borrar-ilustrador-check.php' method='post'>
                        <input type='hidden' name='ilustrador' value='".$contenido['nombre']."'/>
                        <input type='submit' value='Borrar' id='hyperlink-style-button'/>
                    </form>
                </td>
                </tr>";
            }
            echo "</table>";
        } else {
            echo "No hay ilustradores registrados aun";
        }
    ?>
    <p>
    <a href="../dashboard.php">Volver</a>
    </p>
</html>