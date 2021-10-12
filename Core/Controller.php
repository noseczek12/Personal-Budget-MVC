<?php

namespace Core;

use \App\Auth;
use \App\Flash;

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
	
	//funkcja "magiczna", wywoływana gdy niedostępna metoda jest wywoływana na obiekcie danej klasy (prywatnej)
	public function __call($name, $args)
    {
        $method = $name . 'Action';

        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
            throw new \Exception("Method $method not found in controller" .  get_class($this));
        }
	}
		//Filtr przed - wywołanie przed właściwą metodą
		protected function before()
		{
		}
		
		//Filtr po - wywołanie po właściwej metodzie
		 protected function after()
		{
		}
		
		public function redirect($url)
		{
					header('Location: http://' . $_SERVER['HTTP_HOST'] . '/', true, 303);
					exit;
		}
		
		public function requireLogin()
		{
				if(! Auth::getUser()){
					Flash::addMessage('Please login to access that page');
					Auth::rememberRequestedPage();
					$this->redirect('/login');
				}
		}	
}
