<?php
    include_once("../../config/config.php");

    include_once(VIEWS_DIR . "head/head.php");
    include_once(BASE_DIR."config/class.conexion.php");
    include_once(MODELS_DIR . "direcciones/model.direccion.php");
    include_once(MODELS_DIR . "barrios/model.barrios.php");
    include_once(MODELS_DIR . "calles/model.calles.php");
    include_once(MODELS_DIR . "localidades/model.localidades.php");

    $accion="";

   //Verificamos si existe esa variable
    if (isset($accion)) {
        $accion=$_POST['accion'];
    } 

    if ($accion == "" OR $accion == "index") {
        //Lamamos por si hay algun error
        errores();

        //Lamamos a la funcion
        direccion_index();
    }
    elseif ($accion == "crear") {

        errores();

        direccion_crear();
    }elseif ($accion == "insertar") {

        errores();

        direccion_insertar($_POST);
    }elseif ($accion == "editar") {
        errores();

        $idDireccion=$_POST['id_direccion'];
    

        direccion_editar($idDireccion);
    } elseif ($accion == "actualizar") {
        errores();

        direccion_actualizar($_POST);
    }elseif ($accion == "eliminar") {
        errores();

         $idCalle=$_POST['id_calle'];

        direccion_eliminar($idDireccion);
    }

    function direccion_index() {

        // Llamamos a la función del modelo para obtener los médicos
        $direcciones = listar_direcciones();

        // Incluimos la vista para mostrar los médicos
        include_once(VIEWS_DIR."direcciones/direccion.php");
    }
    function direccion_crear(){

        $calles= listar_calles();
        $barrios = listar_barrios();
        $localidades = listar_localidades();

        // Incluimos la vista para mostrar el formulario
        include_once(VIEWS_DIR."direcciones/agregar.php");
    }
    
    function direccion_insertar($argPOST){
        //Guardamos Las variables que recibimos del formulario
        $residencia = strtoupper($argPOST['residencia']);
        $idCalle = $argPOST['id_calle'];
        $alturaCalle = $argPOST['altura_calle'];
        $idBarrio = $argPOST['id_barrio'];
        $idLocalidad = $argPOST['id_localidad'];
       
        insertar_direccion($residencia,$idBarrio,$idCalle,$alturaCalle,$idLocalidad);

        header("Location:controller.direccion.php");
    }
  function direccion_editar($argIdDireccion){
        $direccion = buscar_una_direccion($argIdDireccion);
        $calles= listar_calles();
        $barrios = listar_barrios();
        $localidades = listar_localidades();


        include_once(VIEWS_DIR."direcciones/editar.php");
        
    } 
    function direccion_actualizar($argPOST){
        
        //Guardamos Las variables que recibimos del formulario
        $idDireccion = $argPOST['id_direccion'];
        $idCalle = $argPOST['id_calle'];
        $alturaCalle = $argPOST['altura_calle'];
        $idBarrio = $argPOST['id_calle'];
        
        
        //llamo a las funciones para actualizar los datos de un medico
        actualizar_direccion($idDireccion,$idCalle,$alturaCalle,$idBarrio);
        
        header("Location:controller.direccion.php");
    } 
    function direccion_eliminar($argIdDireccion){

        eliminar_direccion($argIdDireccion);

        header("Location:controller.direccion.php");
    }
 


    function errores(){
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }
/* 

*/
include_once(VIEWS_DIR . "head/footer.php");
?>