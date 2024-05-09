<?php
    //Mostrar o listar todos las pronvincias
    function listar_provincias(){
        $pronvincias = array();

        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        //Realizo mi consulta para listar a todos los medicos
        $sql = "SELECT id_provincia, nombre_provincia, provincias.id_pais, paises.nombre_pais FROM provincias LEFT JOIN paises ON provincias.id_pais=paises.id_pais";

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

                $pronvincias[] = $resultado;

            }
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);

        return $pronvincias;
    }
    //permite buscar un provincia usando el ID
    function buscar_una_provincia($argIdProvincia){
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "SELECT * FROM provincias WHERE id_provincia=:argIdProvincia";
        
        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argIdProvincia', $argIdProvincia);  // reemplazo los parametros enlazados

        
        if(!$statement){
            echo "Error al crear el registro";
        }else{
            $statement->execute();
        }
      
        if (!$statement) {
            // no se encontraron medicos
        } else {
            
            //Como es un solo registro no hace falta usar el while o algun bucle para iterar.
            $provincia = $statement->fetch(PDO::FETCH_ASSOC);
        }

        $statement = $db->cerrar_conexion($conexion);

        return $provincia;
    }

    function insertar_provincia($argNombreProvincia,$argIdPais){

        $ultimo_id=0;
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "INSERT INTO provincias(nombre_provincia, id_pais, id_provincia) VALUES (:argNombreProvincia,:argIdPais,:argIdProvincia)";

        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);

        $statement->bindParam(':argNombreProvincia',$argNombreProvincia); // reemplazo los parametros enlazados
        $statement->bindParam(':argIdPais',$argIdPais); 
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
    function actualizar_provincia($argIdProvincia,$argNombreProvincia,$argIdPais){
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        $sql = "UPDATE provincias SET nombre_provincia=:argNombreProvincia,id_pais=:argIdPais WHERE id_provincia=:argIdProvincia";
        
        
        // preparo el sql para ejecutar
        $statement = $conexion->prepare($sql); 

        $statement->bindParam(':argIdProvincia' , $argIdProvincia); // reemplazo los parametros enlazados
        $statement->bindParam(':argNombreProvincia' , $argNombreProvincia); 
        $statement->bindParam(':argIdPais', $argIdPais);
                

        if(!$statement){
            echo "Error al crear el registro";
        }else{
            $statement->execute();           
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);
    }
    function eliminar_provincia($argIdProvincia){

        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "DELETE FROM provincias WHERE id_provincia=:argIdProvincia";
        
        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argIdProvincia', $argIdProvincia);
        
        
        if(!$statement){
            echo "Error al Eliminar el registro";
        }else{
            $statement->execute();
        }
       
        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);
    }
?>