<?php
/* 
Este ejemplo servira como se utiliza las constastes como rutas;


como esta compuesta la estructura va asi:
- config(carpeta)
    -config.php(archivo)
-controllers(carpeta- puede tener cualquier nombre)
    -carpeta(otra carpeta)
        -archivo.php


*/

//primero importas el archivo config si o si.
include "../../config/config.php"; //asi esta bien

// include BASE_DIR."config/config.php"; asi esta mal

//ahora si podes llamar a varios archivos con las constantes

include_once(BASE_DIR."config/class.conexion.php"); //Podemos llamar a la conexion en el mismo nivel que este en nuestro archivo config

include_once(MODELS_DIR . "barrios/model.barrios.php"); //podemos llamar desde otra carpeta

//si queres ver podes hacerlo con echo o print, estas son las cinco constantes que tengo

echo BASE_DIR;
echo MODELS_DIR;
echo CONTROLLERS_DIR;
echo VIEWS_DIR;
echo RELATIVE_PATH; //este me sirve para subir dos o una carpetas arriba



?>