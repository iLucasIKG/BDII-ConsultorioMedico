<?php
    include_once("../../config/config.php");

    include_once(VIEWS_DIR."head/head.php");

    include_once(BASE_DIR."config/class.conexion.php");
    include_once(MODELS_DIR . "localidades/model.localidades.php");
    include_once(MODELS_DIR . "provincias/model.provincias.php");
    

    $accion="";

   //Verificamos si existe esa variable
    if (isset($accion)) {
        $accion=$_POST['accion'];
    } 

    if ($accion == "" OR $accion == "index") {
        //Lamamos por si hay algun error
        errores();

        //Lamamos a la funcion
        localidades_index();
    }elseif ($accion == "crear") {

        errores();

        localidades_crear();
    }elseif ($accion == "insertar") {

        errores();

        localidades_insertar($_POST);
    }elseif ($accion == "editar") {
        errores();

        $idLocalidad=$_POST['id_localidad'];

        localidades_editar($idLocalidad);
    }elseif ($accion == "actualizar") {
        errores();

        localidades_actualizar($_POST);
    }elseif ($accion == "eliminar") {
        errores();

        $idLocalidad=$_POST['id_localidad'];

        localidades_eliminar($idLocalidad);
    }


    function localidades_index() {

        // Llamamos a la función del modelo para obtener los médicos
        $localidades = listar_localidades();

        // Incluimos la vista para mostrar los médicos
        include VIEWS_DIR."localidades/localidades.php";
    }
    function localidades_crear(){
        $provincias=listar_provincias();
        // Incluimos la vista para mostrar el formulario
        include VIEWS_DIR."localidades/agregar.php";
    }
    
    function localidades_insertar($argPOST){
        //Guardamos Las variables que recibimos del formulario
        $nombreLocalidad = strtoupper($argPOST['nombre_localidad']);
        $codigoPostal = $argPOST['codigo_postal'];
        $idProvincia = $argPOST['id_provincia'];

        insertar_localidad($nombreLocalidad,$codigoPostal,$idProvincia);

        header("Location:controller.localidades.php");
    }
    function localidades_editar($argidLocalidad){
        $localidad = buscar_una_localidad($argidLocalidad);
        $provincias = listar_provincias();

        include VIEWS_DIR."localidades/editar.php";
        
    }function localidades_actualizar($argPOST){
        
        //Guardamos Las variables que recibimos del formulario
        $idLocalidad = $argPOST['id_localidad'];
        $nombreLocalidad = strtoupper($argPOST['nombre_localidad']);
        $codigoPostal = $argPOST['codigo_postal'];
        $idProvincia = $argPOST['id_provincia'];

        

        
        //llamo a las funciones para actualizar los datos de un medico
        actualizar_localidad($idLocalidad,$nombreLocalidad,$codigoPostal,$idProvincia);
        
        header("Location:controller.localidades.php");
    }
    function localidades_eliminar($argidLocalidad){

        eliminar_localidad($argidLocalidad);

        header("Location:controller.localidades.php");
    }
 


    function errores(){
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }
/* 




    
    function localidades_eliminar($argIdPersona){

        eliminar_persona($argIdPersona);

        header("Location:controller.medicos.php");
    }
 
*/
include_once(VIEWS_DIR."head/footer.php");

?>