<?php

namespace App\Models;

use PDO;
use \Core\View;

//Expense model//

class Expense extends \Core\Model
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

            $sql = 'INSERT INTO expenses (user_id, expense_category_assigned_to_user_id, payment_method_assigned_to_user_id, amount, date_of_expense, expense_comment)
                    VALUES (:user_id, :expense_category, :expense_payment, :expense_amount, :expense_date, :expense_comment)';

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindValue(':expense_category', $this->category, PDO::PARAM_INT);
			$stmt->bindValue(':expense_payment', $this->payment, PDO::PARAM_INT);
            $stmt->bindValue(':expense_amount', $this->amount, PDO::PARAM_INT);
            $stmt->bindValue(':expense_date', $this->date, PDO::PARAM_STR);
			$stmt->bindValue(':expense_comment', $this->comment, PDO::PARAM_STR);

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

	//funkcja zwracająca wszystkie wydatki zalogowanego użytkownika
	public static function getAllExpenses()
	{	
		if (empty(Expense::$this->errors)) {

            $sql = "SELECT expenses_category_default.name as Category, SUM(expenses.amount) as Amount FROM expenses INNER JOIN expenses_category_default ON expenses.expense_category_assigned_to_user_id = expenses_category_default.id WHERE user_id = :userId  GROUP BY Category ORDER BY Amount  DESC";

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':userId', $_SESSION['user_id'], PDO::PARAM_INT);

           	$stmt->execute();
			return $stmt->fetchAll();
        }

        return false;
	}

	public static function getPieChartExpenses()
	{	
		if (empty(Expense::$this->errors)) {

            $sql = "SELECT expenses_category_default.name as Category, SUM(expenses.amount) as Amount FROM expenses INNER JOIN expenses_category_default ON expenses.expense_category_assigned_to_user_id = expenses_category_default.id WHERE user_id = :userId  GROUP BY Category ORDER BY Amount  DESC";

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
			$stmt->execute();
			$tablica = array();
			$i = 1;
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