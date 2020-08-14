<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>
<?php

$user = mysqli_fetch_assoc(mostrarUsuario($db, $_GET['id']) );
?>
<!-- CAJA PRINCIPAL -->
<div id="principal">
	<h1>Mis datos</h1>

	<?php if(isset($_SESSION['completado'])): ?>
	<div class="alerta alerta-exito">
		<?=$_SESSION['completado']?>
	</div>
	<?php elseif(isset($_SESSION['errores']['general'])): ?>
	<div class="alerta alerta-error">
		<?=$_SESSION['errores']['general']?>
	</div>
	<?php endif; ?>

	<form action="modificar-usuario.php" method="POST">
		<input type="text" name="id" value="<?=$user['id']; ?>" style="display: none"/>

		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" value="<?=$user['nombre']; ?>" />
		<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

		<label for="apellidos">Apellidos</label>
		<input type="text" name="apellidos" value="<?=$user['apellidos']; ?>" />
		<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>

		<label for="email">Email</label>
		<input type="email" name="email" value="<?=$user['email']; ?>" />
		<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

		<label for="password">password</label>
		<input type="password" name="password" />
		<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>

		<label for="permisos">Permisos</label>
		<select name="permisos">
			<option value=""></option>
			<option value="administrador">administrador</option>
			<option value="regular">regular</option>
			<option value="profesor">profesor</option>
		</select>
		<input type="submit" name="submit" value="Actualizar" />
	</form>
	<?php borrarErrores(); ?>

</div>
<!--fin principal-->

<?php require_once 'includes/pie.php'; ?>