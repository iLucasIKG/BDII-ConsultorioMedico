<?php
    include_once("../../config/config.php");

    include_once(VIEWS_DIR."head/head.php");

    include_once(BASE_DIR."config/class.conexion.php");
    include_once(MODELS_DIR . "barrios/model.barrios.php");
    

    $accion="";

   //Verificamos si existe esa variable
    if (isset($accion)) {
        $accion=$_POST['accion'];
    } 

    if ($accion == "" OR $accion == "index") {
        //Lamamos por si hay algun error
        errores();

        //Lamamos a la funcion
        barrios_index();
    }elseif ($accion == "crear") {

        errores();

        barrios_crear();
    }elseif ($accion == "insertar") {

        errores();

        barrios_insertar($_POST);
    }elseif ($accion == "editar") {
        errores();

        $idBarrio=$_POST['id_barrio'];

        barrios_editar($idBarrio);
    }elseif ($accion == "actualizar") {
        errores();

        barrios_actualizar($_POST);
    }elseif ($accion == "eliminar") {
        errores();

        $idBarrio=$_POST['id_barrio'];

        barrios_eliminar($idBarrio);
    }


    function barrios_index() {

        // Llamamos a la función del modelo para obtener los médicos
        $barrios = listar_barrios();

        // Incluimos la vista para mostrar los médicos
        include VIEWS_DIR."barrios/barrios.php";
    }
    function barrios_crear(){

        // Incluimos la vista para mostrar el formulario
        include VIEWS_DIR."barrios/agregar.php";
    }
    
    function barrios_insertar($argPOST){
        //Guardamos Las variables que recibimos del formulario
        $nombreBarrio = strtoupper($argPOST['nombre_barrio']);

        insertar_barrio($nombreBarrio);

        header("Location:controller.barrios.php");
    }
    function barrios_editar($argIdBarrio){
        $barrio = buscar_un_barrio($argIdBarrio);

        include VIEWS_DIR."barrios/editar.php";
        
    }function barrios_actualizar($argPOST){
        
        //Guardamos Las variables que recibimos del formulario
        $idBarrio = $argPOST['id_barrio'];
        $nombreBarrio = strtoupper($argPOST['nombre_barrio']);
        
        //llamo a las funciones para actualizar los datos de un medico
        actualizar_barrio($idBarrio,$nombreBarrio);
        
        header("Location:controller.barrios.php");
    }
    function barrios_eliminar($argIdBarrio){

        eliminar_barrio($argIdBarrio);

        header("Location:controller.barrios.php");
    }
 


    function errores(){
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }
/* 




    
    function barrios_eliminar($argIdPersona){

        eliminar_persona($argIdPersona);

        header("Location:controller.medicos.php");
    }
 
*/
include_once(VIEWS_DIR."head/footer.php");

?>