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
function caracteres_ilegales() {
    alert("No se pueden utilizar ciertos símbolos ingresados");
    // window.location.replace("ingresar-set.php");
    window.location.replace("perfil.php");
}
function ya_existe() {
    alert("Ya existe un usuario con estos datos");
    // window.location.replace("ingresar-carta.php");
    window.location.replace("perfil.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['nuevodato']) && strlen(trim($_POST['nuevodato'])) > 0){
            switch ($_POST['atributo']) {
                case 'correo':
                    $aux = str_replace("@","",$_POST['nuevodato']);
                    if (preg_match('/[#$%^*()+=\\[\]\';,\/{}|":<>?~\\\\]/', $aux) == 0) {
                        if (filter_var($_POST['nuevodato'], FILTER_VALIDATE_EMAIL)) {
                            $existe_usuario = pg_exec("select * from buscar_usuario_en_sistema('".$_SESSION['user_id']."','".$_POST['nuevodato']."','U')") or die('Consulta fallida');
                            if (pg_fetch_result($existe_usuario,'buscar_usuario_en_sistema') == '0') {
                                pg_exec("select modificar_atributos_usuario('".$_POST['nuevodato']."','".$_POST['atributo']."','".$_SESSION['user_id']."','".$_SESSION['correo']."','U')") or die('Consulta fallida');
                                echo "<script>correcto();</script>";
                            } else {
                                echo "<script>ya_existe();</script>";
                            }
                        } else {
                            echo "<script>email_invalido();</script>";
                        }
                    } else {
                        echo "<script>caracteres_ilegales();</script>";
                    }
                case 'nombreusuario':
                    if ((preg_match('/[#$%^*()+=\\[\]\';,.\/{}|":<>?~\\\\]/', $_POST['nuevodato'])) == 0) {
                        $existe_usuario = pg_exec("select * from buscar_usuario_en_sistema('".$_POST['nuevodato']."','".$_SESSION['correo']."','U')") or die('Consulta fallida');
                        if (pg_fetch_result($existe_usuario,'buscar_usuario_en_sistema') == '0') {
                            pg_exec("select modificar_atributos_usuario('".$_POST['nuevodato']."','".$_POST['atributo']."','".$_SESSION['user_id']."','".$_SESSION['correo']."','U')") or die('Consulta fallida');
                            echo "<script>correcto();</script>";
                        } else {
                            echo "<script>ya_existe();</script>";
                        }
                    } else {
                        echo "<script>caracteres_ilegales();</script>";
                    }
                default:
                    if ((preg_match('/[#$%^*()+=\\[\]\';,.\/{}|":<>?~\\\\]/', $_POST['nuevodato'])) == 0) {
                        pg_exec("select modificar_atributos_usuario('".$_POST['nuevodato']."','".$_POST['atributo']."','".$_SESSION['user_id']."','".$_SESSION['correo']."','U')") or die('Consulta fallida');
                        echo "<script>correcto();</script>";
                    } else {
                        echo "<script>caracteres_ilegales();</script>";
                    }
            }
        } else {
            echo "<script>espacios_vacios();</script>";
        }
    }

?>