<?php

include_once('../../config/config.php');

include_once(VIEWS_DIR . "head/head.php");

$error = isset($_GET['error']) ? $_GET['error'] : 0;
$accion_login = isset($_POST['accion_login']) ? $_POST['accion_login'] : 'index';

if ($accion_login == 'index') {
    include_once(VIEWS_DIR . 'login.php');

} else if ($accion_login == 'registrar') {
    include_once(VIEWS_DIR . 'register.php');
}

switch ($error) {
    case 1:
        print('
            <div class="alert alert-danger" role="alert">
                Losentimos, nombre de usuario o contraseña son incorrectos.
            </div>
        ');
        break;
    case 2:
        print('
               <div class="alert alert-warning" role="alert">
                    Por favor, complete los espacios en blancos.
                </div>
            ');
        break;
    case 3:
        print('
                   <div class="alert alert-warning" role="alert">
                        Por favor, complete los espacios en blancos a la hora de registrarse.
                    </div>
                ');
        break;
    case 4:
        print('
                       <div class="alert alert-warning" role="alert">
                            Lo sentimos, las contraseñas no coiciden.
                        </div>
                    ');
        break;
}




include_once(VIEWS_DIR . "head/footer.php");
