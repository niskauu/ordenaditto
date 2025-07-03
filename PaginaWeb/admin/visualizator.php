<script>
  // recargara la pagina en caso de eliminar comentarios  
    window.addEventListener( "pageshow", function ( event ) {
  var historyTraversal = event.persisted || 
                         ( typeof window.performance != "undefined" && 
                              window.performance.navigation.type === 2 );
  if ( historyTraversal ) {
    // Handle page restore.
    window.location.reload();
  }
});
</script>

<?php include_once('../php/conectar.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ordenaditto</title>
    </head>
    <h1>Ordenaditto</h1>
    <a href="dashboard.php">Inicio</a>
    <a href="explore.php">Explorar</a>
    <a href="logout.php">Cerrar sesi&oacute;n</a>
    Bienvenido ADMINISTRADOR
    <?php 
        echo $_SESSION['name'];
        echo " <img src='".$_SESSION['avatar']."' width='30'>";
    ?>
        <div>
        <?php 
            $consulta = pg_exec("select id, nombre, rareza, imagen from mostrar_cartas() where id='".$_GET['id']."';") or die("Consulta fallida");
            $contenido = pg_fetch_assoc($consulta);
            echo "<img src='".$contenido['imagen']."' width='300'>";
            echo "<p>ID ".$contenido['id']."</p>";
            echo "<p>Nombre ".$contenido['nombre']."</p>";
            echo "<p>Rareza ".$contenido['rareza']."</p>";
            echo "<p>Impresiones </p>";
            $estampados = pg_exec("select distinct estampado from mostrar_cartas() where id='".$_GET['id']."';") or die("Consulta fallida");
            while ($estampado = pg_fetch_assoc($estampados)) {
                echo $estampado['estampado']." ";
            }
        ?>
        </div>

        <h2>Comentarios</h2>
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
                    echo "<form action='utilidades/borrar-comentario-check.php' method='post'>
                            <input type='hidden' name='idcomentario' value='".$contenido['idcomentario']."'/>
                            <input type='submit' value='Borrar' id='hyperlink-style-button'/>
                        </form>";
                    }
                }
                
            ?>
        </div>
        <a href="javascript:history.back();">Volver</a>
</html>