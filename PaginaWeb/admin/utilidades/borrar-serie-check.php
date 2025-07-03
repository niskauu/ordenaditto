<script>
function correcto() {
    alert("La serie ha sido eliminada correctamente");
    // window.location.replace("../dashboard.php");
    history.back();
}
function no_hay_series() {
    alert("Primero debe crear una serie para borrar");
    window.location.replace("../dashboard.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        pg_exec("select delete_serie('".$_POST['serie']."')") or die('Consulta fallida');
        echo "<script>correcto();</script>";
    } else {
        echo "<script>no_hay_series();</script>";
    }

?>