<script>
function insertar() {
    alert("Se ha modificado el comentario");
    <?php
        echo "window.location.replace('visualizator.php?id=".$_POST['idcarta']."')";
    ?>
}
function espacios_vacios() {
    alert("Debe ingresar un comentario válido");
    <?php
        echo "window.location.replace('visualizator.php?id=".$_POST['idcarta']."')";
    ?>
}
</script>
<?php
    session_start();
    include_once('../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['contenido']) && strlen(trim($_POST['contenido'])) > 0){
        $consulta = pg_exec("select editar_comentario(".$_POST['idcomentario'].",'".$_POST['contenido']." (editado)')") or die('Consulta fallida');
        echo "<script>insertar();</script>";
        } else {
            echo "<script>espacios_vacios();</script>";
        }
    }
?>