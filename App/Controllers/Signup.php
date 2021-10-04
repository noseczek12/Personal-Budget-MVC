<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/* Signup controller */
class Signup extends \Core\Controller
{
//funkcja wyświetlająca stronę new
    public function newAction()
    {
        View::renderTemplate('Signup/new.html');
    }
	
	public function createAction()
	{
		$user = new User($_POST);
		$user -> save();
		View::renderTemplate('Signup/success.html');
	}
}
