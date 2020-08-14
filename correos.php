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
<?php if(isset($_SESSION['correo']) && $_SESSION['correo']==true): ?>
			<div class="alerta alerta-exito">
				<p> Correos enviados exitosamente</p>
			</div>
		<?php endif; 
			if(isset($_SESSION['correo'])){
				$_SESSION['correo'] = false;
			}
		
		?>


		
<form action="enviar-correo.php" method="POST" enctype="multipart/form-data">
	<label for="asunto">Asunto:</label>
	<input type="text" name="asunto">
	<label for="descripcion">correo:</label>
	<textarea id = "myTextarea" name="descripcion"></textarea>
	<hr>
	<table class="egt">
		<tr>
		<th><input type="checkbox" id="selectall"></th>
		<th>id</th>
			<th>Nombre</th>
			<th>apellido</th>
			<th>email</th>
		</tr>	
			<?php
				  $correos = correos($db);
			if(!empty($correos)):
				while($correo = mysqli_fetch_assoc($correos)): 
		?>
		<td><input type="checkbox" class="case" name="case[]" value="<?= $correo['id']  ?>"></td>
		  <td class = "id-usuario"><?= $correo['id']?></td>
		  <td> <input type = "text" disabled value = <?= $correo['nombre']  ?>  ></td>
		  <td> <input type = "text" disabled value = <?= $correo['apellidos']  ?>  ></td>
		  <td> <input type = "text" disabled value = <?= $correo['email']  ?> ></td>
		</tr>
		<?php
				endwhile;
			endif;
		?>
	  </table><br><br>
	  <input name="fichero_usuario" type="file" accept="image/x-png,image/gif,image/jpeg" /><br />
	  <input type="submit" value="enviar correo" />
	  </form>

	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


<script>
$("#selectall").on("click", function() {  
  $(".case").prop("checked", this.checked);  
});  

// if all checkbox are selected, check the selectall checkbox and viceversa  
$(".case").on("click", function() {  
  if ($(".case").length == $(".case:checked").length) {  
    $("#selectall").prop("checked", true);  
  } else {  
    $("#selectall").prop("checked", false);  
  }  
});</script>

<!--fin principal-->

<?php require_once 'includes/pie.php'; ?>