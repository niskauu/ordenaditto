<script>
function correcto() {
    alert("La carta ha sido eliminada correctamente");
    window.location.replace("../dashboard.php");
}
function no_hay_cartas() {
    alert("Primero debe crear y seleccionar una carta para borrar");
    window.location.replace("../dashboard.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        $carta = explode('?',$_POST['carta']);
        pg_exec("select delete_carta('".$carta[0]."','".$carta[1]."','".$carta[2]."')") or die('Consulta fallida');
        echo "<script>correcto();</script>";
    } else {
        echo "<script>no_hay_cartas();</script>";
    }

?>