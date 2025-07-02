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
        <div>
        <?php 
            $consulta = pg_exec("select id, nombre, imagen from mostrar_cartas() where id='".$_GET['id']."';") or die("Consulta fallida");
            $contenido = pg_fetch_assoc($consulta);
            echo "<img src='".$contenido['imagen']."' width='300'>";
            echo "<p>ID ".$contenido['id']."</p>";
            echo "<p>Nombre ".$contenido['nombre']."</p>";
            echo "<p>Impresiones </p>";
            $estampados = pg_exec("select distinct estampado from mostrar_cartas() where id='".$_GET['id']."';") or die("Consulta fallida");
            while ($estampado = pg_fetch_assoc($estampados)) {
                echo $estampado['estampado']." ";
            }
            echo "<form action='add-carta-lista.php' method='post'>
                    <input type='hidden' name='idcarta' value='".$contenido['id']."'/>
                    <input type='submit' value='Agregar a una lista' id='hyperlink-style-button'/>
                </form>";
            echo "<form action='baraja/add-carta-baraja.php' method='post'>
                    <input type='hidden' name='idcarta' value='".$contenido['id']."'/>
                    <input type='submit' value='Agregar a una baraja' id='hyperlink-style-button'/>
                </form>";

        ?>
        </div>

        <h2>Comentarios</h2>
        <div>
            <form action='insertar-comentario-check.php' method='post'>
                <textarea name="textarea" rows="5" cols="50"></textarea>
                <?php
                    $consulta = pg_exec("select nombreusuario, correo, tipo from mostrar_usuarios() where nombreusuario='".$_SESSION['user_id']."'");
                    $contenido = pg_fetch_assoc($consulta);
                    echo "<input type='hidden' name='nombreusuario' value='".$contenido['nombreusuario']."'/>
                          <input type='hidden' name='correo' value='".$contenido['correo']."'/>
                          <input type='hidden' name='tipo' value='".$contenido['tipo']."'/>
                          <input type='hidden' name='idcarta' value='".$_GET['id']."'/>";
                    $estampados = pg_exec("select distinct estampado from mostrar_cartas() where id='".$_GET['id']."';") or die("Consulta fallida");
                    $estampado = pg_fetch_assoc($estampados);
                    echo "<input type='hidden' name='estampado' value='".$estampado['estampado']."'/>";
                    $idiomas = pg_exec("select distinct idioma from mostrar_cartas() where id='".$_GET['id']."';") or die("Consulta fallida");
                    $idioma = pg_fetch_assoc($idiomas);
                    echo "<input type='hidden' name='idioma' value='".$idioma['idioma']."'/>";
                ?>
                <input type='submit' value='Comentar' id='hyperlink-style-button'/>
            </form>
        </div>
            
        <div>
            <?php
                $consulta = pg_exec("select * from mostrar_comentarios('".$_GET['id']."')");
                if (!pg_num_rows($consulta)) {
                echo "No hay comentarios";
                } else {
                    while ($contenido = pg_fetch_assoc($consulta)) {
                    $consulta_avatar = pg_exec("select avatar from mostrar_usuarios() where nombreusuario='".$contenido['nombreusuario']."'");
                    $avatar = pg_fetch_assoc($consulta_avatar);
                    echo "<img src='".$avatar['avatar']."' width='10'> <p>".$contenido['nombreusuario']." ".date('d-m-Y H:i', strtotime($contenido['fecha']))."</p>";
                    echo "<p>".$contenido['texto']."</p>";
                    if ($contenido['nombreusuario'] == $_SESSION['user_id']) {
                        echo "<form action='borrar-comentario-check.php' method='post'>
                            <input type='hidden' name='idcomentario' value='".$contenido['idcomentario']."'/>
                            <input type='submit' value='Borrar' id='hyperlink-style-button'/>
                        </form>";
                        echo "<form action='editar-comentario.php' method='post'>
                            <input type='hidden' name='idcomentario' value='".$contenido['idcomentario']."'/>
                            <input type='hidden' name='idcarta' value='".$_GET['id']."'/>
                            <input type='hidden' name='contenido' value='".$contenido['texto']."'/>
                            <input type='submit' value='Editar' id='hyperlink-style-button'/>
                        </form>";
                    }
                    }
                }
                
            ?>
        </div>
        <a href="../user/explore.php">Volver</a>
</html>