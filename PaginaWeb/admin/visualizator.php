<script>
  // recargara la pagina en caso de eliminar comentarios  
    window.addEventListener( "pageshow", function ( event ) {
  var historyTraversal = event.persisted || 
                         ( typeof window.performance != "undefined" && 
                              window.performance.navigation.type === 2 );
  if ( historyTraversal ) {
    // Handle page restore.
    window.location.reload();
  }
});
</script>

<?php 
session_start();
include_once('../php/conectar.php')
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ordenaditto</title>
        <style>
            .visualizador{
                display: flex;
                padding-top: 10px;
            }
            .informacion{
                padding-left: 10px;
            }
            .opciones{
                display: flex;
            }
            #myImg {
                border-radius: 5px;
                cursor: pointer;
                transition: 0.3s;
                display: block;
                /* margin-left: auto; */
                /* margin-right: auto */
            }
            #myImg:hover {opacity: 0.7;}
                /* The Modal (background) */
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 99; /* Sit on top */
                padding-top: 100px; /* Location of the box */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
            }
                /* Modal Content (image) */
            .modal-content {
                margin: auto;
                border-radius: 24px;
                display: block;
                width: 25%;
                /* max-width: 75%; */
            }
                /* Caption of Modal Image */
            #caption {
                margin: auto;
                display: block;
                width: 80%;
                max-width: 700px;
                text-align: center;
                color: #ccc;
                padding: 10px 0;
                height: 150px;
            }

            @-webkit-keyframes zoom {
                from {-webkit-transform:scale(1)}
                to {-webkit-transform:scale(2)}
            }
     
            @keyframes zoom {
                from {transform:scale(0.4)}
                to {transform:scale(1)}
            }

            @-webkit-keyframes zoom-out {
                from {transform:scale(1)}
                to {transform:scale(0)}
            }
            @keyframes zoom-out {
                from {transform:scale(1)}
                to {transform:scale(0)}
            }

                /* Add Animation */
            .modal-content, #caption {
                -webkit-animation-name: zoom;
                -webkit-animation-duration: 0.6s;
                animation-name: zoom;
                animation-duration: 0.6s;
            }

            .out {
                animation-name: zoom-out;
                animation-duration: 0.6s;
            }

                /* 100% Image Width on Smaller Screens */
            @media only screen and (max-width: 700px){
                .modal-content {
                    width: 100%;
                }
            }
        </style>
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
    <?php 
        $consulta = pg_exec("select id, nombre, rareza, imagen, nombreilustrador, nombrecategoria, nombreserie, nombreset from mostrar_cartas() where id='".$_GET['id']."';") or die("Consulta fallida");
        $contenido = pg_fetch_assoc($consulta);
        echo "<div class='visualizador'>";
        echo "<img id='myImg' src='".$contenido['imagen']."' alt='".$contenido['nombre']."' width='300'>";
        echo "<div id='myModal' class='modal'>
                <img class='modal-content' id='img01'>
                <div id='caption'></div>
             </div>";
        echo "<div class='informacion'><p><b>ID</b> ".$contenido['id']."</p>";
        echo "<p><b>Nombre</b> ".$contenido['nombre']."</p>";
        echo "<p><b>Rareza</b> ".$contenido['rareza']."</p>";
        echo "<p><b>Ilustrador</b> ".$contenido['nombreilustrador']."</p>";
        echo "<p><b>Serie</b> ".$contenido['nombreserie']."</p>";
        echo "<p><b>Set</b> ".$contenido['nombreset']."</p>";
        echo "<p><b>Impresiones</b> ";
        $estampados = pg_exec("select distinct estampado from mostrar_cartas() where id='".$_GET['id']."';") or die("Consulta fallida");
        while ($estampado = pg_fetch_assoc($estampados)) {
            echo $estampado['estampado']." ";
        }
        echo "</p> </div></div>";
    ?>

        <h2>Comentarios</h2>
        <div>
            <?php
                $consulta = pg_exec("select * from mostrar_comentarios('".$_GET['id']."')");
                if (!pg_num_rows($consulta)) {
                echo "No hay comentarios";
                } else {
                    while ($contenido = pg_fetch_assoc($consulta)) {
                    $consulta_avatar = pg_exec("select avatar from mostrar_usuarios() where nombreusuario='".$contenido['nombreusuario']."'");
                    $avatar = pg_fetch_assoc($consulta_avatar);
                    echo "<p><img src='".$avatar['avatar']."' width='10'>".$contenido['nombreusuario']." ".date('d-m-Y H:i', strtotime($contenido['fecha']))."</p>";
                    echo "<p>".$contenido['texto']."</p>";
                    echo "<form action='utilidades/borrar-comentario-check.php' method='post'>
                            <input type='hidden' name='idcomentario' value='".$contenido['idcomentario']."'/>
                            <input type='submit' value='Borrar' id='hyperlink-style-button'/>
                        </form>";
                    }
                }
                
            ?>
        </div>
        <a href="javascript:history.back();">Volver</a>

        <script>
            // Get the modal
            var modal = document.getElementById('myModal');

            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = document.getElementById('myImg');
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");

            img.onclick = function(){
                modal.style.display = "block";
                modalImg.src = this.src;
                modalImg.alt = this.alt;
                captionText.innerHTML = this.alt;
            }


            // When the user clicks on <span> (x), close the modal
            modal.onclick = function() {
                img01.className += " out";
                setTimeout(function() {
                   modal.style.display = "none";
                   img01.className = "modal-content";
                 }, 400);
             
             }    

        </script>
</html>