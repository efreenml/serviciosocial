<?php
require_once 'includes/conexion.php';

if(isset($_SESSION['usuario']) && isset($_GET['id']) && $_SESSION['usuario']['rolUsuario'] == 'administrador' ){
	$usuario_id = $_GET['id'];
	
	if($_SESSION['usuario']['rolUsuario'] == 'administrador'){
	$sql = "DELETE FROM usuarios WHERE id = $usuario_id";
	$borrar = mysqli_query($db, $sql);
    }
}
header("Location: usuarios.php");
?>