<?php
include_once('../config/config.php');

include_once(BASE_DIR."config/class.conexion.php");

include_once(MODELS_DIR."usuarios/model.usuarios.php");

include_once(MODELS_DIR."personas/model.personas.php");


$emailUsuario = $_POST['email'];
$passUsuario = $_POST['pass'];

if (!empty($emailUsuario) && !empty($passUsuario)) {
    
    $usuario = iniciar_sesion($emailUsuario, $passUsuario);

    if ($usuario) {

        if ($usuario['id_persona'] == 0) {
            $nombreUsuario = "Admin";
        }else{
            $persona = buscar_una_persona($usuario['id_persona']);
            $nombreUsuario = $persona['nombre'].' '.$persona['apellido'];
        }


        $_SESSION['nro_usuario'] = $usuario['numero_usuario'];
        $_SESSION['id_persona'] = $usuario['id_persona'];
        $_SESSION['rol'] = $usuario['id_rol'];
        $_SESSION['nombre_usuario'] = $nombreUsuario;



        
        header('Location:../index.php?accion=ingresar');


    } else {
        // Si no existen usuarios
        session_destroy();
        header('Location:../controller/inicio/controller.inicio.php?error=1');


    }
} else {
    //si el formulario está en blanco
    session_destroy();
    header('Location:../controller/inicio/controller.inicio.php?error=2');
}