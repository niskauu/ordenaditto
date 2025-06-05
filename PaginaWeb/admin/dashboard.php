
<?php
    session_start();
    include_once('../php/conectar.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ordenaditto</title>
    </head>
    <h1>Ordenaditto</h1>
    <a href="dashboard.php">Inicio</a>
    <a href="explore.php">Explorar</a>
    <a href="logout.php">Cerrar sesi&oacute;n</a>
    Bienvenido ADMINISTRADOR
    <?php 
        echo $_SESSION['name'];
        echo " <img src='".$_SESSION['avatar']."' width='30'>";
    ?>
    <div>
        <h3>Panel de control</h3>
        <div>
            <h4>Usuarios</h4>
            <button onclick="location.href='utilidades/registrar-usuario.php'">Registrar usuario</button>
            <button onclick="location.href='utilidades/borrar-usuario.php'">Borrar usuario</button>
        </div>
        <div>
            <h4>Colecciones</h4>
            <button onclick="location.href='utilidades/ingresar-coleccion.php'">Ingresar colecci&oacute;n</button>
            <button onclick="location.href='utilidades/renombrar-coleccion.php'">Renombrar colecci&oacute;n</button>
            <button onclick="location.href='utilidades/borrar-coleccion.php'">Borrar colecci&oacute;n</button>
        </div>
        <div>
            <h4>Cartas</h4>
            <button onclick="location.href='utilidades/ingresar-carta.php'">Ingresar carta</button>
            <button onclick="location.href='utilidades/modificar-carta.php'">Modificar carta</button>
            <button onclick="location.href='utilidades/borrar-carta.php'">Borrar carta</button>
        </div>
    </div>

    
    
</html>