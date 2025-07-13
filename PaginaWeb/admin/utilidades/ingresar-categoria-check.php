<script>
function espacios_vacios() {
    alert("Debe ingresar un nuevo nombre válido");
    // window.location.replace("ingresar-categoria.php");
    history.back();
}
function ya_existe() {
    alert("Esta categoría ya existe");
    // window.location.replace("ingresar-categoria.php");
    history.back();
}
function correcto() {
    alert("Se ha ingresado la nueva categoría");
    // window.location.replace("../dashboard.php");
    history.back();
}
function caracteres_ilegales() {
    alert("No se pueden utilizar ciertos símbolos ingresados");
    // window.location.replace("ingresar-set.php");
    history.back();
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['nombre']) && strlen(trim($_POST['nombre'])) > 0){
            if (preg_match('/[#$%^*()+=\\[\]\';,.\/{}|":<>?~\\\\]/', $_POST['nombre']) == 0) {
                $existe_la_categoria = pg_exec("select * from buscar_categoria('".$_POST['nombre']."')") or die('Consulta fallida');
                if (pg_fetch_result($existe_la_categoria,'buscar_categoria') == '0') {
                    $consulta = pg_exec("select insertar_categoria('".strtolower($_POST['nombre'])."','".$_SESSION['user_id']."')") or die('Consulta fallida');
                    echo "<script>correcto();</script>";
                } else {
                    echo "<script>ya_existe();</script>";
                }
            }else {
                echo "<script>caracteres_ilegales();</script>";
            }
        } else {
            echo "<script>espacios_vacios();</script>";
        }
    }
?>