<?php
//conextion local
/*$servidor = "localhost";
$usuario = "root";
$password = "";
$basededatos = "blog_master";
*/
// Conexión servidor prueba
$servidor = 'localhost';
$usuario = 'id9610743_root';
$password = 'maniatico1';
$basededatos = 'id9610743_blog_acatlan'; 
$db = mysqli_connect($servidor, $usuario, $password, $basededatos);

mysqli_query($db, "SET NAMES 'utf8'");

// Iniciar la sesión
if(!isset($_SESSION)){
	session_start();
}