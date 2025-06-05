<script>
function espacios_vacios() {
    alert("Debe ingresar un nuevo nombre válido");
    window.location.replace("dashboard.php");
}
</script>
<?php
    session_start();
    include_once('../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['nombrelista']) && strlen(trim($_POST['nombrelista'])) > 0){
        $consulta = pg_exec("select cambiar_nombre_lista(".$_POST['idlista'].",'".$_POST['nombrelista']."')") or die('Consulta fallida');
        header("Location: dashboard.php");
        } else {
            echo "<script>espacios_vacios();</script>";
        }
    }
?>