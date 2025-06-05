<?php
    session_start();
    include_once('../../php/conectar.php');
?>
<?php session_start()?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ordenaditto</title>
    </head>
    <h1>Ordenaditto</h1>
    <a href="../dashboard.php">Inicio</a>
    <a href="../explore.php">Explorar</a>
    <a href="../logout.php">Cerrar sesi&oacute;n</a>
    Bienvenido 
    <?php 
        echo $_SESSION['name'];
        echo " <img src='".$_SESSION['avatar']."' width='30'>";
    ?>
    <?php 
    echo "<form action='cambiar-nombre-baraja.php' method='post'>
            <input type='hidden' name='idbaraja' value='".$_POST['idbaraja']."'/>
            <input type='submit' value='Editar nombre' id='hyperlink-style-button'/>
        </form>"
    ?>
        <div>
        <?php 
            $consulta = pg_exec("select * from mostrar_contenido_baraja(".$_POST['idbaraja'].")") or die("Consulta fallida");
            if (!pg_num_rows($consulta)) {
                echo "Baraja vac&iacute;a";
            } else {
                while ($contenido = pg_fetch_assoc($consulta)) {
                    echo "<b>".$contenido['cantidadcopias']."x ".$contenido['nombre']."</b>";
                    echo "<b> ".$contenido['marcaregulacion']."</b>";
                    echo "<a href='../visualizator.php?id=".$contenido['id']."'> <img src='".$contenido['imagen']."' width='200'> </a>";
                    echo "<form action='borrar-carta-baraja-check.php' method='post'>
                            <input type='hidden' name='idcarta' value='".$contenido['id']."'/>
                            <input type='hidden' name='estampadocarta' value='".$contenido['estampado']."'/>
                            <input type='hidden' name='idiomacarta' value='".$contenido['idioma']."'/>
                            <input type='hidden' name='idbaraja' value='".$_POST['idbaraja']."'/>
                            <input type='hidden' name='cantidad' value='".$contenido['cantidadcopias']."'/>
                            <input type='submit' value='Borrar todas las copias' id='hyperlink-style-button'/>
                        </form>";
                    echo "<form action='borrar-carta-baraja-check.php' method='post'>
                            <input type='hidden' name='idcarta' value='".$contenido['id']."'/>
                            <input type='hidden' name='estampadocarta' value='".$contenido['estampado']."'/>
                            <input type='hidden' name='idiomacarta' value='".$contenido['idioma']."'/>
                            <input type='hidden' name='idbaraja' value='".$_POST['idbaraja']."'/>
                            <input type='hidden' name='cantidad' value='1'/>
                            <input type='submit' value='Borrar 1 copia' id='hyperlink-style-button'/>
                        </form>";
                    echo "<form action='borrar-carta-baraja-check.php' method='post'>
                            <input type='hidden' name='idcarta' value='".$contenido['id']."'/>
                            <input type='hidden' name='estampadocarta' value='".$contenido['estampado']."'/>
                            <input type='hidden' name='idiomacarta' value='".$contenido['idioma']."'/>
                            <input type='hidden' name='idbaraja' value='".$_POST['idbaraja']."'/>
                            <input type='hidden' name='cantidad' value='2'/>
                            <input type='submit' value='Borrar 2 copias' id='hyperlink-style-button'/>
                        </form>";
                }
            }
        ?>
        </div>
        <a href="../dashboard.php">Volver</a>
</html>