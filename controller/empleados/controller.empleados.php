<?php
    include "../../config/config.php";

    include_once(VIEWS_DIR."head/head.php");

    include BASE_DIR."config/class.conexion.php";
    include MODELS_DIR . "empleados/model.empleados.php";
    include MODELS_DIR . "personas/model.personas.php";
    include MODELS_DIR . "puestos-trabajos/model.puesto-trabajo.php";


    $accion="";

   //Verificamos si existe esa variable
    if (isset($accion)) {
        $accion=$_POST['accion'];
    } 

    if ($accion == "" OR $accion == "index") {
        //Lamamos por si hay algun error
        errores();

        //Lamamos a la funcion
        empleados_index();
    }elseif ($accion == "crear") {

        errores();

        empleados_crear();
    }elseif ($accion == "insertar") {

        errores();

        empleados_insertar($_POST);
    }elseif ($accion == "editar") {
        errores();

        $idEmpleado=$_POST['id_empleado'];
        $idPersona=$_POST['id_persona'];

        empleados_editar($idEmpleado,$idPersona);
    }elseif ($accion == "actualizar") {
        errores();

        empleados_actualizar($_POST);
    }elseif ($accion == "eliminar") {
        errores();

        $idPersona=$_POST['id_persona'];

        empleados_eliminar($idPersona);
    }


    function empleados_index() {

        // Llamamos a la función del modelo para obtener los médicos
        $empleados = listar_empleados();

       

        // Incluimos la vista para mostrar los médicos
        include VIEWS_DIR."empleados/empleados.php";
    }
    function empleados_crear(){
        $puestos_trabajos=listar_puestos_trabajos();

        // Incluimos la vista para mostrar el formulario
        include VIEWS_DIR."empleados/agregar.php";
    }
    
    function empleados_insertar($argPOST){
        //Guardamos Las variables que recibimos del formulario
        $nombre = strtoupper($argPOST['nombre']);
        $apellido = strtoupper($argPOST['apellido']);
        $sexo = strtoupper($argPOST['sexo']);
        $idPuestoTrabajo = $argPOST['id_puesto_trabajo'];

        $ultimaPersonaId=insertar_persona($nombre,$apellido,$sexo);
        //llamo a la funcion para agrgar un medico
        insertar_empleado($ultimaPersonaId,$idPuestoTrabajo);

        header("Location:controller.empleados.php");
    }
    function empleados_editar($argIdEmpleado,$argIdPersona){
        $empleado = buscar_un_empleado($argIdEmpleado);
        $persona = buscar_una_persona($argIdPersona);
        $puestos_trabajos = listar_puestos_trabajos();

        include VIEWS_DIR."empleados/editar.php";
        
    }function empleados_actualizar($argPOST){
        //Guardamos Las variables que recibimos del formulario

        

        $idPersona = $argPOST['id_persona'];
        $idPuestoTrabajo = $argPOST['id_puesto_trabajo'];
        $idEmpleado = $argPOST['informacion_medica'];
        $nombre = strtoupper($argPOST['nombre']);
        $apellido = strtoupper($argPOST['apellido']);
        $sexo = strtoupper($argPOST['sexo']);
        
        //llamo a las funciones para actualizar los datos de un medico
        actualizar_persona($idPersona,$nombre,$apellido,$sexo);
        
        actualizar_empleado($idEmpleado,$idPersona,$idPuestoTrabajo);
        
        header("Location:controller.empleados.php");
    }
    function empleados_eliminar($argIdPersona){

        eliminar_persona($argIdPersona);

        header("Location:controller.empleados.php");
    }


    function errores(){
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }

    include_once(VIEWS_DIR."head/footer.php");


?>