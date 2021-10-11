<?php

namespace App\Controllers;

use \Core\View;

//Login controller

class Login extends \Core\Controller
{
	//funkcja pokazująca stronę logowania
	public function newAction()
	{
			View::renderTemplate('Login/new.html');
	}
	
	//funkcja logowania użytkownika
	public function createAction()
	{
			echo($_REQUEST['email']. ', ' . $_REQUEST['password']);
	}
}