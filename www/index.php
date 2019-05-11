<?php

use Projet\Core\Routing;

require 'conf.inc.php';

function myAutoloader($class)
{
    $renomm = str_replace('Projet\\', '', $class);
    $renomm2 = str_replace('\\', '/', $renomm);
    $classPath = lcfirst($renomm2).'.php';
    $classModel = lcfirst($renomm2).'.php';
    if (file_exists($classPath)) {
        include $classPath;
    } elseif (file_exists($classModel)) {
        include $classModel;
    }
}

// myAutoloader function is throw on the class not found
spl_autoload_register('myAutoloader');

// Get some arguments in the URL - Routing
$slug = explode('?', $_SERVER['REQUEST_URI'])[0];
$routes = Routing::getRoute($slug);
extract($routes);

$container = require  'config/di.config.php';
$container['config'] = require 'config/global.php';

// Check the existence of the file and the class to load the controller
if (file_exists($cPath)) {
    include $cPath;
    if (class_exists('\\Projet\\Controller\\'.$controller)) {
        //Controller instantiate
        $cObject = $container['Projet\Controller\\'. $controller]($container);
        //Check the method 'action' if she exist
        if (method_exists($cObject, $action)) {
            //Call the method
            $cObject->$action();
        } else {
            die('La methode '.$action." n'existe pas");
        }
    } else {
        die('La class controller '.$controller." n'existe pas");
    }
} else {
    die('Le fichier controller '.$controller." n'existe pas");
}
