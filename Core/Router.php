<?php

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
}