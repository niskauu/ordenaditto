
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
            <h4>Series</h4>
            <button onclick="location.href='utilidades/ingresar-serie.php'">Ingresar serie</button>
            <button onclick="location.href='utilidades/renombrar-serie.php'">Renombrar serie</button>
            <button onclick="location.href='utilidades/borrar-serie.php'">Borrar serie</button>
        </div>
        <div>
            <h4>Set</h4>
            <button onclick="location.href='utilidades/ingresar-set.php'">Ingresar set</button>
            <button onclick="location.href='utilidades/renombrar-set.php'">Renombrar set</button>
            <button onclick="location.href='utilidades/borrar-set.php'">Borrar set</button>
            <button onclick="location.href='utilidades/cambiar-set.php'">Cambiar serie</button>
        </div>
        <div>
            <h4>Categorias</h4>
            <button onclick="location.href='utilidades/ingresar-categoria.php'">Ingresar categoria</button>
            <button onclick="location.href='utilidades/renombrar-categoria.php'">Renombrar categoria</button>
            <button onclick="location.href='utilidades/borrar-categoria.php'">Borrar categoria</button>
        </div>
        <div>
            <h4>Ilustradores</h4>
            <button onclick="location.href='utilidades/ingresar-ilustrador.php'">Ingresar ilustrador</button>
            <button onclick="location.href='utilidades/renombrar-ilustrador.php'">Renombrar ilustrador</button>
            <button onclick="location.href='utilidades/cambiar-rrss.php'">Modificar redes sociales</button>
            <button onclick="location.href='utilidades/borrar-ilustrador.php'">Borrar ilustrador</button>
        </div>
        <div>
            <h4>Cartas</h4>
            <button onclick="location.href='utilidades/ingresar-carta.php'">Ingresar carta</button>
            <button onclick="location.href='utilidades/modificar-carta.php'">Modificar carta</button>
            <button onclick="location.href='utilidades/borrar-carta.php'">Borrar carta</button>
        </div>
    </div>

    
    
</html>