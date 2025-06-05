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
    <h2>Borrar usuario</h2>
    <h2>PRECAUCI&Oacute;N La acci&oacute;n que esta a punto de realizar es irreversible</h2>
    <form action="borrar-usuario-check.php" method="post">
        <div>
            <select name="usuario">
                <?php 
                    $consulta = pg_exec("select nombreusuario, correo, tipo from mostrar_usuarios()") or die("Consulta fallida");
                    while ($contenido = pg_fetch_assoc($consulta)) {
                        echo "<option value='".$contenido['nombreusuario']."?".$contenido['correo']."?".$contenido['tipo']."'>Usuario: ".$contenido['nombreusuario']." Correo: ".$contenido['correo']." Tipo: ";
                        if ($contenido['tipo'] == 'U') {
                            echo "Usuario";
                        } else {
                            echo "Administrador";
                        }
                        echo "</option>";
                    }
                ?>
            </select>
            <input type="submit" value="Borrar">
        </div>
    </form>
    <a href="../dashboard.php">Volver</a>
</html>