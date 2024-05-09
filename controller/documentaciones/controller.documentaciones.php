<?php
include_once("../../config/config.php");

include_once(VIEWS_DIR."head/head.php");
include_once(BASE_DIR."config/class.conexion.php");
include_once(MODELS_DIR."documentaciones/model.documentaciones.php");
include_once(MODELS_DIR."personas/model.personas.php");



$accion = "";

//Verificamos si existe esa variable
if(isset($accion)) {
    $accion = $_POST['accion'];
}

if($accion == "" or $accion == "index") {
    //Lamamos por si hay algun error
    errores();

    //Lamamos a la funcion
    documentaciones_index();
} elseif($accion == "crear") {

    errores();

    documentaciones_crear();
} elseif($accion == "insertar") {

    errores();

    documentaciones_insertar($_POST);
} elseif($accion == "editar") {
    errores();

    $idDocumento = $_POST['id_documento'];

    documentaciones_editar($idDocumento);
} elseif($accion == "actualizar") {
    errores();

    documentaciones_actualizar($_POST);
} elseif($accion == "eliminar") {
    errores();

    $idDocumento = $_POST['id_documento'];

    documentaciones_eliminar($idDocumento);
}

function documentaciones_index() {

    // Llamamos a la función del modelo para obtener los médicos
    $documentos = listar_documentos();

    // Incluimos la vista para mostrar los médicos
    include_once(VIEWS_DIR."documentaciones/documentaciones.php");
}
function documentaciones_crear() {

    // Incluimos la vista para mostrar el formulario
    include_once(VIEWS_DIR."documentaciones/agregar.php");
}

function documentaciones_insertar($argPOST) {
    //Guardamos Las variables que recibimos del formulario
    $tipoDocumento = strtoupper($argPOST['tipo_documento']);
    $numeroDocumento = $argPOST['numero_documento'];
    $cuil = $argPOST['cuil'];
    $nroSegSocial = $argPOST['numero_seguridad_social'];



    insertar_documento($tipoDocumento, $numeroDocumento, $cuil, $nroSegSocial);

    header("Location:controller.documentaciones.php");
}
function documentaciones_editar($argIdDocumento) {
    $documento = buscar_un_documento($argIdDocumento);

    include_once(VIEWS_DIR."documentaciones/editar.php");

}
function documentaciones_actualizar($argPOST) {

    //Guardamos Las variables que recibimos del formulario
    $idDocumento = $argPOST['id_documento'];
    $tipoDocumento = strtoupper($argPOST['tipo_documento']);
    $numeroDocumento = strtoupper($argPOST['numero_documento']);
    $cuil = $argPOST['cuil'];
    $nroSegSocial = $argPOST['numero_seguridad_social'];

    //llamo a las funciones para actualizar los datos de un medico
    actualizar_documento($idDocumento, $tipoDocumento, $numeroDocumento, $cuil, $nroSegSocial);

    header("Location:controller.documentaciones.php");
}
function documentaciones_eliminar($argIdDocumento) {

    eliminar_documento($argIdDocumento);

    header("Location:controller.documentaciones.php");
}
/* function documentaciones_mostrar($argIdDocumento,$argIdPersona){
    $documento = buscar_un_documento($argIdDocumento);
    $persona = buscar_una_persona($argIdPersona);
    

    include_once(VIEWS_DIR."documentaciones/mostrar.php");
    
} */



function errores() {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}
/* 

*/
include_once(VIEWS_DIR."head/footer.php");
?>