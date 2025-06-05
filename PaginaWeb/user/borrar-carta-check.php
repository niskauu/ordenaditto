<script>
function borrado() {
    alert("Se ha borrado la carta");
    window.location.replace("dashboard.php");
}
</script>
<?php
    session_start();
    include_once('../php/conectar.php');
    if (! empty($_POST)) {
        $consulta = pg_exec("select borrar_carta_lista('".$_POST['idcarta']."','".$_POST['estampadocarta']."','".$_POST['idiomacarta']."','".$_POST['idlista']."')") or die('Consulta fallida');
        
        echo "<script>borrado();</script>";
    }
?>