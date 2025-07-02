<script>
function espacios_vacios() {
    alert("Debe ingresar un nuevo nombre válido");
    window.location.replace("ingresar-categoria.php");
}
function ya_existe() {
    alert("Esta categoria ya existe");
    window.location.replace("ingresar-categoria.php");
}
function correcto() {
    alert("Se ha ingresado la nueva categoria");
    window.location.replace("../dashboard.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['nombre']) && strlen(trim($_POST['nombre'])) > 0){
            $existe_la_categoria = pg_exec("select * from buscar_categoria('".$_POST['nombre']."')") or die('Consulta fallida');
            if (pg_fetch_result($existe_la_categoria,'buscar_categoria') == '0') {
                $consulta = pg_exec("select insertar_categoria('".strtolower($_POST['nombre'])."','".$_SESSION['user_id']."')") or die('Consulta fallida');
                echo "<script>correcto();</script>";
            } else {
                echo "<script>ya_existe();</script>";
            }
        } else {
            echo "<script>espacios_vacios();</script>";
        }
    }
?>