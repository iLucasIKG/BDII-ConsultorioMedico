<?php

    include_once("../../config/config.php");

    include_once(VIEWS_DIR."head/head.php");

    include_once(BASE_DIR."config/class.conexion.php");
    include_once(MODELS_DIR."medicos/model.medicos.php");
    include_once(MODELS_DIR."personas/model.personas.php");

    $accion="";

    //Verificamos si existe esa variable
    if (isset($accion)) {
        $accion=$_POST['accion'];
    }

    if ($accion == "" OR $accion == "index") {
        //Lamamos por si hay algun error
        errores();

        //Lamamos a la funcion
        medicos_index();
    }elseif ($accion == "crear") {

        errores();

        medicos_crear();
    }elseif ($accion == "insertar") {

        errores();

        medicos_insertar($_POST);
    }elseif ($accion == "editar") {
        errores();

        $idMedico=$_POST['id_medico'];
        $idPersona=$_POST['id_persona'];
        

        medicos_editar($idMedico,$idPersona);
    }elseif ($accion == "actualizar") {
        errores();

        medicos_actualizar($_POST);
    }elseif ($accion == "eliminar") {
        errores();

        $idPersona=$_POST['id_persona'];

        medicos_eliminar($idPersona);
    
    }

    function medicos_index() {

        // Llamamos a la función del modelo para obtener los médicos
        $medicos = listar_medicos();

        // Incluimos la vista para mostrar los médicos
        include_once(VIEWS_DIR."medicos/medicos.php");
    }

    function medicos_crear(){

        // Incluimos la vista para mostrar el formulario
        include_once(VIEWS_DIR."medicos/agregar.php");
    }
    function medicos_insertar($argPOST){

        //Guardamos Las variables que recibimos del formulario
        $nombre = strtoupper($argPOST['nombre']);
        $apellido = strtoupper($argPOST['apellido']);
        $sexo = strtoupper($argPOST['sexo']);
        $matricula = strtoupper($argPOST['matricula']);
        $idDocumento = !empty($argPOST['id_documento']) ? intval($argPOST['id_documento']) : NULL;


        $ultimaPersonaId=insertar_persona($nombre,$apellido,$sexo,$idDocumento);
        //llamo a la funcion para agrgar un medico
        insertar_medicos($matricula,$ultimaPersonaId);

        header("Location:controller.medicos.php");
    }
    function medicos_editar($argIdMedico,$argIdPersona){
        $medico = buscar_un_medico($argIdMedico);
        $persona = buscar_una_persona($argIdPersona);

        include_once(VIEWS_DIR."medicos/editar.php");
        
    }
    function medicos_actualizar($argPOST){
        //Guardamos Las variables que recibimos del formulario
        $idMedico = $argPOST['id_medico'];
        $idPersona = $argPOST['id_persona'];
        $nombre = strtoupper($argPOST['nombre']);
        $apellido = strtoupper($argPOST['apellido']);
        $sexo = strtoupper($argPOST['sexo']);
        $matricula = strtoupper($argPOST['matricula']);
        $idDocumento = !empty($argPOST['id_documento']) ? intval($argPOST['id_documento']) : NULL;
        
        //llamo a las funciones para actualizar los datos de un medico
        actualizar_persona($idPersona,$nombre,$apellido,$sexo,$idDocumento);
        
        actualizar_medico($idMedico,$matricula);
        
        header("Location:controller.medicos.php");
    }
    function medicos_eliminar($argIdPersona){

        eliminar_persona($argIdPersona);

        header("Location:controller.medicos.php");
    }
 

    function errores(){
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }

    include_once(VIEWS_DIR."head/footer.php");
?>
