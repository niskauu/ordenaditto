<?php
    session_start();
    include_once('../../php/conectar.php');
?>

<script>
function volver() {
    history.back();
}
</script>
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
    <h2>Editando comentario</h2>
    <form action="editar-comentario-check.php" method="post">
        <div>
            <?php
                echo "<input name=idcarta type=hidden value='".$_POST['idcarta']."'>
                      <input name=contenidooriginal type=hidden value='".$_POST['contenido']."'>
                      <textarea name='contenido' rows='5' cols='50'>".$_POST['contenido']."</textarea>
                      <input type='hidden' name='idcomentario' value='".$_POST['idcomentario']."'/>";
            ?>
            <input type="submit" value="Registrar cambios">
        </div>
    </form>
    <a href="javascript:history.back();">Volver</a>
</html>