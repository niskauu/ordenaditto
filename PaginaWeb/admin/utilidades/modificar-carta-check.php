<script>
function espacios_vacios() {
    alert("Debe ingresar un nuevo dato para modificar");
    // window.location.replace("../dashboard.php");
    history.back();
}
function correcto() {
    alert("La carta ha sido modificada exitosamente");
    // window.location.replace("../dashboard.php");
    history.back();
}
function no_hay_carta() {
    alert("Primero debe crear y seleccionar una carta para modificar");
    window.location.replace("../dashboard.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['carta'])) {
            if (isset($_POST['nuevodato']) && strlen(trim($_POST['nuevodato'])) > 0){
                $carta = explode('?',$_POST['carta']);
                pg_exec("select modificar_atributos_carta('".$_POST['nuevodato']."','".$_POST['atributo']."','".$carta[0]."','".$carta[1]."','".$carta[2]."')") or die('Consulta fallida');
                echo "<script>correcto();</script>";
            } else {
                echo "<script>espacios_vacios();</script>";
            }
        } else {
            echo "<script>no_hay_carta();</script>";
        }
    }

?>