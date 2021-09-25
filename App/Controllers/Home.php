<?php

namespace App\Controllers;

/* Home controller */
class Home extends \Core\Controller
{
	 protected function before()
    {
        echo "(before) ";
    }

//funkcja wyświetlająca stronę index
    public function indexAction()
    {
        echo 'Hello from the index action in the Home controller!';
    }
	
	protected function after()
    {
        echo " (after)";
    }
}
