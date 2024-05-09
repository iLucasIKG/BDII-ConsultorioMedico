<?php
    include_once("../../config/config.php");

    include_once(VIEWS_DIR . "head/head.php");
    include_once(BASE_DIR."config/class.conexion.php");
    include_once(MODELS_DIR . "puestos-trabajos/model.puesto-trabajo.php");


    $accion="";

   //Verificamos si existe esa variable
    if (isset($accion)) {
        $accion=$_POST['accion'];
    } 

    if ($accion == "" OR $accion == "index") {
        //Lamamos por si hay algun error
        errores();

        //Lamamos a la funcion
        puestos_trabajos_index();
    }
    elseif ($accion == "crear") {

        errores();

        puestos_trabajos_crear();
    }elseif ($accion == "insertar") {

        errores();

        puestos_trabajos_insertar($_POST);
    }elseif ($accion == "editar") {
        errores();

        $idPuestoTrabajo=$_POST['id_puesto_trabajo'];

        puestos_trabajos_editar($idPuestoTrabajo);
    }elseif ($accion == "actualizar") {
        errores();

        puestos_trabajos_actualizar($_POST);
    }elseif ($accion == "eliminar") {
        errores();

        $idPuestoTrabajo=$_POST['id_puesto_trabajo'];

        puestos_trabajos_eliminar($idPuestoTrabajo);
    }

    function puestos_trabajos_index() {

        // Llamamos a la función del modelo para obtener los médicos
        $puestos_trabajos = listar_puestos_trabajos();

        // Incluimos la vista para mostrar los médicos
        include_once(VIEWS_DIR."puestos-trabajos/puestos-trabajos.php");
    }
    function puestos_trabajos_crear(){

        // Incluimos la vista para mostrar el formulario
        include_once(VIEWS_DIR."puestos-trabajos/agregar.php");
    }
    
    function puestos_trabajos_insertar($argPOST){
        //Guardamos Las variables que recibimos del formulario
        $nombrePuestoTrabajo = strtoupper($argPOST['nombre_puesto_trabajo']);
       
        insertar_puesto_trabajo($nombrePuestoTrabajo);

        header("Location:controller.puestos-trabajos.php");
    }
    function puestos_trabajos_editar($argidPuestoTrabajo){
        $puesto_trabajo = buscar_un_puesto_trabajo($argidPuestoTrabajo);

        include_once(VIEWS_DIR."puestos-trabajos/editar.php");
        
    }function puestos_trabajos_actualizar($argPOST){
        
        //Guardamos Las variables que recibimos del formulario
        $idPuestoTrabajo = $argPOST['id_puesto_trabajo'];
        $nombrePuestoTrabajo = strtoupper($argPOST['nombre_puesto_trabajo']);
        
        //llamo a las funciones para actualizar los datos de un medico
        actualizar_puesto_trabajo($idPuestoTrabajo,$nombrePuestoTrabajo);
        
        header("Location:controller.puestos-trabajos.php");
    }
    function puestos_trabajos_eliminar($argidPuestoTrabajo){

        eliminar_puesto_trabajo($argidPuestoTrabajo);

        header("Location:controller.puestos-trabajos.php");
    }
 


    function errores(){
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }
/* 

*/
include_once(VIEWS_DIR . "head/footer.php");
?>