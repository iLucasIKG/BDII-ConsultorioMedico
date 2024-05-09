<?php 
include_once("config/class.conexion.php");
//include_once(MODELS_DIR . "usuarios/model.usuarios.php");


errores();

$idUsuario=$_SESSION['nro_usuario'];
$idPersona=$_SESSION['id_persona'];
$idRol=$_SESSION['id_rol'];


function errores(){
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

