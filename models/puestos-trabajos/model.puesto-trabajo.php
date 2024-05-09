<?php
    //Mostrar o listar todos los puestos de trabajos
    function listar_puestos_trabajos(){
        $puestos_trabajos = array();

        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        //Realizo mi consulta para listar a todos los medicos
        $sql = "SELECT * FROM puestos_trabajos";

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

                $puestos_trabajos[] = $resultado;

            }
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);

        return $puestos_trabajos;
    }
    //permite buscar un puesto_trabajo usando el ID
    function buscar_un_puesto_trabajo($argIdPuestoTrabajo){
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "SELECT * FROM puestos_trabajos WHERE id_puesto_trabajo=:argIdPuestoTrabajo";
        
        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argIdPuestoTrabajo', $argIdPuestoTrabajo);  // reemplazo los parametros enlazados

        
        if(!$statement){
            echo "Error al crear el registro";
        }else{
            $statement->execute();
        }
      
        if (!$statement) {
            // no se encontraron medicos
        } else {
            //Como es un solo registro no hace falta usar el while o algun bucle para iterar.
            $puesto_trabajo = $statement->fetch(PDO::FETCH_ASSOC);
        }

        $statement = $db->cerrar_conexion($conexion);

        return $puesto_trabajo;
    }

    function insertar_puesto_trabajo($argNombrePuestoTrabajo){

        $ultimo_id=0;
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "INSERT INTO puestos_trabajos(nombre_puesto_trabajo) VALUES (:argNombrePuestoTrabajo)";

        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);

        $statement->bindParam(':argNombrePuestoTrabajo',$argNombrePuestoTrabajo); // reemplazo los parametros enlazados

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
    function actualizar_puesto_trabajo($argIdPuestoTrabajo,$argNombrePuestoTrabajo){
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        $sql = "UPDATE puestos_trabajos SET nombre_puesto_trabajo=:argNombrePuestoTrabajo WHERE id_puesto_trabajo=:argIdPuestoTrabajo";
        
        
        // preparo el sql para ejecutar
        $statement = $conexion->prepare($sql); 

        $statement->bindParam(':argIdPuestoTrabajo' , $argIdPuestoTrabajo); 
        $statement->bindParam(':argNombrePuestoTrabajo' , $argNombrePuestoTrabajo); // reemplazo los parametros enlazados
        

        if(!$statement){
            echo "Error al crear el registro";
        }else{
            $statement->execute();
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);
    }
    function eliminar_puesto_trabajo($argIdPuestoTrabajo){

        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "DELETE FROM puestos_trabajos WHERE id_puesto_trabajo=:argIdPuestoTrabajo";
        
        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argIdPuestoTrabajo', $argIdPuestoTrabajo);
        
        
        if(!$statement){
            echo "Error al Eliminar el registro";
        }else{
            $statement->execute();
        }
       
        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);
    }
?>