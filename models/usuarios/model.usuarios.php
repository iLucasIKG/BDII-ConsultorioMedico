<?php

function iniciar_sesion($argEmail, $argPass){
    if (!empty($argEmail) && !empty($argPass)) {
        $db = new ConexionDB;
        $conexion = $db->retornar_conexion();
        $sql = "SELECT * FROM usuarios WHERE email = :argEmail AND pass = :argPass";

        $statement = $conexion->prepare($sql);


        $statement->bindParam(':argEmail', $argEmail);
        $statement->bindParam(':argPass', $argPass);

        $statement->execute();

        // Comprueba si se encontró un usuario
        $usuario = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $usuario;

    }
}
//Mostrar o listar todos los usuarios
function listar_usuarios()
{
    $usuarios = array();

    $db = new ConexionDB;
    $conexion = $db->retornar_conexion();

    //Realizo mi consulta para listar a todos los usuarios
    $sql = "SELECT numero_usuario, email, usuarios.id_rol, usuarios.id_persona FROM usuarios LEFT JOIN roles ON roles.id_rol = usuarios.id_rol LEFT JOIN personas ON personas.id_persona = usuarios.id_persona WHERE usuarios.id_persona NOT IN (0); ";

    //preparo mi consulta para ejecutarla:
    $statement = $conexion->prepare($sql);

    if (!$statement) {
        echo "Error al listar los registro";
    } else {
        $statement->execute();
    }

    if (!$statement) {
        // no se encontraron usuarios
    } else {

        // reviso el retorno

        while ($resultado = $statement->fetch(PDO::FETCH_ASSOC)) {

            $usuarios[] = $resultado;

        }
    }

    // cierro la conexion
    $statement = $db->cerrar_conexion($conexion);

    return $usuarios;
}
//permite buscar un calle usando el ID
function buscar_un_usuario($argNumeroUsuario){
    $db = new ConexionDB;
    $conexion = $db->retornar_conexion();
    $sql = "SELECT * FROM usuarios WHERE numero_usuario=:argNumeroUsuario";

    // preparo el sql para posteriormente ejecutarlo
    $statement = $conexion->prepare($sql);

    $statement->bindParam(':argNumeroUsuario', $argNumeroUsuario);  // reemplazo los parametros enlazados


    if (!$statement) {
        echo "Error al crear el registro";
    } else {
        $statement->execute();
    }

    if (!$statement) {
        // no se encontraron usuarios
    } else {

        //Como es un solo registro no hace falta usar el while o algun bucle para iterar.
        $calle = $statement->fetch(PDO::FETCH_ASSOC);
    }

    $statement = $db->cerrar_conexion($conexion);

    return $calle;
}

function insertar_usuario($argEmail, $argPass, $argIdRol, $argIdPersona)
{

    $ultimo_id = 0;
    $db = new ConexionDB;
    $conexion = $db->retornar_conexion();
    $sql = "INSERT INTO usuarios(email, pass, id_rol, id_persona) VALUES (:argEmail,:argPass,:argIdRol,:argIdPersona)";

    // preparo el sql para posteriormente ejecutarlo
    $statement = $conexion->prepare($sql);

    $statement->bindParam(':argEmail', $argEmail); // reemplazo los parametros enlazados
    $statement->bindParam(':argPass', $argPass);
    $statement->bindParam(':argIdRol', $argIdRol);
    $statement->bindParam(':argIdPersona', $argIdPersona);



    if (!$statement) {
        echo "Error al crear el registro";
    } else {
        $statement->execute();
    }

    $ultimo_id = $conexion->lastinsertid();

    // cierro la conexion
    $statement = $db->cerrar_conexion($conexion);

    return $ultimo_id;
}

function eliminar_usuario($argNumeroUsuario)
{

    $db = new ConexionDB;
    $conexion = $db->retornar_conexion();
    $sql = "DELETE FROM usuarios WHERE numero_usuario=:argNumeroUsuario";

    // preparo el sql para posteriormente ejecutarlo
    $statement = $conexion->prepare($sql);

    $statement->bindParam(':argNumeroUsuario', $argNumeroUsuario);


    if (!$statement) {
        echo "Error al Eliminar el registro";
    } else {
        $statement->execute();
    }

    // cierro la conexion
    $statement = $db->cerrar_conexion($conexion);
}
?>