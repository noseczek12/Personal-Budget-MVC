<?php

namespace App\Controllers;

//Authenticated base controller

abstract class Authenticated extends \Core\Controllers
{
		protected function before()
		{
				$this->requireLogin();
		}
}