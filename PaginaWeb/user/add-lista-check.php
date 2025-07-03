<script>
function espacios_vacios() {
    alert("Debe ingresar un nombre válido");
    window.location.replace("dashboard.php");
    // history.back();
}
function correcto() {
    alert("Se ha creado la nueva lista");
    window.location.replace("dashboard.php");
    // history.back();
}
</script>
<?php
    session_start();
    include_once('../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['nombrelista']) && strlen(trim($_POST['nombrelista'])) > 0){
        $correo = pg_fetch_assoc(pg_exec("select correo from mostrar_usuarios() where nombreusuario='".$_SESSION['user_id']."'"));
        $tipo = pg_fetch_assoc(pg_exec("select tipo from mostrar_usuarios() where nombreusuario='".$_SESSION['user_id']."'"));
        $consulta = pg_exec("select insertar_lista('".$_POST['nombrelista']."','".$_SESSION['user_id']."','".$correo['correo']."','".$tipo['tipo']."')") or die('Consulta fallida');

        echo "<script>correcto()</script>";
        }
        else {
            echo "<script>espacios_vacios()</script>";
        }
    }
?>