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
    alert("La carta ya pertenece a la colección seleccionada");
    window.location.replace("modificar-coleccion-carta.php");
}
function no_existe_carta() {
    alert("Primero debe crear y seleccionar una carta para modificar");
    window.location.replace("modificar-coleccion-carta.php");
}
function no_existe_coleccion() {
    alert("Primero debe crear y seleccionar una carta para modificar");
    window.location.replace("modificar-coleccion-carta.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['coleccionnueva'])){
            $carta = explode('?',$_POST['carta']);
            if ($_POST['coleccionnueva'] != $carta[3]) {
                pg_exec("select modificar_atributos_carta('".$_POST['coleccionnueva']."','coleccion','".$carta[0]."','".$carta[1]."','".$carta[2]."')") or die('Consulta fallida');
                echo "<script>correcto();</script>";
            } else {
                echo "<script>ya_pertenece();</script>";
            }
        } else {
            echo "<script>no_existe_coleccion();</script>";
        }
    } else {
        echo "<script>no_existe_carta();</script>";
    }

?>