<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Mail;

/* Home controller */
class Home extends \Core\Controller
{
	 protected function before()
    {
        //echo "(before) ";
    }

//funkcja wyświetlająca stronę index
    public function indexAction()
    {
		View::renderTemplate('Home/index.html' );
    }
	
	protected function after()
    {
        //echo " (after)";
    }
}
