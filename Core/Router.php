<?php

/* Router */

class Router
{
	/*Tablica asocjacyjna dla wszystkich ścieżek (routing table)*/
    protected $routes = [];
	/*Tablica asocjacyjna dla przypasowanej ścieżki*/
	protected $params = [];

    /* funkcja dodająca nowe ścieżki*/
    public function add($route, $params)
    {
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
            if ($url == $route) {
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
}