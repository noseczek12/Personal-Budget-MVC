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

	//metoda zapisująca wpis z przychodem
	public function save()
	{
		$this->validate();

        if (empty($this->errors)) {

            $sql = 'INSERT INTO incomes (user_id, income_category_assigned_to_user_id, amount, date_of_income, income_comment)
                    VALUES (:user_id, :income_category, :income_amount, :income_date, :income_comment)';

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindValue(':income_category', $this->category, PDO::PARAM_STR);
            $stmt->bindValue(':income_amount', $this->amount, PDO::PARAM_INT);
            $stmt->bindValue(':income_date', $this->date, PDO::PARAM_STR);
			$stmt->bindValue(':income_comment', $this->comment, PDO::PARAM_STR);

            return $stmt->execute();
        }

        return false;
	}

	//funkcja sprawdzająca dane przed dodaniem do bazy
	public function validate()
	{
		// kategoria przychodu
       if ($this->category == 'Wybierz...') {
           $this->errors[] = 'Należy wybrać kategorię !';
       }

	   // kwota przychodu
       if ($this->amount == 0 || $this->amount < 0) {
		$this->errors[] = 'Kwota musi być większa od zera !';
		}

		// data przychodu
		if ($this->date == '') {
			$this->errors[] = 'Należy wskazać datę !';
		}
	}
    
}