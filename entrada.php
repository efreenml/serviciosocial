<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php
	$entrada_actual = conseguirEntrada($db, $_GET['id']);

	if(!isset($entrada_actual['id'])){
		header("Location: index.php");
	}
?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">

	<h1><?=$entrada_actual['titulo']?></h1>

	<a href="categoria.php?id=<?=$entrada_actual['categoria_id']?>">
		<h2><?=$entrada_actual['categoria']?></h2>
	</a>
	<h4><?=$entrada_actual['fecha']?> | <?=$entrada_actual['usuario'] ?></h4>
	<p>
		<?=$entrada_actual['descripcion']?>
	</p>

	<?php if(isset($_SESSION["usuario"])):
			if( ( $_SESSION['usuario']['id'] == $entrada_actual['usuario_id']) || $_SESSION['usuario']['rolUsuario'] == 'administrador'):
		?>
	<br />
	<a href="editar-entrada.php?id=<?=$entrada_actual['id']?>" class="boton boton-verde">Editar entrada</a>
	<a href="borrar-entrada.php?id=<?=$entrada_actual['id']?>" class="boton">Eliminar entrada</a>
	<?php 
			endif;
			endif; ?>
	<hr>
	<?php if(isset($_SESSION['usuario'])):?>
	<?php if($_SESSION['usuario']['rolUsuario'] != 'administrador' ):?>
	
	<div>
		<h2>Seleccionar archivos (PDF)</h2>
		<form method="POST" action="subir-archivos.php" enctype="multipart/form-data">
			<input type="text" name="id_entrada" value="<?=$_GET['id'];?>" style="display: none">
			<input type="text" name="id_usuario" value="<?=$_SESSION['usuario']['id']?>" style="display: none">
			<input name="fichero_usuario[]" type="file" accept="application/pdf" /><br />
			<input name="fichero_usuario[]" type="file" accept="application/pdf" /><br />
			<input name="fichero_usuario[]" type="file" accept="application/pdf" /><br />
			<input name="fichero_usuario[]" type="file" accept="application/pdf" /><br />
			<input name="fichero_usuario[]" type="file" accept="application/pdf" /><br />
			<input type="submit" name="enviar" value="Enviar">
		</form>
	</div>
	<br>
		<?php endif;
			endif;
		?>
	<hr>

	<?php
			if(isset($_SESSION['usuario'])):
			if($_SESSION['usuario']['rolUsuario'] == "administrador"):
	?>

<a href="descargar-archivos.php?id_entrada=<?=$_GET['id']?>" class="boton">Descargar archivos</a>	
			<?php endif;
				endif;
			?>
	<hr>
	<?php
	if(isset($_SESSION['usuario'])):
		if($_SESSION['usuario']['rolUsuario'] != "administrador"):
			$archivos = mostrarArchivos($db, $_SESSION['usuario']['id'], $_GET['id']);
			if(!empty($archivos)):
	?>
	<table>
		<tr>
			<td>id</td>
			<td>Nombre_archivo</td>
			<td>borrar</td>
		</tr>
		<?php			
				while($archivo = mysqli_fetch_assoc($archivos) ):					
	?>

<tr>
			<td> <?= $archivo['id']?> </td>
			<td> <?= $archivo['nombre_archivo']?> </td>
			<td><a href="borrar-archivo.php?id_usuario=<?= $_SESSION['usuario']['id']?>&id_archivo=<?= $archivo['id']?>&id_entrada=<?=$_GET['id']?>"><i class="far fa-trash-alt"></i></a></td>
		</tr>

		<?php
				endwhile;
	?>
	</table>
	<?php		endif;
	endif;
endif;

?>
	<?php
	if(isset($_SESSION['usuario'])):
	if($_SESSION['usuario']['rolUsuario'] == 'administrador'):
		$usuarios = usuariosArchivos($db,$_GET['id']);

		if(!empty($usuarios)):
	?>
		<table>
		<tr>
			<td>id</td>
			<td>Nombre Profesor</td>
			<td>borrar archivos</td>
		</tr>
<?php
				while($usuario = mysqli_fetch_assoc($usuarios)):

?>
<tr>
			<td> <?= $usuario['id']?> </td>
			<td> <?= $usuario['nombre']." ".$usuario['apellidos']?> </td>
			<td><a href="borrar-archivos.php?id_usuario=<?= $usuario['id']?>&id_entrada=<?=$_GET['id']?>"><i class="far fa-trash-alt"></i></a></td>
		</tr>
		<?php
				endwhile;
	?>
	</table>
	<hr>


	<?php
	endif;
endif;
endif;
	?>

</div>
<!--fin principal-->
<?php require_once 'includes/pie.php'; ?>