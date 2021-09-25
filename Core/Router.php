<?php

namespace Core;

/* Router */

class Router
{
	/*Tablica asocjacyjna dla wszystkich ścieżek (routing table)*/
    protected $routes = [];
	/*Tablica asocjacyjna dla przypasowanej ścieżki*/
	protected $params = [];

    /* funkcja dodająca nowe ścieżki*/
    public function add($route, $params = [])
    {
        // Przekształcamy ścieżkę na wyrażenie regularne: usuwamy slashe /
        $route = preg_replace('/\//', '\\/', $route);

        // Przekształcamy zmienne, np {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
		
		//Przekształcamy zmienne z własnymi wyrażeniami regularnymi, np {id:\d+}
		$route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // Dodajemy początek i koniec wyrażenia regularnego
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    /* funkcja zwracająca wszystkie ścieżki z tablicy*/
    public function getRoutes()
    {
        return $this->routes;
    }
	
	/*Przypasowanie ścieżki do innych ścieżek w tablicy , ustawienie właściwości jeśli ścieżka jest odnaleziona*/
    public function match($url)
     {
		foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {

                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;
                return true;
            }
        }

        return false;
    }

    /* Uzyskanie aktualnie pasujących parametrów ścieżki*/
    public function getParams()
    {
        return $this->params;
    }

//Wysyłanie ścieżki do kontrolera na podstawie otrzymanego URL
public function dispatch($url)
    {
		 $url = $this->removeQueryStringVariables($url);
		 
        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
			$controller = "App\Controllers\\$controller";

            if (class_exists($controller)) {
                $controller_object = new $controller($this->params);

                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);

                if (is_callable([$controller_object, $action])) {
                    $controller_object->$action();

                } else {
                    echo "Method $action (in controller $controller) not found";
                }
            } else {
                echo "Controller class $controller not found";
            }
        } else {
            echo 'No route matched.';
        }
    }
	
	//Przekształcenie tekstu na StudlyCaps
	protected function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }
	
	//Przekształcenie tekstu na camelCase
	    protected function convertToCamelCase($string)
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }
	
	//funkcja przekształcająca  URL tak aby po & uwzględnione były pozostałe części adresu
	protected function removeQueryStringVariables($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
		
        return $url;
    }
}