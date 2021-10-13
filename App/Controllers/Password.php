<?php

namespace App\Controllers;

use \Core\View;

//Password controller

class Password extends \Core\Controller
{
		//pokaż stronę zapomniałem hasła
		public function forgotAction()
		{
				View::renderTemplate('Password/forgot.html');
		}
}