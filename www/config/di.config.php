<?php declare(strict_types=1);

namespace Projet\Config;

use Projet\Controller\UsersController;
use Projet\Controller\PagesController;
use Projet\Repository\ConnectionInterface;
use Projet\Repository\ConnectionRepository;

return [
    ConnectionInterface::class => function($container){

        $host = $container['config']['database']['host'];
        $driver = $container['config']['database']['driver'];
        $name = $container['config']['database']['name'];
        $user = $container['config']['database']['user'];
        $password = $container['config']['database']['password'];
        //var_dump($container);
        return new ConnectionRepository($driver,$host,$name,$user,$password);
        //return new Users($driver,$host,$name,$user,$password);
    },
    UsersController::class => function($container){
        //var_dump($container);
        $userModel = $container[ConnectionInterface::class]($container);
        var_dump($container);
        return new UsersController($userModel);
    },
    PagesController::class => function($container){
        return new PagesController();
    }
];