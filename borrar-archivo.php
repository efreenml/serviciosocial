<?php require_once 'includes/conexion.php'; ?>
<?php   

if($_SESSION['usuario']['id'] == $_GET['id_usuario'] || $_SESSION['usuario']['rolUsuario'] == "administrador"){
        $sql = "DELETE FROM archivos WHERE id =".$_GET['id_archivo'];
        mysqli_query($db, $sql);
    }

    header("location: entrada.php?id=".$_GET['id_entrada']);


?>