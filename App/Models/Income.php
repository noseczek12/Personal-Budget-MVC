<?php

namespace App\Models;

use PDO;
use \Core\View;

//Income model//

class Income extends \Core\Model
{
    public $errors = [];
	//konstruktor klasy
	public function __construct($data = [])
	{
			foreach ($data as $key => $value){
				$this->$key = $value;
			};	
	}

    
}