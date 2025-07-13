<script>
function correcto() {
    alert("La categoría ha sido renombrada correctamente");
    // window.location.replace("../dashboard.php");
    history.back();
}
function espacios_vacios() {
    alert("Debe ingresar un nuevo nombre válido");
    // window.location.replace("../dashboard.php");
    history.back();
}
function no_hay_categoria() {
    alert("Primero debe crear y seleccionar una categoría para renombrar");
    window.location.replace("../dashboard.php");
}
function mismo_nombre() {
    alert("El nombre escogido es el mismo, no se han realizado cambios");
    window.location.replace("../dashboard.php");
}
function ya_existe() {
    alert("Ya existe una categoría con este nombre");
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
       
        if (isset($_POST['categoria'])){
           
            if (isset($_POST['nuevonombre']) && strlen(trim($_POST['nuevonombre'])) > 0) {

                if (preg_match('/[#$%^*()+=\\[\]\';,.\/{}|":<>?~\\\\]/', $_POST['nuevonombre']) == 0) {

                    if ($_POST['nuevonombre'] != $_POST['categoria']){
                    
                        $existe_la_categoria = pg_exec("select * from buscar_categoria('".$_POST['nuevonombre']."')") or die('Consulta fallida');
                        if (pg_fetch_result($existe_la_categoria,'buscar_categoria') == '0'){
                            pg_exec("select cambiar_nombre_categoria('".$_POST['categoria']."','".strtolower($_POST['nuevonombre'])."')") or die('Consulta fallida');
                            echo "<script>correcto();</script>";
                   
                        } else {
                            echo "<script>ya_existe();</script>";
                        }
                
                    } else {
                        echo "<script>mismo_nombre();</script>";
                    }
                } else {
                    echo "<script>caracteres_ilegales()</script>";
                }
            } else {
                echo "<script>espacios_vacios();</script>";
            }
        
        } else {
            echo "<script>no_hay_categoria();</script>";
        }
    }

?>