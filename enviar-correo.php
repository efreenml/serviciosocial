<?php
	require_once 'includes/conexion.php';
if(isset($_POST) && ($_SESSION['usuario']['rolUsuario'] == "administrador" || $_SESSION['usuario']['rolUsuario'] == "regular")  ){	
    $_name=$_FILES["fichero_usuario"]["name"];
$_temp=$_FILES["fichero_usuario"]["tmp_name"];
//echo $_FILES["fichero_usuario"]["name"];
copy($_temp,"archivos/".$_name);
//echo  ' <img src="https://pandamoniumacatlan.000webhostapp.com/archivos/'.$_name.'"> ';
$ids = "SELECT * FROM usuarios WHERE id = 0";
    foreach($_POST['case'] as $caso){
        $ids.= " || id = ".$caso;
    }
            $sql = $ids;
            $usuarios = mysqli_query($db, $sql);
            
            $resultado = array();
            if($usuarios && mysqli_num_rows($usuarios) >= 1){
                $resultado = $usuarios;
            }
            $mensaje = '
<html>
<head>
</head>
<body>
  <p>'.$_POST['asunto'].'</p>
  <table>
    <tr>
        '.$_POST['descripcion'].'
    </tr>
  </table>
  <img src="https://pandamoniumacatlan.000webhostapp.com/archivos/'.$_name.'">
  </body>
</html>
';

$from = "test@liger.com";

$subject = $_POST['asunto'];
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
$headers .= 'From: <ColegiodeMatematicas@alma.com>';



// SEND MAIL

            while($categoria = mysqli_fetch_assoc($resultado)){
                $to = $categoria['email'];
                mail($to,$subject,$mensaje, $headers);
               // echo "Correos enviados";

            }
//unlink('archivos/'.$_name);
$_SESSION["correo"] = true;
header("Location:correos.php");
}