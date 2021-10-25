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
				$user = $this->getUserOrExit($token);

				View::renderTemplate('Password/reset.html', [
								'token' => $token
								]);
		}
		
		//funkcja resetująca hasło użytkownika
		public function resetPasswordAction()
		{
					$token = $_POST['token'];
					$user = $this->getUserOrExit($token);
					
					if ($user->resetPassword($_POST['password'])){
							View::renderTemplate('Password/reset_success.html');
					}else{
							View::renderTemplate('Password/reset.html', [
								'token' => $token,
								'user' => $user
								]);
					}
		}
		
		//funkcja znajdująca użytkownika powiązanego z tokenem
		protected function getUserOrExit($token)
		{
				$user = User::findByPasswordReset($token);

				if($user){
						return $user;
				} else {
						View::renderTemplate('Password/token_expired.html');
						exit;
				}
		}
}