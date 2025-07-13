<script>
function espacios_vacios() {
    alert("Debe ingresar un nuevo nombre válido");
    window.location.replace("ingresar-set.php");
}
function ya_existe() {
    alert("Este set ya existe");
    window.location.replace("ingresar-set.php");
}
function correcto() {
    alert("Se ha ingresado el nuevo set");
    // window.location.replace("../dashboard.php");
    window.close();
}
function serie_no_existe() {
    alert("Primero debe crear una serie");
    window.close();
}
function caracteres_ilegales() {
    alert("No se pueden utilizar ciertos símbolos ingresados");
    window.location.replace("ingresar-set.php");
}
</script>
<?php
    session_start();
    include_once('../../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['nombre']) && strlen(trim($_POST['nombre']) > 0)){
            if (preg_match('/[#$%^*()+=\\[\]\';,.\/{}|":<>?~\\\\]/', $_POST['nombre']) == 0) {
                $existe_el_set = pg_exec("select * from buscar_set('".$_POST['nombre']."')") or die('Consulta fallida');
                if (pg_fetch_result($existe_el_set,'buscar_set') == '0') {
                    if (isset($_POST['serie'])) {
                        $consulta = pg_exec("select insertar_set('".strtolower($_POST['nombre'])."','".strtolower($_POST['serie'])."','".$_SESSION['user_id']."')") or die('Consulta fallida');
                        echo "<script>correcto();</script>";
                    }else {
                        echo "<script>serie_no_existe();</script>";
                    }
                } else {
                    echo "<script>ya_existe();</script>";
                }
            } else {
                echo "<script>caracteres_ilegales();</script>";
            }
        } else {
            echo "<script>espacios_vacios();</script>";
        }
    }
?>