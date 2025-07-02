<script>
function correcto() {
    alert("El set ha sido eliminado correctamente");
    window.location.replace("../dashboard.php");
}
function no_hay_set() {
    alert("Primero debe crear un set para borrar");
    window.location.replace("../dashboard.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        pg_exec("select delete_set('".$_POST['set']."')") or die('Consulta fallida');
        echo "<script>correcto();</script>";
    } else {
        echo "<script>no_hay_set();</script>";
    }

?>