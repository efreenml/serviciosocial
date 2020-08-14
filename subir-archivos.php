<?php
require_once 'includes/conexion.php';
$entrada = mysqli_fetch_assoc(mysqli_query($db, 'SELECT id, titulo FROM entradas WHERE id ='.$_POST['id_entrada']));
$usuario = mysqli_fetch_assoc(mysqli_query($db, 'SELECT id, nombre FROM usuarios WHERE id ='.$_POST['id_usuario']));
$nombre = $_FILES['fichero_usuario']['name'];
$ruta = $_FILES['fichero_usuario']['tmp_name'];
$destino = "archivos/".$entrada['titulo']."/".$usuario['id'].$usuario['nombre'];
mkdir("archivos/".$entrada['titulo']);
mkdir($destino);
for($indice = 0; $indice < 5; $indice++){
    if($nombre[$indice] != ''){
    copy($ruta[$indice],$destino."/".$nombre[$indice]);
    $sql = "INSERT INTO archivos VALUES(null,"
    .$usuario['id'].",".$entrada['id'].",'".$nombre[$indice]."');";
    mysqli_query($db, $sql);
    }
}
header("location:entrada.php?id=".$entrada['id']);
/*
// Creamos un instancia de la clase ZipArchive
 $zip = new ZipArchive();
// Creamos y abrimos un archivo zip temporal
 $zip->open("miarchivo.zip",ZipArchive::CREATE);
 // Añadimos un directorio
 $dir = 'archivos/';
 $zip->addEmptyDir($dir);
 // Añadimos un archivo en la raid del zip.
 $zip->addFile("imagen1.jpg","mi_imagen1.jpg");
 //Añadimos un archivo dentro del directorio que hemos creado
 $zip->addFile("imagen2.jpg",$dir."/mi_imagen2.jpg");
 // Una vez añadido los archivos deseados cerramos el zip.
 $zip->close();
 // Creamos las cabezeras que forzaran la descarga del archivo como archivo zip.
 header("Content-type: application/octet-stream");
 header("Content-disposition: attachment; filename=miarchivo.zip");
 // leemos el archivo creado
 readfile('miarchivo.zip');
 // Por último eliminamos el archivo temporal creado
 unlink('miarchivo.zip');//Destruye el archivo temporal */
?>
