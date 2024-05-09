<?php
    include_once("../../config/config.php");

    include_once(VIEWS_DIR."head/head.php");

    include_once(BASE_DIR."config/class.conexion.php");
    include_once(MODELS_DIR . "provincias/model.provincias.php");
    include_once(MODELS_DIR . "paises/model.paises.php");
    

    $accion="";

   //Verificamos si existe esa variable
    if (isset($accion)) {
        $accion=$_POST['accion'];
    } 

    if ($accion == "" OR $accion == "index") {
        //Lamamos por si hay algun error
        errores();

        //Lamamos a la funcion
        provincias_index();
    }elseif ($accion == "crear") {

        errores();

        provincias_crear();
    }elseif ($accion == "insertar") {

        errores();

        provincias_insertar($_POST);
    }elseif ($accion == "editar") {
        errores();

        $idProvincia=$_POST['id_provincia'];

        provincias_editar($idProvincia);
    }elseif ($accion == "actualizar") {
        errores();

        provincias_actualizar($_POST);
    }elseif ($accion == "eliminar") {
        errores();

        $idProvincia=$_POST['id_provincia'];

        provincias_eliminar($idProvincia);
    }


    function provincias_index() {

        // Llamamos a la función del modelo para obtener los médicos
        $provincias = listar_provincias();

        // Incluimos la vista para mostrar los médicos
        include VIEWS_DIR."provincias/provincias.php";
    }
    function provincias_crear(){

        // Incluimos la vista para mostrar el formulario
        $paises=listar_paises();
        
        include VIEWS_DIR."provincias/agregar.php";
    }
    
    function provincias_insertar($argPOST){
        //Guardamos Las variables que recibimos del formulario
        $nombreProvincia = strtoupper($argPOST['nombre_provincia']);
        $idPais = $argPOST['id_pais'];
    

        insertar_provincia($nombreProvincia,$idPais);

        header("Location:controller.provincias.php");
    }
    function provincias_editar($argIdProvincia){
        $provincia = buscar_una_provincia($argIdProvincia);
        $paises = listar_paises();

        include VIEWS_DIR."provincias/editar.php";
        
    }function provincias_actualizar($argPOST){
        
        
        //Guardamos Las variables que recibimos del formulario
        $idProvincia = $argPOST['id_provincia'];
        $nombreProvincia = strtoupper($argPOST['nombre_provincia']);
        $idPais = $argPOST['id_pais'];  
        
        //llamo a las funciones para actualizar los datos de un medico
        actualizar_provincia($idProvincia,$nombreProvincia,$idPais);
        
        header("Location:controller.provincias.php");
    }
    function provincias_eliminar($argIdProvincia){

        eliminar_provincia($argIdProvincia);

        header("Location:controller.provincias.php");
    }
 


    function errores(){
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }
/* 


*/
include_once(VIEWS_DIR."head/footer.php");

?>