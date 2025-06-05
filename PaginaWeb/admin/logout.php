<script>
function fin_sesion() {
    alert("Se ha cerrado la sesión");
    window.location.replace("../index.php");
}
</script>
<?php
    session_start();
    $_SESSION = array();
    session_destroy();
    echo "<script>fin_sesion()</script>";
?>