<?php

namespace Core;

/* Base controller - kontroler podstawowy zarządzający innymi */
abstract class Controller
{

	//parametry ścieżki
    protected $route_params = [];

    //konstruktor klasy
    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }
}
