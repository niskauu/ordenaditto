<script>
function correcto() {
    alert("El usuario ha sido eliminado correctamente");
    // window.location.replace("../dashboard.php");
    history.back();
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        $usuario = explode('?',$_POST['usuario']);
        pg_exec("select delete_usuario('".$usuario[0]."','".$usuario[1]."','".$usuario[2]."')") or die('Consulta fallida');
        echo "<script>correcto();</script>";
    }

?>