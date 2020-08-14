<?php
    require_once 'includes/conexion.php';
if($_SESSION['usuario']['rolUsuario'] == "administrador"){

    $sql = "SELECT titulo FROM entradas WHERE id=".$_GET['id_entrada'];
    $resultado = mysqli_query($db, $sql);
    $resultado = mysqli_fetch_assoc($resultado);
    $nombre_entrada = $resultado['titulo'];
    $sql = "select u.nombre, u.id from archivos as a INNER JOIN usuarios as u ON a.id_usuario = u.id AND id_entrada = ".$_GET['id_entrada']." group by id_usuario;";
    $usuarios = mysqli_query($db, $sql);

// Creamos un instancia de la clase ZipArchive
 $zip = new ZipArchive();
// Creamos y abrimos un archivo zip temporal
 $zip->open($nombre_entrada.".zip",ZipArchive::CREATE);
 // Añadimos un directorio
 $dir = $nombre_entrada.'/';
 $zip->addEmptyDir($dir);

while($usuario = mysqli_fetch_assoc($usuarios)){
    $dir = $nombre_entrada.'/'.$usuario['id'].$usuario['nombre']."/";
    $zip->addEmptyDir($dir);
    $sql = "select * from archivos WHERE id_usuario = ".$usuario['id']." AND id_entrada = ".$_GET['id_entrada'].";";
    $archivos = mysqli_query($db, $sql);
    while($archivo = mysqli_fetch_assoc($archivos)){
        $zip->addFile("archivos/".$nombre_entrada."/".$usuario['id'].$usuario['nombre']."/".$archivo['nombre_archivo'],$dir.$archivo['nombre_archivo']);
    }
}
 $zip->close();
 // Creamos las cabezeras que forzaran la descarga del archivo como archivo zip.
 header("Content-type: application/octet-stream");
 header("Content-disposition: attachment; filename=".$nombre_entrada.".zip");
 // leemos el archivo creado
 readfile($nombre_entrada.".zip");
 // Por último eliminamos el archivo temporal creado
 unlink($nombre_entrada.".zip");//Destruye el archivo temporal

}

?>