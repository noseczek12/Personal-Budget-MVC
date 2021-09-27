<?php

/* Front controller */

// echo 'Requested URL = "' . $_SERVER['QUERY_STRING'] . ' " ';

//require '../App/Controllers/Posts.php';

//Twig
require_once dirname(__DIR__) . '/vendor/autoload.php';

//Autoloader - automatyczne ładowanie ścieżek dostępu poszczgólnych elem frameworka
spl_autoload_register(function ($class){
	$root = dirname(__DIR__);   //uzyskujemy ścieżkę katalogu nadrzędnego
	$file = $root . '/' . str_replace('\\', '/', $class) . '.php';
	if (is_readable($file)){
		require $root . '/' . str_replace('\\', '/', $class) . '.php';
	}
});

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