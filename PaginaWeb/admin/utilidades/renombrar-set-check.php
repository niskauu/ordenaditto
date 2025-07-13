<script>
function correcto() {
    alert("El set ha sido renombrado correctamente");
    // window.location.replace("../dashboard.php");
    history.back();
}
function espacios_vacios() {
    alert("Debe ingresar un nuevo nombre válido");
    // window.location.replace("../dashboard.php");
    history.back();
}
function no_hay_set() {
    alert("Primero debe crear y seleccionar un set para renombrar");
    window.location.replace("../dashboard.php");
}
function mismo_nombre() {
    alert("El nombre escogido es el mismo, no se han realizado cambios");
    window.location.replace("../dashboard.php");
}
function ya_existe() {
    alert("Ya existe un set con este nombre");
    // window.location.replace("ingresar-set.php");
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
      
        if (isset($_POST['set'])){
           
            if (isset($_POST['nuevonombre']) && strlen(trim($_POST['nuevonombre'])) > 0) {

                if (preg_match('/[#$%^*()+=\\[\]\';,.\/{}|":<>?~\\\\]/', $_POST['nuevonombre']) == 0) {

                    if ($_POST['nuevonombre'] != $_POST['set']) {
                        $existe_el_set = pg_exec("select * from buscar_set('".$_POST['nuevonombre']."')") or die('Consulta fallida');
                        if (pg_fetch_result($existe_el_set,'buscar_set') == '0') {
                            pg_exec("select cambiar_nombre_set('".$_POST['set']."','".strtolower($_POST['nuevonombre'])."')") or die('Consulta fallida');
                            echo "<script>correcto();</script>";
                        } else {
                            echo "<script>ya_existe();</script>";
                        }
                    
                    } else {
                        echo "<script>mismo_nombre();</script>";
                    }

                }else {
                    echo "<script>caracteres_ilegales();</script>";
                }
            
            } else {
                echo "<script>espacios_vacios();</script>";
            }
        
        } else {
            echo "<script>no_hay_set();</script>";
        }
    }

?>