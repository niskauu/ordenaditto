<script>
function correcto() {
    alert("La categoría ha sido eliminada correctamente");
    // window.location.replace("../dashboard.php");
    history.back();
}
function no_hay_categoria() {
    alert("Primero debe crear una categoría para borrar");
    window.location.replace("../dashboard.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        pg_exec("select delete_categoria('".$_POST['categoria']."')") or die('Consulta fallida');
        echo "<script>correcto();</script>";
    } else {
        echo "<script>no_hay_categoria();</script>";
    }

?>