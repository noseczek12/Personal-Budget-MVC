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

            $sql = 'INSERT INTO incomes (user_id, income_category_assigned_to_user_id, payment_method_assigned_to_user_id, amount, date_of_income, income_comment)
                    VALUES (:user_id, :income_category, :income_payment, :income_amount, :income_date, :income_comment)';

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindValue(':income_category', $this->category, PDO::PARAM_STR);
			$stmt->bindValue(':income_payment', $this->payment, PDO::PARAM_STR);
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
    
	//funkcja zwracająca wszystkie przychody zalogowanego użytkownika
	public static function getAllIncomes()
	{	
		if (empty(Income::$this->errors)) {

            $sql = "SELECT income_category_assigned_to_user_id as Category, SUM(amount) as Amount FROM incomes WHERE user_id = :userId  GROUP BY income_category_assigned_to_user_id ORDER BY SUM(amount)  DESC ";

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':userId', $_SESSION['user_id'], PDO::PARAM_INT);

           	$stmt->execute();
			return $stmt->fetchAll();
        }

        return false;
	}

	public static function getPieChartIncomes()
	{	
		if (empty(Income::$this->errors)) {

            $sql = "SELECT income_category_assigned_to_user_id as Category, SUM(amount) as Amount FROM incomes WHERE user_id = :userId  GROUP BY income_category_assigned_to_user_id ORDER BY SUM(amount)  DESC ";

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':userId', $_SESSION['user_id'], PDO::PARAM_INT);

			$i = 1;
           	$stmt->execute();
			$tablica = array();
			
			   while (($row = $stmt->fetch(PDO::FETCH_ASSOC)))
			   {
				$firstLine = true;
				if ($firstLine)
				{
					$tablica[0] = array_keys($row);
					$firstLine = false;
				}
				   $category = $row['Category'];
				   $amount = $row['Amount'];
				   $tablica[$i]=array(strval($category),floatval($amount));
				   $i++;
			   }
			return $tablica;
        }

        return false;
	}

	public static function calcSum($sqlArray){
			$sum = 0.0;
			foreach ($sqlArray as $values){
				$sum+= floatval($values['Amount']);
			}
			return $sum;
		}
}