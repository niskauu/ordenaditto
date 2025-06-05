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
        echo " <img src='".$_SESSION['avatar']."' width='30'>";
    ?>
    <form action='add-lista.php' method='post'>
        <input type='submit' value='Agregar nueva lista' id='hyperlink-style-button'/>
    </form>
    <form action='baraja/add-baraja.php' method='post'>
        <input type='submit' value='Agregar nueva baraja' id='hyperlink-style-button'/>
    </form>
    <h3>Listas de colecci&oacute;n</h3>
    <?php
        $consulta = pg_exec("select id, nombre, cantidadcartas from mostrar_listas() where usuariolista='".$_SESSION['user_id']."'") or die('Consulta fallida');
        if (pg_num_rows($consulta)>0) {
            echo "<table>
                    <tr>
                        <th>Nombre</th>
                        <th>Cantidad de cartas</th>
                        <th></th>
                    </tr>";
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
            <form action='borrar-lista-check.php' method='post'>
                <input type='hidden' name='idlista' value='".$contenido['id']."'/>
                <input type='submit' value='Borrar' id='hyperlink-style-button'/>
            </form>
            </td>";
            echo "</tr>
                </table>";
            }
        } else {
            echo "No tienes listas, crea una nueva";
        }
        
    ?>

    <h3>Barajas</h3>

    <?php
        $consulta = pg_exec("select id, nombre, cantidadcartas from mostrar_barajas() where usuariobaraja='".$_SESSION['user_id']."'") or die('Consulta fallida');
        if (pg_num_rows($consulta)>0) {
            echo "<table>
                    <tr>
                        <th>Nombre</th>
                        <th>Cantidad de cartas</th>
                        <th></th>
                    </tr>";
            while ($contenido = pg_fetch_assoc($consulta)) {
            echo "<tr>
            <td>".$contenido['nombre']."</td>
            <td>".$contenido['cantidadcartas']."</td>
            <td>
            <form action='baraja/visualizator-baraja.php' method='post'>
                <input type='hidden' name='idbaraja' value='".$contenido['id']."'/>
                <input type='submit' value='Visualizar' id='hyperlink-style-button'/>
            </form>
            <form action='baraja/editar-baraja.php' method='post'>
                <input type='hidden' name='idbaraja' value='".$contenido['id']."'/>
                <input type='submit' value='Editar' id='hyperlink-style-button'/>
            </form>
            <form action='baraja/borrar-baraja-check.php' method='post'>
                <input type='hidden' name='idbaraja' value='".$contenido['id']."'/>
                <input type='submit' value='Borrar' id='hyperlink-style-button'/>
            </form>
            </td>";
            echo "</tr>
                </table>";
            }
        } else {
            echo "No tienes barajas, crea una nueva";
        }
        
    ?>
    
</html>