<script>
function borrado() {
    alert("Se ha borrado la carta");
    window.location.replace("../dashboard.php");
}
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
    if (! empty($_POST)) {
        $consulta = pg_exec("select borrar_carta_baraja('".$_POST['idcarta']."','".$_POST['estampadocarta']."','".$_POST['idiomacarta']."',".$_POST['idbaraja'].",".$_POST['cantidad'].")") or die('Consulta fallida');
        
        echo "<script>borrado();</script>";
    }
?>