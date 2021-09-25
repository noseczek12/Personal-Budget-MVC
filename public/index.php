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
    

// Przypasowanie adresu URL do ścieżki
$url = $_SERVER['QUERY_STRING'];

if ($router->match($url)) {
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
} else {
    echo "No route found for URL '$url'";
}