<script>
function espacios_vacios() {
    alert("Debe rellenar todos los campos con datos validos");
    // window.location.replace("ingresar-carta.php");
    history.back();
}
function ya_existe() {
    alert("Esta carta ya existe");
    // window.location.replace("ingresar-carta.php");
    history.back();
}
function correcto() {
    alert("Se ha ingresado la nueva carta");
    // window.location.replace("../dashboard.php");
    history.back();
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['id']) && strlen(trim($_POST['id'])) > 0 &&
            isset($_POST['nombre']) && strlen(trim($_POST['nombre'])) > 0 &&
            isset($_POST['set']) &&
            isset($_POST['categoria']) &&
            isset($_POST['rareza']) && strlen(trim($_POST['rareza'])) > 0 &&
            isset($_POST['marcaderegulacion']) && strlen(trim($_POST['marcaderegulacion'])) > 0 &&
            isset($_POST['ilustrador']) &&
            isset($_POST['imagen']) && strlen(trim($_POST['imagen'])) > 0 &&
            isset($_POST['idioma']) && strlen(trim($_POST['idioma'])) > 0 &&
            isset($_POST['estampado']) && strlen(trim($_POST['estampado'])) > 0){
            $existe_la_carta = pg_exec("select * from buscar_carta_en_sistema('".$_POST['id']."','".$_POST['estampado']."','".$_POST['idioma']."')") or die('Consulta fallida');
            if (pg_fetch_result($existe_la_carta,'buscar_carta_en_sistema') == '0') {
                $consulta = pg_exec("select insertar_carta('".strtolower($_POST['id'])."',
                '".strtolower($_POST['nombre'])."',
                '".strtolower($_POST['set'])."',
                '".strtolower($_POST['categoria'])."',
                '".strtolower($_POST['ilustrador'])."',
                '".strtolower($_POST['rareza'])."',
                '".strtolower($_POST['marcaderegulacion'])."',
                '".$_POST['imagen']."',
                '".strtolower($_POST['idioma'])."',
                '".strtolower($_POST['estampado'])."',
                '".$_SESSION['user_id']."')") or die('Consulta fallida');
                echo "<script>correcto();</script>";
            } else {
                echo "<script>ya_existe();</script>";
            }
        } else {
            echo "<script>espacios_vacios();</script>";
        }
    }
?>