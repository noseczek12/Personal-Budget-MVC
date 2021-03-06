<?php

/* Front controller */

ini_set('session.cookie_lifetime', '864000' );
//Twig
require_once dirname(__DIR__) . '/vendor/autoload.php';

//wychwytywanie błędów i wyjątków
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

//sesje
session_start();

/*Routing */
//require '../Core/Router.php';
$router = new Core\Router();

// Dodawanie ścieżek
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('login', ['controller' => 'Login', 'action' => 'new']);
$router->add('logout', ['controller' => 'Login', 'action' => 'destroy']);
$router->add('addincome/new', ['controller' => 'AddIncome', 'action' => 'new']);
$router->add('addincome/create', ['controller' => 'AddIncome', 'action' => 'create']);
$router->add('addincome/success', ['controller' => 'AddIncome', 'action' => 'success']);
$router->add('addexpense/new', ['controller' => 'AddExpense', 'action' => 'new']);
$router->add('addexpense/create', ['controller' => 'AddExpense', 'action' => 'create']);
$router->add('addexpense/success', ['controller' => 'AddExpense', 'action' => 'success']);
$router->add('showbalance/show-current-month', ['controller' => 'ShowBalance', 'action' => 'showCurrentMonth']);
$router->add('showbalance/show-previous-month', ['controller' => 'ShowBalance', 'action' => 'showPreviousMonth']);
$router->add('showbalance/show-current-year', ['controller' => 'ShowBalance', 'action' => 'showCurrentYear']);
$router->add('showbalance/show-custom', ['controller' => 'ShowBalance', 'action' => 'showCustom']);
$router->add('password/reset/{token:[\da-f]+}', ['controller' => 'Password', 'action' => 'reset']);
$router->add('signup/activate/{token:[\da-f]+}', ['controller' => 'Signup', 'action' => 'activate']);
$router->add('{controller}/{id:\d+}/{action}');
$router->add('{controller}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);



//Wysłanie ścieżki do kontrolera
$router->dispatch($_SERVER['QUERY_STRING']);