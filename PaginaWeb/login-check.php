<script>
function espacios_vacios() {
    alert("Debe ingresar un usuario o contraseña");
    window.location.replace("login.php");
}
function datos_incorrectos() {
    alert("Credenciales incorrectas");
    window.location.replace("login.php");
}
function no_existe() {
    alert("El usuario ingresado no existe");
    window.location.replace("login.php");
}
</script>
<?php
    session_start();
    include_once('php/conectar.php');
    if (! empty($_POST)) {
        if (isset( $_POST['username'] ) && isset( $_POST['pass'] ) && strlen(trim($_POST['username'])) > 0 && strlen(trim($_POST['pass'])) > 0) {
            switch ($_POST['cuenta']) {
                case 'U':
                    $check = pg_exec("select mu.nombreusuario, mu.nombrevisual, mu.avatar, u.clave, mu.tipo from mostrar_usuarios() as mu, usuario as u 
                    where mu.nombreusuario='".$_POST['username']."' and u.nombreusuario='".$_POST['username']."' and mu.tipo='".$_POST['cuenta']."' and u.tipo='".$_POST['cuenta']."'");
                    if (pg_num_rows($check)>0) {
                        if (pg_fetch_result($check,'clave') == md5($_POST['pass'])) {
                            $_SESSION['user_id'] = $_POST['username'];
                            $_SESSION['name'] = pg_fetch_result($check,0,'nombrevisual');
                            $_SESSION['avatar'] = pg_fetch_result($check,0,'avatar');
                            $_SESSION['tipocuenta'] = 'U';
                            header("Location: user/dashboard.php");
                        } else {
                            echo "<script>datos_incorrectos();</script>";
                        }
                    } else {
                        echo "<script>no_existe();</script>";
                    }
                    break;
                case 'A':
                    $check = pg_exec("select mu.nombreusuario, mu.nombrevisual, mu.avatar, u.clave, mu.tipo from mostrar_usuarios() as mu, usuario as u 
                    where mu.nombreusuario='".$_POST['username']."' and u.nombreusuario='".$_POST['username']."' and mu.tipo='".$_POST['cuenta']."' and u.tipo='".$_POST['cuenta']."'");
                    if (pg_num_rows($check)>0) {
                        if (pg_fetch_result($check,'clave') == md5($_POST['pass'])) {
                            $_SESSION['user_id'] = $_POST['username'];
                            $_SESSION['name'] = pg_fetch_result($check,0,'nombrevisual');
                            $_SESSION['avatar'] = pg_fetch_result($check,0,'avatar');
                            $_SESSION['tipocuenta'] = 'A';
                            header("Location: admin/dashboard.php");
                        } else {
                            echo "<script>datos_incorrectos();</script>";
                        }
                    } else {
                        echo "<script>no_existe();</script>";
                    }
                    break;
                default:
                    echo "Como llegaste aqui?";
            }
        } else {
            echo "<script>espacios_vacios();</script>";
        }
    }
?>
