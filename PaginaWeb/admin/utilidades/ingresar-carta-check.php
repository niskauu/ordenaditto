<script>
function espacios_vacios() {
    alert("Debe rellenar todos los campos con datos validos");
    window.location.replace("ingresar-carta.php");
}
function ya_existe() {
    alert("Esta carta ya existe");
    window.location.replace("ingresar-carta.php");
}
function correcto() {
    alert("Se ha ingresado la nueva carta");
    window.location.replace("../dashboard.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['id']) && strlen(trim($_POST['id'])) > 0 &&
            isset($_POST['nombre']) && strlen(trim($_POST['nombre'])) > 0 &&
            isset($_POST['coleccion']) &&
            isset($_POST['expansion']) && strlen(trim($_POST['expansion'])) > 0 &&
            isset($_POST['rareza']) && strlen(trim($_POST['rareza'])) > 0 &&
            isset($_POST['marcaderegulacion']) && strlen(trim($_POST['marcaderegulacion'])) > 0 &&
            isset($_POST['ilustrador']) && strlen(trim($_POST['ilustrador'])) > 0 &&
            isset($_POST['imagen']) && strlen(trim($_POST['imagen'])) > 0 &&
            isset($_POST['idioma']) && strlen(trim($_POST['idioma'])) > 0 &&
            isset($_POST['estampado']) && strlen(trim($_POST['estampado'])) > 0){
            $existe_la_carta = pg_exec("select * from buscar_carta_en_sistema('".$_POST['id']."','".$_POST['estampado']."','".$_POST['idioma']."')") or die('Consulta fallida');
            if (pg_fetch_result($existe_la_carta,'buscar_carta_en_sistema') == '0') {
                $consulta = pg_exec("select insertar_carta('".strtolower($_POST['id'])."',
                '".strtolower($_POST['nombre'])."',
                '".strtolower($_POST['coleccion'])."',
                '".strtolower($_POST['expansion'])."',
                '".strtolower($_POST['rareza'])."',
                '".strtolower($_POST['marcaderegulacion'])."',
                '".strtolower($_POST['ilustrador'])."',
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