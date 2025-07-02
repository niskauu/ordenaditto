<script>
function insertar() {
    alert("Se ha ingresado el comentario");
    // window.location.replace("dashboard.php");
    history.back();
}
function espacios_vacios() {
    alert("Debe ingresar un comentario válido");
    history.back();
}
</script>
<?php
    session_start();
    include_once('../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['textarea']) && strlen(trim($_POST['textarea'])) > 0){
            $consulta = pg_exec("select insertar_comentario('".$_POST['textarea']."','".$_POST['nombreusuario']."','".$_POST['correo']."','".$_POST['tipo']."','".$_POST['idcarta']."','".$_POST['idioma']."','".$_POST['estampado']."')") or die('Consulta fallida');
        echo "<script>insertar();</script>";
        } else {
            echo "<script>espacios_vacios();</script>";
        }
    }
?>