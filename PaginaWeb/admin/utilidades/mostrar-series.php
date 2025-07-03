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
    
    
    <h3>Lista de series</h3>
    <?php
        $consulta = pg_exec("select * from mostrar_series()") or die('Consulta fallida');
        if (pg_num_rows($consulta)>0) {
            echo "<table>
                    <tr>
                        <th>Nombre</th>
                        <th>Creado por</th>
                        <th>Fecha y hora de creacion</th>
                        <th>Acciones</th>
                    </tr>";
            while ($contenido = pg_fetch_assoc($consulta)) {
            echo "<tr>
            <td>".$contenido['nombre']."</td>
            <td>".$contenido['auditoriausuario']."</td>
            <td>".$contenido['auditoriafecha']."</td>
            <td>
                    <form action='borrar-serie-check.php' method='post'>
                        <input type='hidden' name='serie' value='".$contenido['nombre']."'/>
                        <input type='submit' value='Borrar' id='hyperlink-style-button'/>
                    </form>
                </td>
                </tr>";
            }
            echo "</table>";
        } else {
            echo "No hay series registradas aun";
        }
    ?>
    <p>
    <a href="../dashboard.php">Volver</a>
    </p>
</html>