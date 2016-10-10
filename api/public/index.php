<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}
// Ubicación Projecto
$rootProject = '/home/hb/classicbeiza.cl/hipertube/api';
// Ubicación Librería
require '/usr/local/Slim/vendor/autoload.php';
//require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app

//$settings = require __DIR__ . '/../src/settings.php';
$settings = require $rootProject . '/src/settings.php';

$app = new \Slim\App($settings);

// DAOs
require __DIR__ . '/../src/daos/DBDAO.php';
require __DIR__ . '/../src/daos/UsuarioDAO.php';
require __DIR__ . '/../src/daos/FavoritoDAO.php';

// Models
require __DIR__ . '/../src/models/IndexModel.php';
require __DIR__ . '/../src/models/UsuarioModel.php';
require __DIR__ . '/../src/models/FavoritoModel.php';

// Controladores
require __DIR__ . '/../src/controllers/IndexController.php';
require __DIR__ . '/../src/controllers/UsuarioController.php';
require __DIR__ . '/../src/controllers/FavoritoController.php';

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Run app
$app->run();