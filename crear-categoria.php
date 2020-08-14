<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>
<?php
	if($_SESSION['usuario']['rolUsuario'] == 'profesor'){
		header("location: index.php");
	}
?>
<!-- CAJA PRINCIPAL -->
<div id="principal">
	<h1>Crear categorias</h1>
	<p>
		Añade nuevas categorias al blog para que los usuarios puedan
		usarlas al crear sus entradas.
	</p>
	<br />
	<form action="guardar-categoria.php" method="POST">
		<label for="nombre">Nombre de la categoría:</label>
		<input type="text" name="nombre" />

		<input type="submit" value="Guardar" />
	</form>
	<hr>
	<h2>Borrar categorías</h2>
	<?php 
						$categorias = conseguirCategorias($db);
						if(!empty($categorias)):
							while($categoria = mysqli_fetch_assoc($categorias)): 
					?>

	<ul>
		<li class="lista-categorias">
			<div>
					<a href="borrar-categoria.php?id=<?=$categoria['id']?>"> <i class="fas fa-trash-alt"></i> </a>
						
				<span class = "category"><?=$categoria['nombre']?></span>

			</div>
		</li>
	</ul>
	<?php
							endwhile;
						endif;
					?>
</div>
<!--fin principal-->

<?php require_once 'includes/pie.php'; ?>