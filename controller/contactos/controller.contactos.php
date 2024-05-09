<?php
include_once("../../config/config.php");

include_once(VIEWS_DIR."head/head.php");
include_once(BASE_DIR."config/class.conexion.php");
include_once(MODELS_DIR."contactos/model.contactos.php");
include_once(MODELS_DIR."personas/model.personas.php");
include_once(MODELS_DIR."direcciones/model.direccion.php");


$accion = "";

//Verificamos si existe esa variable
if(isset($accion)) {
    $accion = $_POST['accion'];
}

if($accion == "" or $accion == "index") {
    //Lamamos por si hay algun error
    errores();

    //Lamamos a la funcion
    contactos_index();
} elseif($accion == "crear") {

    errores();

    contactos_crear();
} elseif($accion == "insertar") {

    errores();

    contactos_insertar($_POST);
} elseif($accion == "editar") {
    errores();

    $idContacto = $_POST['id_contacto'];
    $idPersona = $_POST['id_persona'];
    $idDireccion = $_POST['id_direccion'];

    contactos_editar($idPersona, $idDireccion);
} elseif($accion == "actualizar") {
    errores();

    contactos_actualizar($_POST);
} elseif($accion == "eliminar") {
    errores();

    $idContacto = $_POST['id_contacto'];

    contactos_eliminar($idContacto);
}

function contactos_index() {

    // Llamamos a la función del modelo para obtener los médicos
    $contactos = listar_contactos();

    // Incluimos la vista para mostrar los médicos
    include_once(VIEWS_DIR."contactos/contactos.php");
}
function contactos_crear() {
    $personas = listar_personas();
    $direcciones = listar_direcciones();

    // Incluimos la vista para mostrar el formulario
    include_once(VIEWS_DIR."contactos/agregar.php");
}

function contactos_insertar($argPOST) {
    //Guardamos Las variables que recibimos del formulario
    $telefono = $argPOST['telefono'];
    $idDireccion = $argPOST['id_direccion'];
    $idPersona = $argPOST['id_persona'];

    insertar_contacto($telefono, $idDireccion, $idPersona);

    header("Location:controller.contactos.php");
}
function contactos_editar($argIdPersona, $argIdDireccion) {
    $contacto = buscar_un_contacto($argIdPersona);
    $persona = buscar_una_persona($argIdPersona);
    $direcciones = listar_direcciones();



    include_once(VIEWS_DIR."contactos/editar.php");

}
function contactos_actualizar($argPOST) {

    //Guardamos Las variables que recibimos del formulario
    $idContacto = $argPOST['id_contacto'];
    $idPersona = $argPOST['id_persona'];
    $telefono = $argPOST['telefono'];
    $idDireccion = $argPOST['id_direccion'];

 
    //llamo a las funciones para actualizar los datos de un medico
    actualizar_contacto($idContacto, $telefono, $idDireccion,$idPersona, );

    header("Location:controller.contactos.php");
}
function contactos_eliminar($argIdContacto) {

    eliminar_contacto($argIdContacto);

    header("Location:controller.contactos.php");
}

/*
function contactos_mostrar($argIdPersona){
    
    $persona = buscar_una_persona($argIdPersona);
    
    include_once(VIEWS_DIR."documentaciones/mostrar.php");
    
} 
*/


function errores() {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}
/* 

*/
include_once(VIEWS_DIR."head/footer.php");
?>