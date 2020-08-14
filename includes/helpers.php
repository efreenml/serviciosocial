<?php

function mostrarError($errores, $campo){
	$alerta = '';
	if(isset($errores[$campo]) && !empty($campo)){
		$alerta = "<div class='alerta alerta-error'>".$errores[$campo].'</div>';
	}
	
	return $alerta;
}
function mostrarUsuarios($db){
	{
		$sql = "SELECT * FROM usuarios ORDER BY id ASC;";
		$usuarios = mysqli_query($db, $sql);
		
		$resultado = array();
		if($usuarios && mysqli_num_rows($usuarios) >= 1){
			$resultado = $usuarios;
		}
		
		return $resultado;
	}
}
function correos($db){
		$sql = "SELECT id, nombre, apellidos, email FROM usuarios ORDER BY id ASC;";
		$usuarios = mysqli_query($db, $sql);
		$resultado = array();
		if($usuarios && mysqli_num_rows($usuarios) >= 1){
			$resultado = $usuarios;
		}
		return $resultado;
}



function mostrarUsuario($db, $id){
	{
		$sql = "SELECT * FROM usuarios WHERE id = $id;";
		$usuarios = mysqli_query($db, $sql);
		$resultado = array();
		if($usuarios && mysqli_num_rows($usuarios) >= 1){
			$resultado = $usuarios;
		}
		return $resultado;
	}

}

function borrarErrores(){
	$borrado = false;
	
	if(isset($_SESSION['errores'])){
		$_SESSION['errores'] = null;
		$borrado = true;
	}
	
	if(isset($_SESSION['errores_entrada'])){
		$_SESSION['errores_entrada'] = null;
		$borrado = true;
	}
	
	if(isset($_SESSION['completado'])){
		$_SESSION['completado'] = null;
		$borrado = true;
	}
	
	return $borrado;
}

function conseguirCategorias($conexion){
	$sql = "SELECT * FROM categorias ORDER BY id ASC;";
	$categorias = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($categorias && mysqli_num_rows($categorias) >= 1){
		$resultado = $categorias;
	}
	
	return $resultado;
}

function conseguirCategoria($conexion, $id){
	$sql = "SELECT * FROM categorias WHERE id = $id;";
	$categorias = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($categorias && mysqli_num_rows($categorias) >= 1){
		$resultado = mysqli_fetch_assoc($categorias);
	}
	
	return $resultado;
}

function conseguirEntrada($conexion, $id){
	$sql = "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ', u.apellidos) AS 'usuario' "
		  . " FROM entradas e ".
		   "INNER JOIN categorias c ON e.categoria_id = c.id ".
		   "INNER JOIN usuarios u ON e.usuario_id = u.id ".
		   "WHERE e.id = $id";
	$entrada = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($entrada && mysqli_num_rows($entrada) >= 1){
		$resultado = mysqli_fetch_assoc($entrada);
	}
	
	return $resultado;
}

function conseguirEntradas($conexion, $limit = null, $categoria = null, $busqueda = null){
	$sql="SELECT e.*, c.nombre AS 'categoria' FROM entradas e ".
		 "INNER JOIN categorias c ON e.categoria_id = c.id ";
	
	if(!empty($categoria)){
		$sql .= "WHERE e.categoria_id = $categoria ";
	}
	
	if(!empty($busqueda)){
		$sql .= "WHERE e.titulo LIKE '%$busqueda%' ";
	}
	
	$sql .= "ORDER BY e.id DESC ";
	
	if($limit){
		// $sql = $sql." LIMIT 4";
		$sql .= "LIMIT 4";
	}
	
	$entradas = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($entradas && mysqli_num_rows($entradas) >= 1){
		$resultado = $entradas;
	}
	
	return $entradas;
}

function mostrarArchivos($db, $id_usuario, $id_entrada){
	$sql = "SELECT * FROM archivos WHERE id_usuario =".$id_usuario." AND id_entrada = ".$id_entrada." LIMIT 5;";
	$archivos = mysqli_query($db, $sql);
	$resultado = array();
	if($archivos && mysqli_num_rows($archivos) >= 1){
		$resultado = $archivos;
	}
	return $resultado;
}


function usuariosArchivos($db, $id_entrada){
	$sql = "SELECT * FROM archivos GROUP BY id_usuario";
	$sql = "select a.*, u.nombre, u.apellidos, u.id from archivos as a INNER JOIN usuarios as u ON a.id_usuario = u.id AND id_entrada = ".$id_entrada." group by id_usuario;";
	$usuarios = mysqli_query($db, $sql);
	$resultado = array();
	if($usuarios && mysqli_num_rows($usuarios) >= 1){
		$resultado = $usuarios;
	}
	return $resultado;


}