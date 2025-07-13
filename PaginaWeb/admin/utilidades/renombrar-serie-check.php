<script>
function correcto() {
    alert("La serie ha sido renombrada correctamente");
    // window.location.replace("../dashboard.php");
    history.back();
}
function espacios_vacios() {
    alert("Debe ingresar un nuevo nombre válido");
    // window.location.replace("../dashboard.php");
    history.back();
}
function no_hay_serie() {
    alert("Primero debe crear y seleccionar una serie para renombrar");
    window.location.replace("../dashboard.php");
}
function mismo_nombre() {
    alert("El nombre escogido es el mismo, no se han realizado cambios");
    window.location.replace("../dashboard.php");
}
function ya_existe() {
    alert("Ya existe una serie con este nombre");
    // window.location.replace("ingresar-serie.php");
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
       
        if (isset($_POST['serie'])){
           
            if (isset($_POST['nuevonombre']) && strlen(trim($_POST['nuevonombre'])) > 0) {

                if (preg_match('/[#$%^*()+=\\[\]\';,.\/{}|":<>?~\\\\]/', $_POST['nuevonombre']) == 0) {
                    
                    if ($_POST['nuevonombre'] != $_POST['serie']) {
                        
                        $existe_la_serie = pg_exec("select * from buscar_serie('".$_POST['nuevonombre']."')") or die('Consulta fallida');
                        if (pg_fetch_result($existe_la_serie,'buscar_serie') == '0') {
                            pg_exec("select cambiar_nombre_serie('".$_POST['serie']."','".strtolower($_POST['nuevonombre'])."')") or die('Consulta fallida');
                            echo "<script>correcto();</script>";
                        } else {
                            echo "<script>ya_existe();</script>";
                        }
                    
                    } else {
                        echo "<script>mismo_nombre();</script>";
                    }
                }else {
                    echo "<script>caracteres_ilegales()</script>";
                }
            
            } else {
                echo "<script>espacios_vacios();</script>";
            }
        
        } else {
            echo "<script>no_hay_serie();</script>";
        }
    }

?>