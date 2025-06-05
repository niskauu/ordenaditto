<script>
function agregado() {
    alert("Se ha agregado la carta");
    window.location.replace("../dashboard.php");
}
function no_agregado() {
    alert("No se ha podido agregar la carta, se ha alcanzado el limite para esta copia en la baraja");
    window.location.replace("../dashboard.php");
}
function no_hay_barajas() {
    alert("Primero debe crear una baraja para agregar cartas");
    window.location.replace("dashboard.php");
}
function ya_existe() {
    alert("Ya existe esta carta en la lista seleccionada");
    window.location.replace("dashboard.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        if (isset($_POST['idbaraja'])){
            if ($_POST['esenergia'] == '1') {
                $consulta = pg_exec("select insertar_carta_baraja_energia('".$_POST['idcarta']."',".$_POST['idbaraja'].",'".$_POST['estampado']."','".$_POST['idioma']."',".$_POST['cantidad'].")");
            } else {
                $consulta = pg_exec("select insertar_carta_baraja_noenergia('".$_POST['idcarta']."',".$_POST['idbaraja'].",'".$_POST['estampado']."','".$_POST['idioma']."',".$_POST['cantidad'].")");
                if (pg_fetch_result($consulta,'insertar_carta_baraja_noenergia') == 1) {
                    echo "<script>agregado();</script>";
                } else {
                    echo "<script>no_agregado();</script>";
                } 
                echo "<script>agregado();</script>";
            }
        } else {
            echo "<script>no_hay_barajas();</script>";
        }
    }
?>