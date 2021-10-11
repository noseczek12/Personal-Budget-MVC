<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

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
			$user = User::authenticate($_POST['email'] , $_POST['password']);
			
			if($user){
					session_regenerate_id(true);
					
					$_SESSION['user_id'] = $user->id;
					
					$this->redirect('/');
			}else {
					View::renderTemplate('Login/new.html' , ['email' => $_POST['email'],]);
			}
	}
	
	// funkcja wylogowania
	public function destroyAction()
	{
			// wyłącz wszystkie zmienne sesyjne
			$_SESSION = array();

			// zniszcz sesję cookie
			if (ini_get("session.use_cookies")) {
				$params = session_get_cookie_params();
				setcookie(session_name(), '', time() - 42000,
					$params["path"], $params["domain"],
					$params["secure"], $params["httponly"]
				);
			}

			// i ostatecznie, zniszcz sesję
			session_destroy();
			
			$this->redirect('/');
	}
}