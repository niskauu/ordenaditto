<script>
function correcto() {
    alert("La colección ha sido renombrada correctamente");
    window.location.replace("../dashboard.php");
}
function espacios_vacios() {
    alert("Debe ingresar un nuevo nombre válido");
    window.location.replace("../dashboard.php");
}
function no_hay_colecciones() {
    alert("Primero debe crear y seleccionar una colección para renombrar");
    window.location.replace("../dashboard.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['coleccion'])){
            if (isset($_POST['nuevonombre']) && strlen(trim($_POST['nuevonombre'])) > 0) {
                pg_exec("select cambiar_nombre_coleccion('".$_POST['coleccion']."','".strtolower($_POST['nuevonombre'])."')") or die('Consulta fallida');
                echo "<script>correcto();</script>";
            } else {
                echo "<script>espacios_vacios();</script>";
            }
        } else {
            echo "<script>no_hay_colecciones();</script>";
        }
    }

?>