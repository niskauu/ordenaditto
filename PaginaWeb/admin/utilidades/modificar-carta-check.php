<script>
function espacios_vacios() {
    alert("Debe ingresar un nuevo dato para modificar");
    // window.location.replace("../dashboard.php");
    history.back();
}
function correcto() {
    alert("La carta ha sido modificada exitosamente");
    // window.location.replace("../dashboard.php");
    history.back();
}
function no_hay_carta() {
    alert("Primero debe crear y seleccionar una carta para modificar");
    window.location.replace("../dashboard.php");
}
function ya_existe() {
    alert("Ya existe una carta con estos mismos datos");
    // window.location.replace("ingresar-carta.php");
    history.back();
}
function caracteres_ilegales() {
    alert("No se pueden utilizar ciertos símbolos ingresados");
    // window.location.replace("ingresar-set.php");
    history.back();
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['carta'])) {
            if (isset($_POST['nuevodato']) && strlen(trim($_POST['nuevodato'])) > 0){
                if (preg_match('/[#$%^*()+=\\[\]\';,.\/{}|":<>?~\\\\]/', $_POST['nuevodato']) == 0 or $_POST['atributo'] == 'imagen') {
                        switch ($_POST['atributo']) {
                            case 'estampado':
                                $carta = explode('?',$_POST['carta']);
                                $existe_la_carta = pg_exec("select * from buscar_carta_en_sistema('".$carta[0]."','".$_POST['nuevodato']."','".$carta[1]."')") or die('Consulta fallida');
                                if (pg_fetch_result($existe_la_carta,'buscar_carta_en_sistema') == '0') {
                                    pg_exec("select modificar_atributos_carta('".$_POST['nuevodato']."','".$_POST['atributo']."','".$carta[0]."','".$carta[1]."','".$carta[2]."')") or die('Consulta fallida');
                                    echo "<script>correcto();</script>";
                                } else {
                                    echo "<script>ya_existe();</script>";
                                }

                            case 'idioma':
                                $carta = explode('?',$_POST['carta']);
                                $existe_la_carta = pg_exec("select * from buscar_carta_en_sistema('".$carta[0]."','".$carta[2]."','".$_POST['nuevodato']."')") or die('Consulta fallida');
                                if (pg_fetch_result($existe_la_carta,'buscar_carta_en_sistema') == '0') {
                                    pg_exec("select modificar_atributos_carta('".$_POST['nuevodato']."','".$_POST['atributo']."','".$carta[0]."','".$carta[1]."','".$carta[2]."')") or die('Consulta fallida');
                                    echo "<script>correcto();</script>";
                                } else {
                                    echo "<script>ya_existe();</script>";
                                }
                            case 'id':
                                $carta = explode('?',$_POST['carta']);
                                $existe_la_carta = pg_exec("select * from buscar_carta_en_sistema('".$_POST['nuevodato']."','".$carta[2]."','".$carta[1]."')") or die('Consulta fallida');
                                if (pg_fetch_result($existe_la_carta,'buscar_carta_en_sistema') == '0') {
                                    pg_exec("select modificar_atributos_carta('".$_POST['nuevodato']."','".$_POST['atributo']."','".$carta[0]."','".$carta[1]."','".$carta[2]."')") or die('Consulta fallida');
                                    echo "<script>correcto();</script>";
                                } else {
                                    echo "<script>ya_existe();</script>";
                                }
                            default:
                                $carta = explode('?',$_POST['carta']);
                                pg_exec("select modificar_atributos_carta('".$_POST['nuevodato']."','".$_POST['atributo']."','".$carta[0]."','".$carta[1]."','".$carta[2]."')") or die('Consulta fallida');
                                echo "<script>correcto();</script>";
                        }
                } else {
                    echo "<script>caracteres_ilegales();</script>";
                }

            } else {
                echo "<script>espacios_vacios();</script>";
            }
        } else {
            echo "<script>no_hay_carta();</script>";
        }
    }

?>