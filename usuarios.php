<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>	
<?php require_once 'includes/lateral.php'; ?>
<?php
if($_SESSION['usuario']['rolUsuario'] != 'administrador'){
  header("Location: index.php");
}
?>


<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h2>Usuarios registrados:</h2>
<table class="egt">
  <tr>

    <td>id</td>
    <td>Nombre</td>
    <td>apellido</td>
    <td>email</td>
    <td>rol</td>
    <td>editar</td>
    <td>eliminar</td>
  </tr>

  
      <?php
            $usuarios = mostrarUsuarios($db);
      if(!empty($usuarios)):
          while($usuario = mysqli_fetch_assoc($usuarios)): 
  ?>
  <tr>
    <td class = "id-usuario"><?= $usuario['id']?></td>
    <td> <input type = "text" disabled value = <?= $usuario['nombre']  ?>   ></td>
    <td> <input type = "text" disabled value = <?= $usuario['apellidos']  ?>   ></td>
    <td> <input type = "text" disabled value = <?= $usuario['email']  ?>   ></td>
    <td class = "rol-usuario"> <input type = "text" disabled value = <?= $usuario['rolUsuario']  ?>    ></td>
    <td><a href="editar-usuario.php?id=<?= $usuario['id']?>"><i class="fas fa-user-edit"></i></a>  </td>
    <td><a href="borrar-usuario.php?id=<?= $usuario['id']?>"><i class="far fa-trash-alt"></i></a> </td>

    
  </tr>
  <?php
          endwhile;
      endif;
  ?>
</table>
</div> <!--fin principal-->
			
<?php require_once 'includes/pie.php'; ?>
