<script>
function correcto() {
    alert("El ilustrador ha sido modificado correctamente");
    // window.location.replace("../dashboard.php");
    history.back();
}
function espacios_vacios() {
    alert("Debe ingresar un nuevo dato válido");
    // window.location.replace("../dashboard.php");
    history.back();
}
function no_hay_ilustrador() {
    alert("Primero debe crear y seleccionar un ilustrador para renombrar");
    window.location.replace("../dashboard.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['nuevorrss'])){
            if (isset($_POST['nuevorrss']) && strlen(trim($_POST['nuevorrss'])) > 0) {
                pg_exec("select modificar_atributos_ilustrador('".strtolower($_POST['nuevorrss'])."','rrss','".strtolower($_POST['ilustrador'])."')") or die('Consulta fallida');
                echo "<script>correcto();</script>";
            } else {
                echo "<script>espacios_vacios();</script>";
            }
        } else {
            echo "<script>no_hay_ilustrador();</script>";
        }
    }

?>