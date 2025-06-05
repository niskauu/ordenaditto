<script>
function espacios_vacios() {
    alert("Debe ingresar un nuevo nombre válido");
    window.location.replace("../dashboard.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['nombrebaraja']) && strlen(trim($_POST['nombrebaraja'])) > 0){
        $consulta = pg_exec("select cambiar_nombre_baraja(".$_POST['idbaraja'].",'".$_POST['nombrebaraja']."')") or die('Consulta fallida');
        header("Location: ../dashboard.php");
        } else {
            echo "<script>espacios_vacios();</script>";
        }
    }
?>