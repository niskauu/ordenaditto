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
function ya_pertenece() {
    alert("La carta ya pertenece a la categoría seleccionada");
    // window.location.replace("modificar-categoria-carta.php");
    history.back();
}
function no_existe_carta() {
    alert("Primero debe crear y seleccionar una carta para modificar");
    window.location.replace("modificar-categoria-carta.php");
    
}
function no_existe_categoria() {
    alert("Primero debe crear y seleccionar una categoría para modificar");
    window.location.replace("modificar-categoria-carta.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['categoria'])){
            $carta = explode('?',$_POST['carta']);
            if ($_POST['categoria'] != $carta[3]) {
                pg_exec("select modificar_atributos_carta('".$_POST['categoria']."','categoria','".$carta[0]."','".$carta[1]."','".$carta[2]."')") or die('Consulta fallida');
                echo "<script>correcto();</script>";
            } else {
                echo "<script>ya_pertenece();</script>";
            }
        } else {
            echo "<script>no_existe_categoria();</script>";
        }
    } else {
        echo "<script>no_existe_carta();</script>";
    }

?>