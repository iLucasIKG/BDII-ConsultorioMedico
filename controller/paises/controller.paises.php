<?php
    include_once("../../config/config.php");

    include_once(VIEWS_DIR . "head/head.php");
    include_once(BASE_DIR."config/class.conexion.php");
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
        paises_index();
    }
    elseif ($accion == "crear") {

        errores();

        paises_crear();
    }elseif ($accion == "insertar") {

        errores();

        paises_insertar($_POST);
    }elseif ($accion == "editar") {
        errores();

        $idPais=$_POST['id_pais'];

        paises_editar($idPais);
    }elseif ($accion == "actualizar") {
        errores();

        paises_actualizar($_POST);
    }elseif ($accion == "eliminar") {
        errores();

        $idPais=$_POST['id_pais'];

        paises_eliminar($idPais);
    }

    function paises_index() {

        // Llamamos a la función del modelo para obtener los médicos
        $paises = listar_paises();

        // Incluimos la vista para mostrar los médicos
        include_once(VIEWS_DIR."paises/paises.php");
    }
    function paises_crear(){

        // Incluimos la vista para mostrar el formulario
        include_once(VIEWS_DIR."paises/agregar.php");
    }
    
    function paises_insertar($argPOST){
        //Guardamos Las variables que recibimos del formulario
        $nombrePais = strtoupper($argPOST['nombre_pais']);
       
        insertar_pais($nombrePais);

        header("Location:controller.paises.php");
    }
    function paises_editar($argIdPais){
        $pais = buscar_un_pais($argIdPais);

        include_once(VIEWS_DIR."paises/editar.php");
        
    }function paises_actualizar($argPOST){
        
        //Guardamos Las variables que recibimos del formulario
        $idPais = $argPOST['id_pais'];
        $nombrePais = strtoupper($argPOST['nombre_pais']);
        
        //llamo a las funciones para actualizar los datos de un medico
        actualizar_pais($idPais,$nombrePais);
        
        header("Location:controller.paises.php");
    }
    function paises_eliminar($argIdPais){

        eliminar_pais($argIdPais);

        header("Location:controller.paises.php");
    }
 


    function errores(){
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }
/* 

*/
include_once(VIEWS_DIR . "head/footer.php");
?>