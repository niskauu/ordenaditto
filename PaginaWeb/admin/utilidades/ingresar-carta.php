<script>
    function openPopupSet(){
        var popupSet = window.open("popups/ingresar-set.php","Agregar set","width=800,height=600,resizable=no,scrollbars=no");
        var intervalo = setInterval(function() {
                if (popupSet.closed) {
                    clearInterval(intervalo);
                    // Recarga la página principal cuando se cierra la ventana emergente
                    window.location.reload();
                }
            }, 500);
    };
    function openPopupCategoria(){
        var popupCategoria = window.open("popups/ingresar-categoria.php","Agregar categoría","width=800,height=600,resizable=no,scrollbars=no");
        var intervalo = setInterval(function() {
                if (popupCategoria.closed) {
                    clearInterval(intervalo);
                    // Recarga la página principal cuando se cierra la ventana emergente
                    window.location.reload();
                }
            }, 500);
    };
    function openPopupIlustrador(){
        var popupIlustrador = window.open("popups/ingresar-ilustrador.php","Agregar ilustrador","width=800,height=600,resizable=no,scrollbars=no");
        var intervalo = setInterval(function() {
                if (popupIlustrador.closed) {
                    clearInterval(intervalo);
                    // Recarga la página principal cuando se cierra la ventana emergente
                    window.location.reload();
                }
            }, 500);
    };
</script>
<?php
    session_start();
    include_once('../../php/conectar.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ordenaditto</title>
    </head>
    <h1>Ordenaditto</h1>
    <a href="../dashboard.php">Inicio</a>
    <a href="../explore.php">Explorar</a>
    <a href="../logout.php">Cerrar sesi&oacute;n</a>
    Bienvenido ADMINISTRADOR
    <?php 
        echo $_SESSION['name'];
        echo " <img src='".$_SESSION['avatar']."' width='30'>";
    ?>
    <h2>Ingresar nueva carta</h2>
    <form action="ingresar-carta-check.php" method="post">
        <div>
            ID: 
            <input type="text" name="id">
            Nombre: 
            <input type="text" name="nombre">
            Set: 
            <select name=set>
            <?php
                $consulta = pg_exec("select nombre from mostrar_sets();") or die('Consulta fallida');
                while ($contenido = pg_fetch_assoc($consulta)) {
                        echo "<option value='".$contenido['nombre']."'>".ucwords($contenido['nombre'])."</option>";
                    }
            ?>
            </select>
            <a href="javascript:openPopupSet();"><img src="popups/add.png" width="20"></a>
            Categor&iacute;a: 
            <select name=categoria>
            <?php
                $consulta = pg_exec("select nombre from mostrar_categorias();") or die('Consulta fallida');
                while ($contenido = pg_fetch_assoc($consulta)) {
                        echo "<option value='".$contenido['nombre']."'>".ucwords($contenido['nombre'])."</option>";
                    }
            ?>
            </select>
            <a href="javascript:openPopupCategoria();"><img src="popups/add.png" width="20"></a>
            Rareza: 
            <input type="text" name="rareza">
            Marca de regulaci&oacute;n: 
            <input type="text" name="marcaderegulacion">
            Ilustrador: 
            <select name=ilustrador>
            <?php
                $consulta = pg_exec("select nombre from mostrar_ilustradores();") or die('Consulta fallida');
                while ($contenido = pg_fetch_assoc($consulta)) {
                        echo "<option value='".$contenido['nombre']."'>".ucwords($contenido['nombre'])."</option>";
                    }
            ?>
            </select>
            <a href="javascript:openPopupIlustrador();"><img src="popups/add.png" width="20"></a>
            Imagen: 
            <input type="text" name="imagen">
            Idioma: 
            <input type="text" name="idioma">
            Estampado: 
            <input type="text" name="estampado">
            <input type="submit" value="Registrar">
        </div>
    </form>
    <a href="../dashboard.php">Volver</a>
</html>