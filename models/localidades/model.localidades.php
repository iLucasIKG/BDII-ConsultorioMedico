<?php
    //Mostrar o listar todos los localidades
    function listar_localidades(){
        $localidades = array();

        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        //Realizo mi consulta para listar a todos los medicos
        $sql = "SELECT id_localidad, nombre_localidad, codigo_postal, localidades.id_provincia,provincias.nombre_provincia FROM localidades LEFT JOIN provincias ON provincias.id_provincia=localidades.id_provincia; ";

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

                $localidades[] = $resultado;

            }
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);

        return $localidades;
    }
    //permite buscar un localidad usando el ID
    function buscar_una_localidad($argIdLocalidad){
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "SELECT * FROM localidades WHERE id_localidad=:argIdLocalidad";
        
        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argIdLocalidad', $argIdLocalidad);  // reemplazo los parametros enlazados

        
        if(!$statement){
            echo "Error al crear el registro";
        }else{
            $statement->execute();
        }
      
        if (!$statement) {
            // no se encontraron medicos
        } else {
            
            //Como es un solo registro no hace falta usar el while o algun bucle para iterar.
            $localidad = $statement->fetch(PDO::FETCH_ASSOC);
        }

        $statement = $db->cerrar_conexion($conexion);

        return $localidad;
    }

    function insertar_localidad($argNombreLocalidad,$argCodigoPostal,$argIdProvincia){

        $ultimo_id=0;
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "INSERT INTO localidades(nombre_localidad, codigo_postal, id_provincia) VALUES (:argNombreLocalidad,:argCodigoPostal,:argIdProvincia)";

        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);

        $statement->bindParam(':argNombreLocalidad',$argNombreLocalidad); // reemplazo los parametros enlazados
        $statement->bindParam(':argCodigoPostal',$argCodigoPostal); 
        $statement->bindParam(':argIdProvincia',$argIdProvincia); 


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
    function actualizar_localidad($argIdLocalidad,$argNombreLocalidad,$argCodigoPostal,$argIdProvincia){
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        $sql = "UPDATE localidades SET nombre_localidad=:argNombreLocalidad,codigo_postal=:argCodigoPostal,id_provincia=:argIdProvincia WHERE id_localidad=:argIdLocalidad";
        
        
        // preparo el sql para ejecutar
        $statement = $conexion->prepare($sql); 

        $statement->bindParam(':argIdLocalidad' , $argIdLocalidad); // reemplazo los parametros enlazados
        $statement->bindParam(':argNombreLocalidad' , $argNombreLocalidad); 
        $statement->bindParam(':argCodigoPostal', $argCodigoPostal); 
        $statement->bindParam(':argIdProvincia' , $argIdProvincia); 
                

        if(!$statement){
            echo "Error al crear el registro";
        }else{
            $statement->execute();           
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);
    }
    function eliminar_localidad($argIdLocalidad){

        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "DELETE FROM localidades WHERE id_localidad=:argIdLocalidad";
        
        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argIdLocalidad', $argIdLocalidad);
        
        
        if(!$statement){
            echo "Error al Eliminar el registro";
        }else{
            $statement->execute();
        }
       
        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);
    }
?>