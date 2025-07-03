
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
            <button onclick="location.href='utilidades/mostrar-usuarios.php'">Mostrar usuarios</button>
        </div>
        <div>
            <h4>Series</h4>
            <button onclick="location.href='utilidades/ingresar-serie.php'">Ingresar serie</button>
            <button onclick="location.href='utilidades/renombrar-serie.php'">Renombrar serie</button>
            <button onclick="location.href='utilidades/borrar-serie.php'">Borrar serie</button>
            <button onclick="location.href='utilidades/mostrar-series.php'">Mostrar series</button>
        </div>
        <div>
            <h4>Set</h4>
            <button onclick="location.href='utilidades/ingresar-set.php'">Ingresar set</button>
            <button onclick="location.href='utilidades/renombrar-set.php'">Renombrar set</button>
            <button onclick="location.href='utilidades/borrar-set.php'">Borrar set</button>
            <button onclick="location.href='utilidades/cambiar-set.php'">Cambiar serie</button>
            <button onclick="location.href='utilidades/mostrar-sets.php'">Mostrar sets</button>
        </div>
        <div>
            <h4>Categorias</h4>
            <button onclick="location.href='utilidades/ingresar-categoria.php'">Ingresar categor&iacute;a</button>
            <button onclick="location.href='utilidades/renombrar-categoria.php'">Renombrar categor&iacute;a</button>
            <button onclick="location.href='utilidades/borrar-categoria.php'">Borrar categor&iacute;a</button>
            <button onclick="location.href='utilidades/mostrar-categorias.php'">Mostrar categor&iacute;as</button>
        </div>
        <div>
            <h4>Ilustradores</h4>
            <button onclick="location.href='utilidades/ingresar-ilustrador.php'">Ingresar ilustrador</button>
            <button onclick="location.href='utilidades/renombrar-ilustrador.php'">Renombrar ilustrador</button>
            <button onclick="location.href='utilidades/cambiar-rrss.php'">Modificar redes sociales</button>
            <button onclick="location.href='utilidades/borrar-ilustrador.php'">Borrar ilustrador</button>
            <button onclick="location.href='utilidades/mostrar-ilustradores.php'">Mostrar ilustradores</button>
        </div>
        <div>
            <h4>Cartas</h4>
            <button onclick="location.href='utilidades/ingresar-carta.php'">Ingresar carta</button>
            <button onclick="location.href='utilidades/modificar-carta.php'">Modificar carta</button>
            <button onclick="location.href='utilidades/borrar-carta.php'">Borrar carta</button>
            <button onclick="location.href='explore.php'">Mostrar cartas</button>
        </div>
    </div>

    
    
</html>