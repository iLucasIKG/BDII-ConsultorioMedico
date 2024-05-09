<?php
    //Mostrar o listar todos los direccions
    function listar_contactos(){
        $contactos = array();

        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        //Realizo mi consulta para listar a todos los medicos
        $sql = "SELECT id_contacto, telefono, datos_contactos.id_direccion, datos_contactos.id_persona, CONCAT(personas.nombre, ' ', personas.apellido) AS nombre_apellido, direcciones.residencia FROM datos_contactos LEFT JOIN personas ON personas.id_persona=datos_contactos.id_persona LEFT JOIN direcciones ON direcciones.id_direccion = datos_contactos.id_direccion";

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

                $contactos[] = $resultado;

            }
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);

        return $contactos;
    }
    //permite buscar un contacto usando el ID
    function buscar_un_contacto($argIdPersona){
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "SELECT * FROM datos_contactos WHERE id_persona = :argIdPersona";
        
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
            $contacto = $statement->fetch(PDO::FETCH_ASSOC);
        }

        $statement = $db->cerrar_conexion($conexion);

        return $contacto;
    }

    function insertar_contacto($argTelefono,$argIdDireccion,$argIdPersona){

        $ultimo_id=0;
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "INSERT INTO datos_contactos(telefono, id_direccion, id_persona) VALUES (:argTelefono,:argIdDireccion,:argIdPersona)";

        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);

        $statement->bindParam(':argTelefono',$argTelefono); // reemplazo los parametros enlazados
        $statement->bindParam(':argIdDireccion',$argIdDireccion);
        $statement->bindParam(':argIdPersona',$argIdPersona);

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
    function actualizar_contacto($argIdContacto,$argTelefono,$argIdDireccion,$argIdPersona){
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        $sql = "UPDATE datos_contactos SET telefono=:argTelefono,id_direccion=:argIdDireccion,id_persona=:argIdPersona WHERE id_contacto=:argIdContacto";
    
        
        // preparo el sql para ejecutar
        $statement = $conexion->prepare($sql); 

        $statement->bindParam(':argIdContacto' , $argIdContacto);  // reemplazo los parametros enlazados
        $statement->bindParam(':argTelefono' , $argTelefono); 
        $statement->bindParam(':argIdDireccion' , $argIdDireccion);
        $statement->bindParam(':argIdPersona' , $argIdPersona);

        if(!$statement){
            echo "Error al crear el registro";
        }else{
            $statement->execute();
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);
    }
    function eliminar_contacto($argIdContacto){

        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "DELETE FROM datos_contactos WHERE id_contacto=:argIdContacto";
        

        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argIdContacto', $argIdContacto);
        
        
        if(!$statement){
            echo "Error al Eliminar el registro";
        }else{
            $statement->execute();
        }
       
        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);
    }
?>