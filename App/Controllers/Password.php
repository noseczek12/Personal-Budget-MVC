<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

//Password controller

class Password extends \Core\Controller
{
		//pokaż stronę zapomniałem hasła
		public function forgotAction()
		{
				View::renderTemplate('Password/forgot.html');
		}
		//wyślij link z resetem hasła na podany mail
		public function requestResetAction()
		{
				User::sendPasswordReset($_POST['email']);
				View::renderTemplate('Password/reset_requested.html');
		}
		
		//wykonaj reset hasła
		public function resetAction()
		{
				$token = $this->route_params['token'];

				$user = User::findByPasswordReset($token);

				if($user){
						View::renderTemplate('Password/reset.html');
				} else {
						echo "Password reset token invalid";
				}
		}
}