<?php 

session_start();

include_once('config/config.php');


$accion = isset($_GET['accion']) ? $_GET['accion'] : 'login';


switch ($accion) {
    // ...
    case 'login':
            header('Location:controller/inicio/controller.inicio.php');
        break;
    case 'ingresar':
        
        include('menu.php');
            

        break;

    // Agrega más casos según sea necesario para otras funcionalidades
}
