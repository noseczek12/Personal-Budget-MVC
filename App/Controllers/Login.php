<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Auth;
use \App\Flash;

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
					Auth::login($user);
					Flash::addMessage('Login succesful');
					$this->redirect(Auth::getReturnToPage());
			}else {
					Flash::addMessage('Login unsuccesful, please try again' , Flash::WARNING);
					View::renderTemplate('Login/new.html' , ['email' => $_POST['email'],]);
			}
	}
	
	// funkcja wylogowania
	 public function destroyAction()
    {
        Auth::logout();

        $this->redirect('/login/show-logout-message');
    }

   //pokazanie wiadomości o wylogowaniu
    public function showLogoutMessageAction()
    {
      Flash::addMessage('Logout successful');

      $this->redirect(Auth::getReturnToPage());
    }
}