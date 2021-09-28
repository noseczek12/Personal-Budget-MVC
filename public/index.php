<?php

/* Front controller */

//Twig
require_once dirname(__DIR__) . '/vendor/autoload.php';

/*Routing */
//require '../Core/Router.php';
$router = new Core\Router();

// Dodawanie ścieżek
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{id:\d+}/{action}');
$router->add('{controller}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

//Wysłanie ścieżki do kontrolera
$router->dispatch($_SERVER['QUERY_STRING']);