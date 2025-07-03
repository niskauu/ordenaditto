<script>
function agregado() {
    alert("Se ha agregado la carta");
    window.location.replace("explore.php");
}
function no_hay_listas() {
    alert("Primero debe crear una lista para agregar cartas");
    // window.location.replace("dashboard.php");
    // history.back();
    history.go(-2);
}
function ya_existe() {
    alert("Ya existe esta carta en la lista seleccionada");
    // window.location.replace("dashboard.php");
    history.go(-2);
}
</script>
<?php
    session_start();
    include_once('../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['idlista'])){
            $existe_la_carta = pg_exec("select buscar_carta_en_lista('".$_POST['idcarta']."','".$_POST['estampado']."','".$_POST['idioma']."',".$_POST['idlista'].")");
            if (pg_fetch_result($existe_la_carta,'buscar_carta_en_lista') == '0') {
                $consulta = pg_exec("select insertar_carta_lista('".$_POST['idcarta']."','".$_POST['idlista']."','".$_POST['estampado']."','".$_POST['idioma']."')") or die('Consulta fallida');
                echo "<script>agregado();</script>";
            } else {
                echo "<script>ya_existe();</script>";
            }
        } else {
            echo "<script>no_hay_listas();</script>";
        }
    }
?>