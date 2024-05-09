<?php
    //Mostrar o listar todos los calles
    function listar_direcciones(){
        $direcciones = array();

        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        //Realizo mi consulta para listar a todos los medicos
        $sql = "SELECT id_direccion, direcciones.id_barrio, direcciones.id_calle, direcciones.id_calle, direcciones.id_localidad, residencia, barrios.nombre_barrio, calles.nombre_calle, altura_calle, localidades.nombre_localidad, localidades.codigo_postal FROM direcciones INNER JOIN barrios ON barrios.id_barrio = direcciones.id_barrio INNER JOIN calles ON calles.id_calle = direcciones.id_calle INNER JOIN localidades ON localidades.id_localidad = direcciones.id_localidad; ";

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

                $direcciones[] = $resultado;

            }
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);

        return $direcciones;
    }
    //permite buscar un calle usando el ID
    function buscar_una_direccion($argIdDireccion){
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "SELECT * FROM direcciones WHERE id_direccion=:argIdDireccion";

        
        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argIdDireccion', $argIdDireccion);  // reemplazo los parametros enlazados

        
        if(!$statement){
            echo "Error al crear el registro";
        }else{
            $statement->execute();
        }
      
        if (!$statement) {
            // no se encontraron medicos
        } else {
            
            //Como es un solo registro no hace falta usar el while o algun bucle para iterar.
            $direccion = $statement->fetch(PDO::FETCH_ASSOC);
        }

        $statement = $db->cerrar_conexion($conexion);

        return $direccion;
    }

    function insertar_direccion($argResidencia,$argIdBarrio,$argIdCalle,$argAlturaCalle,$argIdLocalidad){

        $ultimo_id=0;
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "INSERT INTO direcciones(residencia,id_barrio,id_calle,altura_calle,id_localidad) VALUES (:argResidencia,:argIdBarrio,:argIdCalle,:argAlturaCalle,:argIdLocalidad)";

        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);

        $statement->bindParam(':argResidencia',$argResidencia); // reemplazo los parametros enlazados
        $statement->bindParam(':argIdBarrio',$argIdBarrio);
        $statement->bindParam(':argIdCalle',$argIdCalle);
        $statement->bindParam(':argAlturaCalle',$argAlturaCalle);
        $statement->bindParam(':argIdLocalidad',$argIdLocalidad);


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
   function actualizar_direccion($argIdDireccion,$argIdCalle,$argAlturaCalle,$argIdBarrio){
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        $sql = "UPDATE direcciones SET id_barrio=:argIdBarrio,id_calle=:argIdCalle,altura_calle=:argAlturaCalle WHERE id_direccion=:argIdDireccion";
        
               
        // preparo el sql para ejecutar
        $statement = $conexion->prepare($sql); 

        $statement->bindParam(':argIdDireccion' , $argIdDireccion); // reemplazo los parametros enlazados
        $statement->bindParam(':argIdBarrio' , $argIdBarrio); 
        $statement->bindParam(':argIdCalle' , $argIdCalle); 
        $statement->bindParam(':argAlturaCalle' , $argAlturaCalle); 
    

        if(!$statement){
            echo "Error al crear el registro";
        }else{
            $statement->execute();
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);
    } 
    function eliminar_direccion($argIdDireccion){

        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "DELETE FROM direcciones WHERE id_direccion=:argIdDireccion";
        
        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argIdDireccion', $argIdDireccion);
        
        
        if(!$statement){
            echo "Error al Eliminar el registro";
        }else{
            $statement->execute();
        }
       
        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);
    }
?>