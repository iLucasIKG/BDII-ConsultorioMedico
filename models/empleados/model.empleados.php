<?php

    //Mostrar o listar todos los medicos
    function listar_empleados(){
        $empleados = array();

        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        //Realizo mi consulta para listar a todos los medicos
        $sql = "SELECT id_empleado,empleados.id_persona,empleados.id_puesto_trabajo,CONCAT(personas.nombre,' ',personas.apellido) AS nombre_apellido,puestos_trabajos.nombre_puesto_trabajo FROM empleados LEFT JOIN personas ON personas.id_persona=empleados.id_persona LEFT JOIN puestos_trabajos ON puestos_trabajos.id_puesto_trabajo= empleados.id_puesto_trabajo";

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

                $empleados[] = $resultado;

            }
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);

        return $empleados;
    }

    //permite buscar un medico usando el ID
    function buscar_un_empleado($argIdEmpleado){
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "SELECT * FROM empleados WHERE id_empleado = :argIdEmpleado";
        
        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argIdEmpleado', $argIdEmpleado);  // reemplazo los parametros enlazados

        
        if(!$statement){
            echo "Error al crear el registro";
        }else{
            $statement->execute();
        }
      
        if (!$statement) {
            // no se encontraron medicos
        } else {
            
            //Como es un solo registro no hace falta usar el while o algun bucle para iterar.
            $empleado = $statement->fetch(PDO::FETCH_ASSOC);
        }

        $statement = $db->cerrar_conexion($conexion);

        return $empleado;
    }
    //Permite agregar un medico
    function insertar_empleado($argIdPersona,$argIdPuestoTrabajo){
        $ultimo_id=0;
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "INSERT INTO empleados(id_persona, id_puesto_trabajo) VALUES (:argIdPersona,:argIdPuestoTrabajo)";
        
        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argIdPersona', $argIdPersona);
        $statement->bindParam(':argIdPuestoTrabajo', $argIdPuestoTrabajo);  // reemplazo los parametros enlazados

        
        
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
    
    function actualizar_empleado($argIdEmpleado,$argIdPersona,$argIdPuestoTrabajo){
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        $sql = "UPDATE empleados SET id_persona=:argIdPersona,id_puesto_trabajo=:argIdPuestoTrabajo WHERE id_empleado=:argIdEmpleado";
        
        
        // preparo el sql para ejecutar
        $statement = $conexion->prepare($sql); 

        $statement->bindParam(':argIdEmpleado' , $argIdEmpleado);  // reemplazo los parametros enlazados
        $statement->bindParam(':argIdPersona' , $argIdPersona); 
        $statement->bindParam(':argIdPuestoTrabajo' , $argIdPuestoTrabajo); 

        if(!$statement){
            echo "Error al crear el registro";
        }else{
            $statement->execute();
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);
    }
  
    
?>
