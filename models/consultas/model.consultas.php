<?php

    //Mostrar o listar todos los medicos
    function buscar_consultas($argIdPaciente){
        $consultas = array();

        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        //Realizo mi consulta para listar a todos los medicos
        $sql = "SELECT consultas.id_consulta,pacientes.id_paciente, consultas.descripcion_consulta,fecha,hora, CONCAT( pacientes_personas.nombre ,' ', pacientes_personas.apellido) AS 'Paciente', CONCAT(medicos_personas.nombre,' ', medicos_personas.apellido) AS 'Medico Asignado' FROM consultas LEFT JOIN pacientes ON pacientes.Id_paciente = consultas.id_paciente LEFT JOIN personas AS pacientes_personas ON pacientes.id_persona = pacientes_personas.id_persona LEFT JOIN medicos ON medicos.id_medico = consultas.id_medico LEFT JOIN personas AS medicos_personas ON medicos.id_persona = medicos_personas.id_persona WHERE consultas.id_paciente=:argIdPaciente";

        //preparo mi consulta para ejecutarla:
        $statement = $conexion->prepare($sql);

        $statement->bindParam(':argIdPaciente', $argIdPaciente);  // reemplazo los parametros enlazados

        
        if(!$statement){
            echo "
                <div class='alert alert-danger' role='alert'>
                    Error al traer los resultados.
                </div>
                ";
        }else{
            $statement->execute();
        }
      
      
        if (!$statement) {
         //No hubo Resultados
        }
        else {
        
            // reviso el retorno

            while($resultado = $statement->fetch(PDO::FETCH_ASSOC)){

                $consultas[] = $resultado;

            }
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);

        return $consultas;
    }

    function insertar_consultas($argDescripcionConsulta,$argFecha,$argHora,$argIdMedico,$argIdPaciente){
        $ultimo_id=0;
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "INSERT INTO consultas(descripcion_consulta,fecha,hora,id_medico, id_paciente) VALUES ( :argDescripcionConsulta,:argFecha,:argHora, :argIdMedico, :argIdPaciente)";
        
        
        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argDescripcionConsulta', $argDescripcionConsulta);
        $statement->bindParam(':argFecha', $argFecha);
        $statement->bindParam(':argHora', $argHora);
        $statement->bindParam(':argIdMedico', $argIdMedico);
        $statement->bindParam(':argIdPaciente', $argIdPaciente); 
        
        
        
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
