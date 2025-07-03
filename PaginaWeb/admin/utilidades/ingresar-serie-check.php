<script>
function espacios_vacios() {
    alert("Debe ingresar un nuevo nombre válido");
    // window.location.replace("ingresar-serie.php");
    history.back();
}
function ya_existe() {
    alert("Esta serie ya existe");
    // window.location.replace("ingresar-serie.php");
    history.back();
}
function correcto() {
    alert("Se ha ingresado la nueva serie");
    // window.location.replace("../dashboard.php");
    history.back();
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['nombre']) && strlen(trim($_POST['nombre'])) > 0){
            $existe_la_serie = pg_exec("select * from buscar_serie('".$_POST['nombre']."')") or die('Consulta fallida');
            if (pg_fetch_result($existe_la_serie,'buscar_serie') == '0') {
                $consulta = pg_exec("select insertar_serie('".strtolower($_POST['nombre'])."','".$_SESSION['user_id']."')") or die('Consulta fallida');
                echo "<script>correcto();</script>";
            } else {
                echo "<script>ya_existe();</script>";
            }
        } else {
            echo "<script>espacios_vacios();</script>";
        }
    }
?>