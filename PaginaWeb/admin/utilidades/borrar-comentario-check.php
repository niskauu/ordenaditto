<script>
function borrado() {
    alert("Se ha borrado el comentario");
    // window.location.replace("dashboard.php");
    history.back();
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        $consulta = pg_exec("select delete_comentario(".$_POST['idcomentario'].")") or die('Consulta fallida');
        
        echo "<script>borrado();</script>";
    }
?>