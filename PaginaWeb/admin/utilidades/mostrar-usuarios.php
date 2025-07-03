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
    
    
    <h3>Lista de usuarios</h3>
    <?php
        $consulta = pg_exec("select * from mostrar_usuarios()") or die('Consulta fallida');
        if (pg_num_rows($consulta)>0) {
            echo "<table>
                    <tr>
                        <th>Nombre de usuario</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Avatar</th>
                        <th>Tipo de usuario</th>
                        <th>Acciones</th>
                    </tr>";
            while ($contenido = pg_fetch_assoc($consulta)) {
            echo "<tr>
            <td>".$contenido['nombreusuario']."</td>
            <td>".$contenido['nombrevisual']."</td>
            <td>".$contenido['correo']."</td>
            <td><img src='".$contenido['avatar']."' width='10'></td>
            <td>".$contenido['tipo']."</td>";
            if ($contenido['nombreusuario'] == $_SESSION['user_id'] && $contenido['tipo'] == 'A') {
                echo "";
            } else {
                echo "<td>
                        <form action='borrar-usuario-check.php' method='post'>
                            <input type='hidden' name='usuario' value='".$contenido['nombreusuario']."?".$contenido['correo']."?".$contenido['tipo']."'/>
                            <input type='submit' value='Borrar' id='hyperlink-style-button'/>
                        </form>
                    </td>
                    </tr>";
                // echo "</tr>";
                }
            }
            echo "</table>";
        } else {
            echo "No hay usuarios registrados aun";
        }
        
    ?>
    <a href="../dashboard.php">Volver</a>
    
</html>