<?php

/* Front controller */

// echo 'Requested URL = "' . $_SERVER['QUERY_STRING'] . ' " ';

/*Routing */
require '../Core/Router.php';

$router = new Router();

// Dodawanie ścieżek
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('admin/{action}/{controller}');

//Wyświetlanie tablicy ścieżek
echo '<pre>';
//var_dump($router->getRoutes());
echo htmlspecialchars(print_r($router->getRoutes(), true));
echo '</pre>';

// Przypasowanie adresu URL do ścieżki
$url = $_SERVER['QUERY_STRING'];

if ($router->match($url)) {
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
} else {
    echo "No route found for URL '$url'";
}