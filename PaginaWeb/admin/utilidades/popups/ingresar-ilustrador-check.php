<script>
function espacios_vacios() {
    alert("Debe ingresar datos válidos");
    window.location.replace("ingresar-ilustrador.php");
}
function ya_existe() {
    alert("Este ilustrador ya existe");
    window.location.replace("ingresar-ilustrador.php");
}
function correcto() {
    alert("Se ha ingresado el nuevo ilustrador");
    // window.location.replace("../dashboard.php");
    window.close();
}
function caracteres_ilegales() {
    alert("No se pueden utilizar ciertos símbolos ingresados");
    window.location.replace("ingresar-ilustrador.php");
}
</script>
<?php
    session_start();
    include_once('../../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['nombre']) && strlen(trim($_POST['nombre'])) > 0 &&
            isset($_POST['rrss']) && strlen(trim($_POST['rrss'])) > 0){
            if (preg_match('/[#$%^*()+=\\[\]\';,.\/{}|":<>?~\\\\]/', $_POST['nombre']) == 0 && preg_match('/[#$%^*()+=\\[\]\';,.\/{}|":<>?~\\\\]/', $_POST['rrss']) == 0) {    
                $existe_el_ilustrador = pg_exec("select * from buscar_ilustrador('".$_POST['nombre']."')") or die('Consulta fallida');
                if (pg_fetch_result($existe_el_ilustrador,'buscar_ilustrador') == '0') {
                    $consulta = pg_exec("select insertar_ilustrador('".strtolower($_POST['nombre'])."','".strtolower($_POST['rrss'])."','".$_SESSION['user_id']."')") or die('Consulta fallida');
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