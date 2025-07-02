<script>
function espacios_vacios() {
    alert("Debe ingresar un nuevo dato para modificar");
    window.location.replace("../dashboard.php");
}
function correcto() {
    alert("La carta ha sido modificada exitosamente");
    window.location.replace("../dashboard.php");
}
function ya_pertenece() {
    alert("La carta ya pertenece al ilustrador seleccionado");
    window.location.replace("modificar-ilustrador-carta.php");
}
function no_existe_carta() {
    alert("Primero debe crear y seleccionar una carta para modificar");
    window.location.replace("modificar-ilustrador-carta.php");
}
function no_existe_ilustrador() {
    alert("Primero debe crear y seleccionar un ilustrador para modificar");
    window.location.replace("modificar-ilustrador-carta.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['ilustrador'])){
            $carta = explode('?',$_POST['carta']);
            if ($_POST['ilustrador'] != $carta[3]) {
                pg_exec("select modificar_atributos_carta('".$_POST['ilustrador']."','ilustrador','".$carta[0]."','".$carta[1]."','".$carta[2]."')") or die('Consulta fallida');
                echo "<script>correcto();</script>";
            } else {
                echo "<script>ya_pertenece();</script>";
            }
        } else {
            echo "<script>no_existe_ilustrador();</script>";
        }
    } else {
        echo "<script>no_existe_carta();</script>";
    }

?>