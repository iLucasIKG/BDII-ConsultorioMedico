<?php
    //Mostrar o listar todos los especialidades
    function listar_especialidades(){
        $especialidades = array();

        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        //Realizo mi consulta para listar a todos los medicos
        $sql = "SELECT * FROM especialidades";

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

                $especialidades[] = $resultado;

            }
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);

        return $especialidades;
    }
    //permite buscar un especialidad usando el ID
    function buscar_una_especialidad($argIdEspecialidad){
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "SELECT * FROM especialidades WHERE id_especialidad=:argIdEspecialidad";
        
        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argIdEspecialidad', $argIdEspecialidad);  // reemplazo los parametros enlazados

        
        if(!$statement){
            echo "Error al crear el registro";
        }else{
            $statement->execute();
        }
      
        if (!$statement) {
            // no se encontraron medicos
        } else {
            //Como es un solo registro no hace falta usar el while o algun bucle para iterar.
            $especialidad = $statement->fetch(PDO::FETCH_ASSOC);
        }

        $statement = $db->cerrar_conexion($conexion);

        return $especialidad;
    }

    function insertar_especialidad($argNombreEspecialidad){

        $ultimo_id=0;
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "INSERT INTO especialidades(nombre_especialidad) VALUES (:argNombreEspecialidad)";

        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);

        $statement->bindParam(':argNombreEspecialidad',$argNombreEspecialidad); // reemplazo los parametros enlazados

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
    function actualizar_especialidad($argIdEspecialidad,$argNombreEspecialidad){
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();

        $sql = "UPDATE especialidades SET nombre_especialidad=:argNombreEspecialidad WHERE id_especialidad=:argIdEspecialidad";
        
        
        // preparo el sql para ejecutar
        $statement = $conexion->prepare($sql); 

        $statement->bindParam(':argIdEspecialidad' , $argIdEspecialidad); 
        $statement->bindParam(':argNombreEspecialidad' , $argNombreEspecialidad); // reemplazo los parametros enlazados
        

        if(!$statement){
            echo "Error al crear el registro";
        }else{
            $statement->execute();
        }

        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);
    }
    function eliminar_especialidad($argIdEspecialidad){

        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "DELETE FROM especialidades WHERE id_especialidad=:argIdEspecialidad";
        
        // preparo el sql para posteriormente ejecutarlo
        $statement = $conexion->prepare($sql);
        
        $statement->bindParam(':argIdEspecialidad', $argIdEspecialidad);
        
        
        if(!$statement){
            echo "Error al Eliminar el registro";
        }else{
            $statement->execute();
        }
       
        // cierro la conexion
        $statement = $db->cerrar_conexion($conexion);
    }
?>