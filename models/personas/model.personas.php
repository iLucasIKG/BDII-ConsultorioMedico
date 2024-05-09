<?php
    function listar_personas(){
        $personas = array();

        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        //Realizo mi consulta para listar a todos los medicos
        $sql = "SELECT * FROM personas WHERE id_persona NOT IN (0)";

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

                $personas[] = $resultado;

            }
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);

        return $personas;
    }
    function buscar_una_persona($argIdPersona){
        
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "SELECT * FROM personas WHERE id_persona=:argIdPersona";
        
        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argIdPersona', $argIdPersona);  // reemplazo los parametros enlazados


        
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
    function insertar_persona($argNombre,$argApellido,$argSexo,$argIdDocumento){

        $ultimo_id=0;
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "INSERT INTO personas(nombre,apellido,sexo,id_documento) VALUES (:argNombre,:argApellido,:argSexo,:argIdDocumento)";

        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);

        $statement->bindParam(':argNombre', $argNombre);
        $statement->bindParam(':argApellido', $argApellido);  // reemplazo los parametros enlazados
        $statement->bindParam(':argSexo', $argSexo);  
        $statement->bindParam(':argIdDocumento', $argIdDocumento);  


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
    function actualizar_persona($argIdPersona,$argNombre,$argApellido,$argSexo,$argIdDocumento){
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        $sql = "UPDATE personas SET nombre=:argNombre, apellido=:argApellido, sexo=:argSexo, id_documento=:argIdDocumento WHERE id_persona=:argIdPersona";
        
        
        // preparo el sql para ejecutar
        $statement = $conexion->prepare($sql); 

        $statement->bindParam(':argIdPersona' , $argIdPersona);  // reemplazo los parametros enlazados
        $statement->bindParam(':argNombre' , $argNombre); 
        $statement->bindParam(':argApellido' , $argApellido); 
        $statement->bindParam(':argSexo' , $argSexo);
        $statement->bindParam(':argIdDocumento', $argIdDocumento);  


        if(!$statement){
            echo "Error al crear el registro";
        }else{
            $statement->execute();
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);
    }
    function eliminar_persona($argIdPersona){

        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "DELETE FROM personas WHERE id_persona=:argIdPersona";
        
        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argIdPersona', $argIdPersona);
        
        
        if(!$statement){
            echo "Error al Eliminar el registro";
        }else{
            $statement->execute();
        }
       
        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);
    }
?>