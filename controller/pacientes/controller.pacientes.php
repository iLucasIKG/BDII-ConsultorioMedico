<?php
    include "../../config/config.php";

    include_once(VIEWS_DIR."head/head.php");

    include BASE_DIR."config/class.conexion.php";
    include MODELS_DIR . "pacientes/model.pacientes.php";
    include MODELS_DIR . "personas/model.personas.php";


    $accion="";

   //Verificamos si existe esa variable
    if (isset($accion)) {
        $accion=$_POST['accion'];
    } 

    if ($accion == "" OR $accion == "index") {
        //Lamamos por si hay algun error
        errores();

        //Lamamos a la funcion
        pacientes_index();
    }elseif ($accion == "crear") {

        errores();

        pacientes_crear();
    }elseif ($accion == "insertar") {

        errores();

        pacientes_insertar($_POST);
    }elseif ($accion == "editar") {
        errores();

        $idPaciente=$_POST['id_paciente'];
        $idPersona=$_POST['id_persona'];

        pacientes_editar($idPaciente,$idPersona);
    }elseif ($accion == "actualizar") {
        errores();

        pacientes_actualizar($_POST);
    }elseif ($accion == "eliminar") {
        errores();

        $idPersona=$_POST['id_persona'];

        pacientes_eliminar($idPersona);
    }elseif ($accion == "mostrar") {
        errores();

        $idPaciente=$_POST['id_paciente'];

        consultas_pacientes_mostrar($idPaciente);
    
    }


    function pacientes_index() {

        // Llamamos a la función del modelo para obtener los médicos
        $pacientes = listar_pacientes();

        // Incluimos la vista para mostrar los médicos
        include VIEWS_DIR."pacientes/pacientes.php";
    }
    function pacientes_crear(){

        // Incluimos la vista para mostrar el formulario
        include VIEWS_DIR."pacientes/agregar.php";
    }
    
    function pacientes_insertar($argPOST){
        //Guardamos Las variables que recibimos del formulario
        $nombre = strtoupper($argPOST['nombre']);
        $apellido = strtoupper($argPOST['apellido']);
        $sexo = strtoupper($argPOST['sexo']);
        $idDocumento = !empty($argPOST['id_documento']) ? intval($argPOST['id_documento']) : NULL;
        $informacionMedica = strtoupper('Informacion Medica de '.$nombre.' '.$apellido);

        $ultimaPersonaId=insertar_persona($nombre,$apellido,$sexo,$idDocumento);
        //llamo a la funcion para agrgar un medico
        insertar_paciente($informacionMedica,$ultimaPersonaId);

        header("Location:controller.pacientes.php");
    }
    function pacientes_editar($argIdPaciente,$argIdPersona){
        $paciente = buscar_un_paciente($argIdPaciente);
        $persona = buscar_una_persona($argIdPersona);

        include VIEWS_DIR."pacientes/editar.php";
        
    }function pacientes_actualizar($argPOST){
        //Guardamos Las variables que recibimos del formulario
        $idPersona = $argPOST['id_persona'];
        $nombre = strtoupper($argPOST['nombre']);
        $apellido = strtoupper($argPOST['apellido']);
        $sexo = strtoupper($argPOST['sexo']);
        $idDocumento = $argPOST['id_documento'];
        $informacionMedica = strtoupper($argPOST['informacion_medica']);
        
        //llamo a las funciones para actualizar los datos de un medico
        actualizar_persona($idPersona,$nombre,$apellido,$sexo,$idDocumento);
        
        actualizar_paciente($idPersona,$informacionMedica);
        
        header("Location:controller.pacientes.php");
    }
    function pacientes_eliminar($argIdPersona){

        eliminar_persona($argIdPersona);

        header("Location:controller.pacientes.php");
    }


    function errores(){
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }

    include_once(VIEWS_DIR."head/footer.php");


?>