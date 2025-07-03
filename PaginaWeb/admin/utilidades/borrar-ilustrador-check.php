<script>
function correcto() {
    alert("El ilustrador ha sido eliminado correctamente");
    // window.location.replace("../dashboard.php");
    history.back();
}
function no_hay_ilustrador() {
    alert("Primero debe crear un ilustrador para borrar");
    window.location.replace("../dashboard.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        pg_exec("select delete_ilustrador('".$_POST['ilustrador']."')") or die('Consulta fallida');
        echo "<script>correcto();</script>";
    } else {
        echo "<script>no_hay_ilustrador();</script>";
    }

?>