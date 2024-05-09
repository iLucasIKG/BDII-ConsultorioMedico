<?php
    include_once("../../config/config.php");

    include_once(VIEWS_DIR . "head/head.php");
    include_once(BASE_DIR."config/class.conexion.php");
    include_once(MODELS_DIR . "calles/model.calles.php");



    $accion="";

   //Verificamos si existe esa variable
    if (isset($accion)) {
        $accion=$_POST['accion'];
    } 

    if ($accion == "" OR $accion == "index") {
        //Lamamos por si hay algun error
        errores();

        //Lamamos a la funcion
        calles_index();
    }
    elseif ($accion == "crear") {

        errores();

        calles_crear();
    }elseif ($accion == "insertar") {

        errores();

        calles_insertar($_POST);
    }elseif ($accion == "editar") {
        errores();

        $idCalle=$_POST['id_calle'];

        calles_editar($idCalle);
    }elseif ($accion == "actualizar") {
        errores();

        calles_actualizar($_POST);
    }elseif ($accion == "eliminar") {
        errores();

        $idCalle=$_POST['id_calle'];

        calles_eliminar($idCalle);
    }

    function calles_index() {

        // Llamamos a la función del modelo para obtener los médicos
        $calles = listar_calles();

        // Incluimos la vista para mostrar los médicos
        include_once(VIEWS_DIR."calles/calles.php");
    }
    function calles_crear(){

        // Incluimos la vista para mostrar el formulario
        include_once(VIEWS_DIR."calles/agregar.php");
    }
    
    function calles_insertar($argPOST){
        //Guardamos Las variables que recibimos del formulario
        $nombreCalle = strtoupper($argPOST['nombre_calle']);
       
        insertar_calle($nombreCalle);

        header("Location:controller.calles.php");
    }
    function calles_editar($argIdCalle){
        $calle = buscar_una_calle($argIdCalle);

        include_once(VIEWS_DIR."calles/editar.php");
        
    }function calles_actualizar($argPOST){
        
        //Guardamos Las variables que recibimos del formulario
        $idCalle = $argPOST['id_calle'];
        $nombreCalle = strtoupper($argPOST['nombre_calle']);
        
        //llamo a las funciones para actualizar los datos de un medico
        actualizar_calle($idCalle,$nombreCalle);
        
        header("Location:controller.calles.php");
    }
    function calles_eliminar($argIdCalle){

        eliminar_calle($argIdCalle);

        header("Location:controller.calles.php");
    }
 


    function errores(){
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }
/* 

*/
include_once(VIEWS_DIR . "head/footer.php");
?>