<script>
function correcto() {
    alert("La categoría ha sido renombrada correctamente");
    // window.location.replace("../dashboard.php");
    history.back();
}
function espacios_vacios() {
    alert("Debe ingresar un nuevo nombre válido");
    // window.location.replace("../dashboard.php");
    history.back();
}
function no_hay_categoria() {
    alert("Primero debe crear y seleccionar una categoría para renombrar");
    window.location.replace("../dashboard.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['categoria'])){
            if (isset($_POST['nuevonombre']) && strlen(trim($_POST['nuevonombre'])) > 0) {
                pg_exec("select cambiar_nombre_categoria('".$_POST['categoria']."','".strtolower($_POST['nuevonombre'])."')") or die('Consulta fallida');
                echo "<script>correcto();</script>";
            } else {
                echo "<script>espacios_vacios();</script>";
            }
        } else {
            echo "<script>no_hay_categoria();</script>";
        }
    }

?>