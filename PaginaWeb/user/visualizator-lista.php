<?php
    session_start();
    include_once('../php/conectar.php');
?>
<?php session_start()?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ordenaditto</title>
    </head>
    <h1>Ordenaditto</h1>
    <a href="dashboard.php">Inicio</a>
    <a href="explore.php">Explorar</a>
    <a href="logout.php">Cerrar sesion</a>
    Bienvenido <?php echo $_SESSION['user_id']?>
        <div>
        <?php 
            $consulta = pg_exec("select * from mostrar_contenido_lista(".$_POST['idlista'].")") or die("Consulta fallida");
            if (!pg_num_rows($consulta)) {
                echo "lista vacia";
            } else {
                while ($contenido = pg_fetch_assoc($consulta)) {
                    echo "<b>".$contenido['nombre']."</b>";
                    echo "<b> ".$contenido['estampado']."</b>";
                    echo "<a href='visualizator.php?id=".$contenido['id']."'> <img src='".$contenido['imagen']."' width='200'> </a>";
                }
            }
        ?>
        </div>
</html>