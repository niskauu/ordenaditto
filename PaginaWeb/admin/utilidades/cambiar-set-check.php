<script>
function correcto() {
    alert("El set ha sido modificado correctamente");
    // window.location.replace("../dashboard.php");
    history.back();
}
function no_hay_series() {
    alert("Primero debe crear y seleccionar una serie para modificar");
    window.location.replace("../dashboard.php");
}
function no_hay_set() {
    alert("Primero debe crear y seleccionar un set para modificar");
    window.location.replace("../dashboard.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['set'])){
            if (isset($_POST['nuevaserie'])) {
                pg_exec("select modificar_atributos_set('".strtolower($_POST['nuevaserie'])."','nombreserie','".strtolower($_POST['set'])."')") or die('Consulta fallida');
                echo "<script>correcto();</script>";
            } else {
                echo "<script>no_hay_series();</script>";
            }
        } else {
            echo "<script>no_hay_set();</script>";
        }
    }

?>