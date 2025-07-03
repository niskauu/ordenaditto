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
    <a href="logout.php">Cerrar sesi&oacute;n</a>
    Bienvenido 
    <?php 
        echo $_SESSION['name'];
        echo "<a href='perfil/perfil.php'><img src='".$_SESSION['avatar']."' width='30'></a>";
    ?>
        <div>
        <?php 
            $consulta = pg_exec("select * from mostrar_contenido_lista(".$_POST['idlista'].")") or die("Consulta fallida");
            if (!pg_num_rows($consulta)) {
                echo "Lista vac&iacute;a";
            } else {
                while ($contenido = pg_fetch_assoc($consulta)) {
                    echo "<b>".$contenido['nombre']."</b>";
                    echo "<b> ".$contenido['estampado']."</b>";
                    echo "<b> ".$contenido['idioma']."</b>";
                    echo "<a href='visualizator.php?id=".$contenido['id']."'> <img src='".$contenido['imagen']."' width='200'> </a>";
                }
            }
        ?>
        </div>
        <a href="../user/dashboard.php">Volver</a>
</html>