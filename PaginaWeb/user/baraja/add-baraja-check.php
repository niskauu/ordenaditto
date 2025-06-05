<script>
function espacios_vacios() {
    alert("Debe ingresar un nombre válido");
    window.location.replace("../dashboard.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['nombrebaraja']) && strlen(trim($_POST['nombrebaraja'])) > 0){
        $correo = pg_fetch_assoc(pg_exec("select correo from mostrar_usuarios() where nombreusuario='".$_SESSION['user_id']."'"));
        $tipo = pg_fetch_assoc(pg_exec("select tipo from mostrar_usuarios() where nombreusuario='".$_SESSION['user_id']."'"));
        $consulta = pg_exec("select insertar_baraja('".$_POST['nombrebaraja']."','".$_SESSION['user_id']."','".$correo['correo']."','".$tipo['tipo']."')") or die('Consulta fallida');

        header("Location: ../dashboard.php");
        }
        else {
            echo "<script>espacios_vacios()</script>";
        }
    }
?>