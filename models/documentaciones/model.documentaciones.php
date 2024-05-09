<?php
    //Mostrar o listar todos los documentos
    function listar_documentos(){
        $documentos = array();

        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        //Realizo mi consulta para listar a todos los medicos
        $sql = "SELECT * FROM documentaciones";

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

                $documentos[] = $resultado;

            }
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);

        return $documentos;
    }
    //permite buscar un documento usando el ID
    function buscar_un_documento($argIdDocumento){
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "SELECT * FROM documentaciones WHERE id_documento=:argIdDocumento";
        
        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argIdDocumento', $argIdDocumento);  // reemplazo los parametros enlazados

        
        if(!$statement){
            echo "Error al crear el registro";
        }else{
            $statement->execute();
        }
      
        if (!$statement) {
            // no se encontraron medicos
        } else {
            
            //Como es un solo registro no hace falta usar el while o algun bucle para iterar.
            $documento = $statement->fetch(PDO::FETCH_ASSOC);
        }

        $statement = $db->cerrar_conexion($conexion);

        return $documento;
    }

    function insertar_documento($argTipoDocumento,$argNumeroDocumento,$argCuil,$argNroSegSocial){

        $ultimo_id=0;
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "INSERT INTO documentaciones(tipo_documento, numero_documento, cuil, nro_seg_social) VALUES (:argTipoDocumento,:argNumeroDocumento,:argCuil,:argNroSegSocial)";

        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);

        $statement->bindParam(':argTipoDocumento',$argTipoDocumento); // reemplazo los parametros enlazados
        $statement->bindParam(':argNumeroDocumento' , $argNumeroDocumento); 
        $statement->bindParam(':argCuil' , $argCuil);
        $statement->bindParam(':argNroSegSocial' , $argNroSegSocial); 


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
    function actualizar_documento($argIdDocumento,$argTipoDocumento,$argNumeroDocumento,$argCuil,$argNroSegSocial){
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        $sql = "UPDATE documentaciones SET tipo_documento=:argTipoDocumento,numero_documento=:argNumeroDocumento,cuil=:argCuil,nro_seg_social=:argNroSegSocial WHERE id_documento=:argIdDocumento";
        
        
        // preparo el sql para ejecutar
        $statement = $conexion->prepare($sql); 

        $statement->bindParam(':argIdDocumento' , $argIdDocumento); // reemplazo los parametros enlazados
        $statement->bindParam(':argTipoDocumento' , $argTipoDocumento); 
        $statement->bindParam(':argNumeroDocumento' , $argNumeroDocumento); 
        $statement->bindParam(':argCuil', $argCuil);
        $statement->bindParam(':argNroSegSocial' , $argNroSegSocial); 
      

        if(!$statement){
            echo "Error al crear el registro";
        }else{
            $statement->execute();
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);
    }
    function eliminar_documento($argIdDocumento){

        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "DELETE FROM documentaciones WHERE id_documento=:argIdDocumento";
        
        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argIdDocumento', $argIdDocumento);
        
        
        if(!$statement){
            echo "Error al Eliminar el registro";
        }else{
            $statement->execute();
        }
       
        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);
    }
?>