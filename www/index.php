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

// La fonction myAutoloader est lancé sur la classe appelée n'est pas trouvée
spl_autoload_register('myAutoloader');


// Récupération des paramètres dans l'url - Routing/
$slug = explode('?', $_SERVER['REQUEST_URI'])[0];
$routes = Routing::getRoute($slug);
extract($routes);


//var_dump($container);
$container = require  'config/di.config.php';
$container['config'] = require 'config/global.php';
//var_dump($container);


//var_dump($cPath);

// Vérifie l'existence du fichier et de la classe pour charger le controlleur
if (file_exists($cPath)) {
    include $cPath;
    //var_dump($cPath);
    if (class_exists('\\Projet\\Controller\\'.$c)) {
        //instancier dynamiquement le controller
        $cObject = $container['Projet\Controller\\'. $c]($container);
        //vérifier que la méthode (l'action) existe
        if (method_exists($cObject, $a)) {
            //appel dynamique de la méthode
            //var_dump($a);
            $cObject->$a();
        } else {
            die('La methode '.$a." n'existe pas");
        }
    } else {
        die('La class controller '.$c." n'existe pas");
    }
} else {
    die('Le fichier controller '.$c." n'existe pas");
}
