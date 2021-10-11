<?php

namespace App;

//uwierzytelnianie

class Auth
{
		public static function login($user)
		{
			session_regenerate_id(true);
					
			$_SESSION['user_id'] = $user->id;
		}
		
		public static function logout()
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
		}
		
		public static function isLoggedIn()
	{
		return isset($_SESSION['user_id']);
	}
}