<?php


include_once("../../config/config.php");

include_once(BASE_DIR."config/class.conexion.php");

include VIEWS_DIR."head/head.php"; 

include_once(MODELS_DIR."consultas/model.consultas.php");

include_once(MODELS_DIR."pacientes/model.pacientes.php");

include_once(MODELS_DIR."medicos/model.medicos.php");

include_once(MODELS_DIR."personas/model.personas.php");


$accion="";
//Verificamos si existe esa variable
if (isset($accion)) {
    $accion=$_POST['accion'];
}else{
    $accion='index';
   
}

if($accion=="index"){
    errores();

    consultas_index();
}elseif($accion == "mostrar"){
    //Lamamos por si hay algun error
    errores();

    $idPaciente=$_POST['id_paciente'];
        
    //Lamamos a la funcion
    consultas_pacientes_mostrar($idPaciente);
}elseif($accion == "crear"){
    errores();

    $idPaciente=$_POST['id_paciente'];
    
   
    consultas_crear($idPaciente);
}elseif($accion == "insertar"){
    errores();
    
    consultas_insertar($_POST);
}

function consultas_pacientes_mostrar($argIdPaciente){
    $consultas = buscar_consultas($argIdPaciente);
    $idPaciente=$argIdPaciente;
    include VIEWS_DIR."consultas/mostrar.consultas.paciente.php";

}
function consultas_index(){
    include VIEWS_DIR."consultas/buscar.php";
}
function consultas_crear($argIdPaciente){

    $paciente=buscar_un_paciente($argIdPaciente);
    
    $idPersona=$paciente['id_persona'];

    $persona=buscar_una_persona($idPersona);

    $medicos=listar_medicos();

    include VIEWS_DIR."consultas/agregar.php";
}
function consultas_insertar($argPOST){
    $descripcionConsulta=strtoupper($argPOST['descripcion_consulta']);
    $idPaciente=$argPOST['id_paciente'];
    $idMedico=$argPOST['id_medico'];
    $fecha=$argPOST['fecha'];
    $hora=$argPOST['hora'];
    
 
    
    insertar_consultas($descripcionConsulta,$fecha,$hora,$idMedico,$idPaciente);

    
    header("Location:../pacientes/controller.pacientes.php");
    
}


function errores(){
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}


include VIEWS_DIR."head/footer.php"; 
?>