<?php
include_once("../../config/config.php");

include_once(VIEWS_DIR . "head/head.php");
include_once(BASE_DIR . "config/class.conexion.php");

include_once(MODELS_DIR . "personas/model.personas.php");
include_once(MODELS_DIR . "contactos/model.contactos.php");
include_once(MODELS_DIR . "direcciones/model.direccion.php");
include_once(MODELS_DIR . "calles/model.calles.php");
include_once(MODELS_DIR . "barrios/model.barrios.php");
include_once(MODELS_DIR . "localidades/model.localidades.php");
include_once(MODELS_DIR . "documentaciones/model.documentaciones.php");



$accion = "";

//Verificamos si existe esa variable
if (isset($accion)) {
    $accion = $_POST['accion'];
}

if ($accion == "" or $accion == "index") {
    //Lamamos por si hay algun error
    errores();

    //Lamamos a la funcion
    personas_index();
} elseif ($accion == "crear") {
    
    errores();

    personas_crear();
} elseif ($accion == "insertar") {

    errores();

    personas_insertar($_POST);
} elseif ($accion == "editar") {
    errores();

    $idPersona = $_POST['id_persona'];

    personas_editar($idPersona);
} elseif ($accion == "actualizar") {

    errores();

    personas_actualizar($_POST);
} elseif ($accion == "mostrar") {
    errores();

    $idDocumento = $_POST['id_documento'];
    $idPersona = $_POST['id_persona'];


    personas_datos_mostrar($idPersona,$idDocumento);
} elseif ($accion == "crear-persona-documento") {
    errores();

    $idPersona = $_POST['id_persona'];

    $persona=buscar_una_persona($idPersona);
    
    include_once(VIEWS_DIR . "personas/personas-documentos.php");

    
} elseif ($accion == "insertar-documento-persona") {
    
    errores();

    personas_documentos_mostrar($_POST);

}elseif ($accion == "crear-persona-contacto") {
    errores();

    $idPersona = $_POST['id_persona'];

    $persona=buscar_una_persona($idPersona);

    $calles=listar_calles();
    $barrios=listar_barrios();
    $localidades=listar_localidades();
    
    include_once(VIEWS_DIR . "personas/personas-contactos.php");

    
} elseif ($accion == "insertar-contacto-persona") {
    
    errores();

    personas_contactos_mostrar($_POST);

} elseif ($accion == "eliminar"){
    errores();

    $idPersona = $_POST['id_persona'];

    personas_eliminar($idPersona);
}

function personas_index()
{

    // Llamamos a la función del modelo para obtener los médicos
    $personas = listar_personas();

    // Incluimos la vista para mostrar los médicos
    include_once(VIEWS_DIR . "personas/personas.php");
}
function personas_crear()
{

    // Incluimos la vista para mostrar el formulario
    include_once(VIEWS_DIR . "personas/agregar.php");
}

function personas_insertar($argPOST)
{
    //Guardamos Las variables que recibimos del formulario
    $nombre = strtoupper($argPOST['nombre']);
    $apellido = strtoupper($argPOST['apellido']);
    $sexo = strtoupper($argPOST['sexo']);
    $idDocumento = $argPOST['id_documento'];



    insertar_persona($nombre, $apellido, $sexo, $idDocumento);

    header("Location:controller.personas.php");
}
function personas_editar($argIdPersona)
{
    $persona = buscar_una_persona($argIdPersona);

    include_once(VIEWS_DIR . "personas/editar.php");

}

function personas_actualizar($argPOST)
{

    //Guardamos Las variables que recibimos del formulario
    $idPersona = $argPOST['id_persona'];
    $nombre = strtoupper($argPOST['nombre_persona']);
    $apellido = strtoupper($argPOST['apellido_persona']);
    $sexo = strtoupper($argPOST['sexo']);
    $idDocumento = $argPOST['id_documento'];

    //llamo a las funciones para actualizar los datos de un medico
    actualizar_persona($idPersona, $nombre, $apellido, $sexo,$idDocumento);

    header("Location:controller.personas.php");
}
function personas_eliminar($argIdPersona)
{

    eliminar_persona($argIdPersona);

    header("Location:controller.personas.php");
}
function personas_datos_mostrar($idPersona,$idDocumento)
{
    $persona = buscar_una_persona($idPersona);
    $documento = buscar_un_documento($idDocumento);
    $contacto = buscar_un_contacto($idPersona);
/* 
    var_dump($persona = buscar_una_persona($idPersona)).'<br>';
    var_dump(buscar_un_contacto($idPersona)).'<br>';
    */
    
    //error_reporting(0);
    if (is_array($contacto)) {
        // Para llamar a las direcciones:
        $idDireccion = $contacto['id_direccion'];
/* 
        echo $idDireccion. '<br>';
        var_dump($direccion =  buscar_una_direccion($idDireccion)).'<br>';
        die(); */
        $direccion =  buscar_una_direccion($idDireccion);
        

        if (is_array($direccion)) {
            // Llamar a las calles
            $idCalle = $direccion['id_calle'];
            $calle = buscar_una_calle($idCalle);

            // Llamar a los barrios
            $idBarrio = $direccion['id_barrio'];
            $barrio = buscar_un_barrio($idBarrio);

            // Para llamar a las localidades
            $idLocalidad = $direccion['id_localidad'];
            $localidad = buscar_una_localidad($idLocalidad);
        } else {
            // Manejar el caso en el que $direccion no es un array
            $calle = $barrio = $localidad = null;
        }
    } else {
        // Manejar el caso en el que $contacto no es un array
        $direccion = $calle = $barrio = $localidad = null;
    }

    include_once(VIEWS_DIR . "personas/mostrar.php");
}

function personas_documentos_mostrar($argPOST){
    $idPersona = $argPOST['id_persona'];
    $nombre = strtoupper($argPOST['nombre']);
    $apellido = strtoupper($argPOST['apellido']);
    $sexo = strtoupper($argPOST['sexo']);

    $tipoDocumento = strtoupper($argPOST['tipo_documento']);
    $numeroDocumento = $argPOST['numero_documento'];
    $cuil = $argPOST['cuil'];
    $nroSegSocial = $argPOST['numero_seguridad_social'];

    $ultimoDocumentoId = insertar_documento($tipoDocumento,$numeroDocumento,$cuil,$nroSegSocial);
    if($ultimoDocumentoId){
        actualizar_persona($idPersona,$nombre,$apellido,$sexo,$ultimoDocumentoId);
    }

    header("Location:controller.personas.php");

    
}
function personas_contactos_mostrar($argPOST){
   
    
    $residencia = strtoupper($argPOST['residencia']);
    $idCalle = $argPOST['id_calle'];
    $alturaCalle = $argPOST['altura_calle'];
    $idBarrio = $argPOST['id_barrio'];
    $idLocalidad = $argPOST['id_localidad'];
    
    $ultimaDireccionId = insertar_direccion($residencia,$idBarrio,$idCalle,$alturaCalle,$idLocalidad);

    $telefono = $argPOST['telefono'];

    $idPersona = $argPOST['id_persona'];

    insertar_contacto($telefono,$ultimaDireccionId,$idPersona);

    header("Location:controller.personas.php");

    
}




function errores()
{
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}
/* 

*/
include_once(VIEWS_DIR . "head/footer.php");
?>