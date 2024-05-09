<?php

    //Mostrar o listar todos los medicos
    function listar_medicos(){
        $medicos = array();

        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        //Realizo mi consulta para listar a todos los medicos
        $sql = "SELECT id_medico,medicos.id_persona, CONCAT(nombre,' ',apellido) as 'nombre_apellido', matricula_medico, sexo FROM personas INNER JOIN medicos ON personas.id_persona=medicos.id_persona ORDER BY nombre ASC; ";

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

                $medicos[] = $resultado;

            }
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);

        return $medicos;
    }

    //permite buscar un medico usando el ID
    function buscar_un_medico($argIdMedico){
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "SELECT * FROM medicos WHERE id_medico=:argIdMedico";
        
        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argIdMedico', $argIdMedico);  // reemplazo los parametros enlazados

      /*   $query = str_replace(
            [':argIdMedico',],
            [$argIdMedico],
            $sql
        );
        echo $query;
        die(); */
        
        if(!$statement){
            echo "Error al crear el registro";
        }else{
            $statement->execute();
        }
      
        if (!$statement) {
            // no se encontraron medicos
        } else {
            
            //Como es un solo registro no hace falta usar el while o algun bucle para iterar.
            $medico = $statement->fetch(PDO::FETCH_ASSOC);
        }

        $statement = $db->cerrar_conexion($conexion);

        return $medico;
    }
    //Permite agregar un medico
    function insertar_medicos($argMarticula,$argIdPersona){
        $ultimo_id=0;
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "INSERT INTO medicos(matricula_medico,id_persona) VALUES (:argMatricula,:argIdPersona)";
        
        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argMatricula', $argMarticula);
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

    function actualizar_medico($argIdMedico,$argMarticula){
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        $sql = "UPDATE medicos SET matricula_medico=:argMatricula WHERE id_medico=:argIdMedico";
        
        
        // preparo el sql para ejecutar
        $statement = $conexion->prepare($sql); 

        $statement->bindParam(':argIdMedico' , $argIdMedico);  // reemplazo los parametros enlazados
        $statement->bindParam(':argMatricula' , $argMarticula); 

        if(!$statement){
            echo "Error al crear el registro";
        }else{
            $statement->execute();
        }

        // cierro la conexion
        $statement->closeCursor();

        $db->cerrar_conexion($conexion);
    }

?>
