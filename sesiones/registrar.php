<?php
include_once('../config/config.php');

include_once(BASE_DIR . "config/class.conexion.php");

include_once(MODELS_DIR . "usuarios/model.usuarios.php");

include_once(MODELS_DIR . "personas/model.personas.php");

if (!empty($_POST)) {

    $emailUsuario = $_POST['email'];
    $passUsuario = $_POST['pass'];
    $cpass = $_POST['repass'];
    $nombrePersona = $_POST['nombre'];
    $apellidoPersona = $_POST['apellido'];
    $sexoPersona = $_POST['sexo'];
    $rolUsuario = 2;
    $idDocumento = NULL;


    if($passUsuario == $cpass){

        $ultimaPersonaId = insertar_persona($nombrePersona,$apellidoPersona,$sexoPersona,$idDocumento);
        
        
        if ($ultimaPersonaId) {
            
            insertar_usuario($emailUsuario,$passUsuario,$rolUsuario,$ultimaPersonaId);

    
            header('Location:../index.php');
    
    
        } else {
            // Si no existen usuarios
            session_destroy();
            header('Location:../controller/inicio/controller.inicio.php?error=3');
    
    
        }
    }
} else {
    //si el formulario está en blanco
    session_destroy();
    header('Location:../controller/inicio/controller.inicio.php?error=4');
}