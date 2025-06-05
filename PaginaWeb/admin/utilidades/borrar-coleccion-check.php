<script>
function correcto() {
    alert("La colección ha sido eliminada correctamente");
    window.location.replace("../dashboard.php");
}
function no_hay_colecciones() {
    alert("Primero debe crear una colección para borrar");
    window.location.replace("../dashboard.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        pg_exec("select delete_coleccion('".$_POST['coleccion']."')") or die('Consulta fallida');
        echo "<script>correcto();</script>";
    } else {
        echo "<script>no_hay_colecciones();</script>";
    }

?>