<?php require_once 'includes/conexion.php'; ?>
<?php   

if($_SESSION['usuario']['rolUsuario'] == "administrador"){
    $sql = "SELECT u.id, u.nombre FROM usuarios as u WHERE u.id =".$_GET['id_usuario'];
    $usuario = mysqli_query($db, $sql);
    $usuario = mysqli_fetch_assoc($usuario);
    $sql = "SELECT titulo FROM entradas as u WHERE id =".$_GET['id_entrada'];
    $entrada = mysqli_query($db, $sql);
    $entrada = mysqli_fetch_assoc($entrada);

    $path = 'archivos/'.$entrada['titulo']."/".$usuario['id'].$usuario['nombre'];

//////////////////////////
function removeDirectory($path)
{
    $path = rtrim( strval( $path ), '/' ) ;
    
    $d = dir( $path );
    
    if( ! $d )
        return false;
    
    while ( false !== ($current = $d->read()) )
    {
        if( $current === '.' || $current === '..')
            continue;
        
        $file = $d->path . '/' . $current;
        
        if( is_dir($file) )
            removeDirectory($file);
        
        if( is_file($file) )
            unlink($file);
    }
    
    rmdir( $d->path );
    $d->close();
    return true;
}

///////////////////////
removeDirectory($path);
        $sql = "DELETE FROM archivos WHERE id_usuario =".$_GET['id_usuario']." AND id_entrada = ".$_GET['id_entrada'];
        mysqli_query($db, $sql);
        
    }
    header("location: entrada.php?id=".$_GET['id_entrada']);
?>