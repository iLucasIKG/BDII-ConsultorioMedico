<?php

    //Mostrar o listar todos los medicos
    function listar_pacientes(){
        $pacientes = array();

        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        //Realizo mi consulta para listar a todos los medicos
        $sql = "SELECT personas.id_persona,id_paciente, informacion_medica,CONCAT(nombre,' ',apellido) AS paciente FROM pacientes LEFT JOIN personas ON personas.id_persona=pacientes.id_persona ORDER BY nombre ASC";

        //preparo mi consulta para ejecutarla:
        $statement = $conexion->prepare($sql);

        if(!$statement){
            echo "Error al listar los registro";
        }else{
            $statement->execute();
        }
      
        if (!$statement) {
            // no se encontraron medicos
        }
        else {
        
            // reviso el retorno

            while($resultado = $statement->fetch(PDO::FETCH_ASSOC)){

                $pacientes[] = $resultado;

            }
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);

        return $pacientes;
    }

    //permite buscar un medico usando el ID
    function buscar_un_paciente($argIdPaciente){
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "SELECT * FROM pacientes WHERE id_paciente=:argIdPaciente";
        
        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argIdPaciente', $argIdPaciente);  // reemplazo los parametros enlazados

        
        if(!$statement){
            echo "Error al crear el registro";
        }else{
            $statement->execute();
        }
      
        if (!$statement) {
            // no se encontraron medicos
        } else {
            
            //Como es un solo registro no hace falta usar el while o algun bucle para iterar.
            $paciente = $statement->fetch(PDO::FETCH_ASSOC);
        }

        $statement = $db->cerrar_conexion($conexion);

        return $paciente;
    }
    //Permite agregar un medico
    function insertar_paciente($argInfromacionMedica,$argIdPersona){
        $ultimo_id=0;
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "INSERT INTO pacientes(informacion_medica,id_persona) VALUES (:argInformacionMedica,:argIdPersona)";
        
        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argInformacionMedica', $argInfromacionMedica);
        $statement->bindParam(':argIdPersona', $argIdPersona);  // reemplazo los parametros enlazados

        
        
        if(!$statement){
            echo "Error al crear el registro";
        }else{
            $statement->execute();
        }
        
        $ultimo_id = $conexion->lastinsertid();
       
        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);

        return $ultimo_id;
    }
    
    function actualizar_paciente($argIdPersona,$argInfromacionMedica){
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        $sql = "UPDATE pacientes SET informacion_medica=:argInformacionMedica WHERE id_persona=:argIdPersona";
        
        
        // preparo el sql para ejecutar
        $statement = $conexion->prepare($sql); 

        $statement->bindParam(':argIdPersona' , $argIdPersona);  // reemplazo los parametros enlazados
        $statement->bindParam(':argInformacionMedica' , $argInfromacionMedica); 

        if(!$statement){
            echo "Error al crear el registro";
        }else{
            $statement->execute();
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);
    }
  
    
?>
