<script>
function borrado() {
    alert("Se ha borrado la lista");
    window.location.replace("dashboard.php");
}
</script>
<?php
    session_start();
    include_once('../php/conectar.php');
    if (! empty($_POST)) {
        $consulta = pg_exec("select delete_lista('".$_POST['idlista']."')") or die('Consulta fallida');
        echo "<script>borrado();</script>";
    }
?>