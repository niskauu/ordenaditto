<script>
function espacios_vacios() {
    alert("Debe ingresar todos los datos solicitados");
    window.location.replace("register.php");
}
function no_coinciden() {
    alert("Las contraseñas ingresadas no coinciden");
    window.location.replace("register.php");
}
function correcto() {
    alert("Usuario registrado correctamente");
    window.location.replace("login.php");
}
function email_invalido() {
    alert("Debe ingresar un correo electrónico valido");
    window.location.replace("register.php");
}
function usuario_existe() {
    alert("Ya existe un usuario con este correo y usuario registrados");
    window.location.replace("register.php");
}
function caracteres_ilegales() {
    alert("No se pueden utilizar ciertos símbolos ingresados");
    // window.location.replace("ingresar-set.php");
    history.back();
}
</script>
<?php
    session_start();
    include_once('php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['username']) && isset($_POST['nombre'])
            && strlen(trim($_POST['username'])) > 0 && strlen(trim($_POST['nombre'])) > 0) {
            if (filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) {
                $aux = str_replace("@","",$_POST['correo']);
                if (preg_match('/[#$%^*()+=\\[\]\';,\/{}|":<>?~\\\\]/', $aux) == 0) {
                    if (preg_match('/[#$%^*()+=\\[\]\';,.\/{}|":<>?~\\\\]/', $_POST['username']) == 0 &&
                        preg_match('/[#$%^*()+=\\[\]\';,.\/{}|":<>?~\\\\]/', $_POST['nombre']) == 0) {
                        if (md5($_POST['pass1']) == md5($_POST['pass2'])) {
                            $existe_usuario = pg_exec("select * from buscar_usuario_en_sistema('".$_POST['username']."','".$_POST['correo']."','".$_POST['cuenta']."')") or die("Consulta fallida");
                            if (pg_fetch_result($existe_usuario,'buscar_usuario_en_sistema') == '0') {
                                pg_exec("select insertar_usuario('".$_POST['username']."','".$_POST['nombre']."','".$_POST['pass1']."','".$_POST['correo']."','https://files.catbox.moe/1pyo7f.png','U')") or die('Consulta fallida');
                                echo "<script>correcto();</script>";
                            } else {
                                echo "<script>usuario_existe();</script>";
                            }
                        } else {
                            echo "<script>no_coinciden();</script>";
                        }
                    } else {
                        echo "<script>caracteres_ilegales();</script>";
                    }
                } else {
                    echo "<script>email_invalido();</script>";
                }
            } else {
                echo "<script>email_invalido();</script>";
            }
                
        } else {
            echo "<script>espacios_vacios();</script>";
        }
    }

?>