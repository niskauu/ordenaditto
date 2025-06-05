<script>
function espacios_vacios() {
    alert("Debe ingresar un nuevo nombre válido");
    window.location.replace("ingresar-coleccion.php");
}
function ya_existe() {
    alert("Esta colección ya existe");
    window.location.replace("ingresar-coleccion.php");
}
function correcto() {
    alert("Se ha ingresado la nueva colección");
    window.location.replace("../dashboard.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['nombre']) && strlen(trim($_POST['nombre'])) > 0){
            $existe_la_coleccion = pg_exec("select * from buscar_coleccion('".$_POST['nombre']."')") or die('Consulta fallida');
            if (pg_fetch_result($existe_la_coleccion,'buscar_coleccion') == '0') {
                $consulta = pg_exec("select insertar_coleccion('".strtolower($_POST['nombre'])."','".$_SESSION['user_id']."')") or die('Consulta fallida');
                echo "<script>correcto();</script>";
            } else {
                echo "<script>ya_existe();</script>";
            }
        } else {
            echo "<script>espacios_vacios();</script>";
        }
    }
?>