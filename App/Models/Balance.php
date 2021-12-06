<?php

namespace App\Models;

use PDO;
use \Core\View;

//Balance model//

class Balance extends \Core\Model
{
    public $errors = [];
	//konstruktor klasy
	public function __construct($data = [])
	{
			foreach ($data as $key => $value){
				$this->$key = $value;
			};	
	}

    //funkcja zwracająca wszystkie wydatki zalogowanego użytkownika
	public static function getAllExpenses($period)
	{	
		if (empty(Expense::$this->errors)) {

            $sql = "SELECT expenses_category_default.name as Category, SUM(expenses.amount) as Amount FROM expenses INNER JOIN expenses_category_default ON expenses.expense_category_assigned_to_user_id = expenses_category_default.id WHERE user_id = :userId AND expenses.date_of_expense ".$period." GROUP BY Category ORDER BY Amount  DESC";

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':userId', $_SESSION['user_id'], PDO::PARAM_INT);

           	$stmt->execute();
			return $stmt->fetchAll();
        }

        return false;
	}

    //funkcja zwracająca dane z wydatkami pod wykres google charts
	public static function getPieChartExpenses($period)
	{	
		if (empty(Expense::$this->errors)) {

            $sql = "SELECT expenses_category_default.name as Category, SUM(expenses.amount) as Amount FROM expenses INNER JOIN expenses_category_default ON expenses.expense_category_assigned_to_user_id = expenses_category_default.id WHERE user_id = :userId AND expenses.date_of_expense ".$period." GROUP BY Category ORDER BY Amount  DESC";

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

    //funkcja zwracająca wszystkie przychody zalogowanego użytkownika
	public static function getAllIncomes($period)
	{	
		if (empty(Income::$this->errors)) {

            $sql = "SELECT incomes_category_default.name as Category, SUM(incomes.amount) as Amount FROM incomes INNER JOIN incomes_category_default ON incomes.income_category_assigned_to_user_id = incomes_category_default.id WHERE user_id = :userId AND incomes.date_of_income ".$period." GROUP BY Category ORDER BY Amount  DESC";

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':userId', $_SESSION['user_id'], PDO::PARAM_INT);

           	$stmt->execute();
			return $stmt->fetchAll();
        }

        return false;
	}

    //funkcja zwracająca dane z przychodami pod wykres google charts
	public static function getPieChartIncomes($period)
	{	
		if (empty(Income::$this->errors)) {

            $sql = "SELECT incomes_category_default.name as Category, SUM(incomes.amount) as Amount FROM incomes INNER JOIN incomes_category_default ON incomes.income_category_assigned_to_user_id = incomes_category_default.id WHERE user_id = :userId AND incomes.date_of_income ".$period." GROUP BY Category ORDER BY Amount  DESC";

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

    //funkcja licząca sumę wydatków/przychodów
	public static function calcSum($sqlArray){
		$sum = 0.0;
		foreach ($sqlArray as $values){
			$sum+= floatval($values['Amount']);
		}
		return $sum;
	}


}