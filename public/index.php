<?php

/* Front controller */

// echo 'Requested URL = "' . $_SERVER['QUERY_STRING'] . ' " ';

/*Routing */
require '../Core/Router.php';

$router = new Router();

// Dodawanie ścieżek
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
    
//wyświetlamy tablicę ścieżek
echo '<pre>';
var_dump($router->getRoutes());
echo '</pre>';