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
        if ($user->save()) {
			$user->sendActivationEmail();
			$this->redirect('/signup/success');
       } else {
            View::renderTemplate('Signup/new.html', [
                'user' => $user
            ]);
       }
	}
	
	//wyświetlenie strony przy sukcesie rejestracji
	public function successAction()
	{
		View::renderTemplate('Signup/success.html');
	}
	
	//aktywacja nowego konta
	public function activateAction()
	{
			User::activate($this->route_params['token']);
			$this->redirect('/signup/activated');
	}
	
	//wyświetlenie strony przy sukcesie aktywacji
	public function activatedAction()
	{
		View::renderTemplate('Signup/activated.html');
	}
}
