<script>
function espacios_vacios() {
    alert("Debe ingresar un dato valido para modificar");
    // window.location.replace("../dashboard.php");
    history.go(-2);
}
function correcto() {
    alert("Los datos han sido modificados correctamente, se cerrara la sesion para cargar nuevos datos");
    window.location.replace("../logout.php");
    // history.back();
}
function email_invalido() {
    alert("Debe ingresar un correo electrónico valido");
    window.location.replace("perfil.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['nuevodato']) && strlen(trim($_POST['nuevodato'])) > 0){
            if ($_POST['atributo'] == 'correo') {
                if (filter_var($_POST['nuevodato'], FILTER_VALIDATE_EMAIL)) {
                    pg_exec("select modificar_atributos_usuario('".$_POST['nuevodato']."','".$_POST['atributo']."','".$_SESSION['user_id']."','".$_SESSION['correo']."','U')") or die('Consulta fallida');
                    echo "<script>correcto();</script>";
                } else {
                    echo "<script>email_invalido();</script>";
                }
            } else {
                pg_exec("select modificar_atributos_usuario('".$_POST['nuevodato']."','".$_POST['atributo']."','".$_SESSION['user_id']."','".$_SESSION['correo']."','U')") or die('Consulta fallida');
                echo "<script>correcto();</script>";
            }
        } else {
            echo "<script>espacios_vacios();</script>";
        }
    }

?>