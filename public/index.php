<?php

/* Front controller */

// echo 'Requested URL = "' . $_SERVER['QUERY_STRING'] . ' " ';

require '../App/Controllers/Posts.php';

/*Routing */
require '../Core/Router.php';

$router = new Router();

// Dodawanie ścieżek
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{id:\d+}/{action}');
$router->add('{controller}/{action}');

//Wysłanie ścieżki do kontrolera
$router->dispatch($_SERVER['QUERY_STRING']);