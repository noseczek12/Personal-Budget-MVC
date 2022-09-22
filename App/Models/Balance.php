<?php

namespace App\Models;

use Core\Model;
use PDO;
use Core\View;

/**
 * * Balance Model.
 */
class Balance extends Model
{
    public $errors = [];

    /**
     * * Balance Constructor.
     */
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }//end __construct()

    /**
     * * Get user's all expenses (at given period).
     */
    public static function getAllExpenses($firstDay,$lastDay)
    {
        if (empty(Expense::$this->errors)) {

            $sql = "SELECT `expenses_category_default`.`name` as `Category`,
                    SUM(`expenses`.`amount`) as Amount 
                    FROM `expenses` 
                    INNER JOIN `expenses_category_default` 
                    ON `expenses`.`expense_category_assigned_to_user_id` = `expenses_category_default`.`id`
                    WHERE `user_id` = :userId 
                    AND `expenses`.`date_of_expense` 
                    BETWEEN :firstDay AND :lastDay 
                    GROUP BY `Category` 
                    ORDER BY `Amount`  
                    DESC";

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindValue(':firstDay', $firstDay, PDO::PARAM_STR);
            $stmt->bindValue(':lastDay', $lastDay, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        return false;
    }//end getAllExpenses()

    /**
     * * Get all expenses data for google charts.
     */
    public static function getPieChartExpenses($firstDay,$lastDay)
    {
        if (empty(Expense::$this->errors)) {

            $sql = "SELECT `expenses_category_default`.`name` as `Category`,
                    SUM(`expenses`.`amount`) as `Amount` 
                    FROM `expenses` 
                    INNER JOIN `expenses_category_default` 
                    ON `expenses`.`expense_category_assigned_to_user_id` = `expenses_category_default`.`id` 
                    WHERE `user_id` = :userId 
                    AND `expenses`.`date_of_expense`
                    BETWEEN :firstDay AND :lastDay
                    GROUP BY `Category` 
                    ORDER BY `Amount`  
                    DESC";

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindValue(':firstDay', $firstDay, PDO::PARAM_STR);
            $stmt->bindValue(':lastDay', $lastDay, PDO::PARAM_STR);
            $stmt->execute();
            $tablica = array();
            $i = 1;
            while (($row = $stmt->fetch(PDO::FETCH_ASSOC))) {
                $firstLine = true;
                if ($firstLine) {
                    $tablica[0] = array_keys($row);
                    $firstLine = false;
                }
                $category = $row['Category'];
                $amount = $row['Amount'];
                $tablica[$i] = array(strval($category), floatval($amount));
                $i++;
            }
            return $tablica;
        }

        return false;
    }//end getPieChartExpenses()

    /**
     * * Get user's all detailed expenses (at given period).
     */
    public static function getDetailedExpenses($firstDay,$lastDay)
    {
        if (empty(Expense::$this->errors)) {

            $sql = "SELECT `expenses`.`date_of_expense` as `Date`,
					`expenses_category_default`.`name` as `Category`, 
					`expenses`.`amount` as `Amount`,
					`payment_methods_default`.`name` as `Payment`,
					`expenses`.`expense_comment` as `Comment`
					FROM `expenses` 
					INNER JOIN `expenses_category_default` 
					ON `expenses`.`expense_category_assigned_to_user_id` = `expenses_category_default`.`id` 
					INNER JOIN `payment_methods_default`
					ON `expenses`.`payment_method_assigned_to_user_id` = `payment_methods_default`.`id`
					WHERE `user_id` = :userId 
					AND `expenses`.`date_of_expense`
                    BETWEEN :firstDay AND :lastDay
					ORDER BY `Date` 
					ASC";

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindValue(':firstDay', $firstDay, PDO::PARAM_STR);
            $stmt->bindValue(':lastDay', $lastDay, PDO::PARAM_STR);

            $stmt->execute();
            return $stmt->fetchAll();
        }

        return false;
    }//end getDetailedExpenses()

    /**
     * * Get user's all detailed incomes (at given period).
     */
    public static function getDetailedIncomes($firstDay,$lastDay)
    {
        if (empty(Expense::$this->errors)) {

            $sql = "SELECT `incomes`.`date_of_income` as `Date`,
					`incomes_category_default`.`name` as `Category`, 
					`incomes`.`amount` as `Amount`,
					`incomes`.`income_comment` as `Comment`
					FROM `incomes` 
					INNER JOIN `incomes_category_default` 
					ON `incomes`.`income_category_assigned_to_user_id` = `incomes_category_default`.`id` 
					WHERE `user_id` = :userId 
					AND `incomes`.`date_of_income`
                    BETWEEN :firstDay AND :lastDay
					ORDER BY `Date` 
					ASC";

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindValue(':firstDay', $firstDay, PDO::PARAM_STR);
            $stmt->bindValue(':lastDay', $lastDay, PDO::PARAM_STR);

            $stmt->execute();
            return $stmt->fetchAll();
        }

        return false;
    }//end getDetailedIncomes()

    /**
     * * Get user's all incomes (at given period).
     */
    public static function getAllIncomes($firstDay,$lastDay)
    {
        if (empty(Income::$this->errors)) {

            $sql = "SELECT `incomes_category_default`.`name` as `Category`,
                    SUM(`incomes`.`amount`) as `Amount` 
                    FROM `incomes` 
                    INNER JOIN `incomes_category_default` 
                    ON `incomes`.`income_category_assigned_to_user_id` = `incomes_category_default`.`id` 
                    WHERE `user_id` = :userId 
                    AND `incomes`.`date_of_income`
                    BETWEEN :firstDay AND :lastDay
                    GROUP BY `Category` 
                    ORDER BY `Amount`  
                    DESC";

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindValue(':firstDay', $firstDay, PDO::PARAM_STR);
            $stmt->bindValue(':lastDay', $lastDay, PDO::PARAM_STR);

            $stmt->execute();
            return $stmt->fetchAll();
        }

        return false;
    }//end getAllIncomes()

    /**
     * * Get all incomes data for google charts.
     */
    public static function getPieChartIncomes($firstDay,$lastDay)
    {
        if (empty(Income::$this->errors)) {

            $sql = "SELECT `incomes_category_default`.`name` as `Category`,
                    SUM(`incomes`.`amount`) as `Amount` 
                    FROM `incomes` 
                    INNER JOIN `incomes_category_default` 
                    ON `incomes`.`income_category_assigned_to_user_id` = `incomes_category_default`.`id` 
                    WHERE `user_id` = :userId 
                    AND `incomes`.`date_of_income`
                    BETWEEN :firstDay AND :lastDay
                    GROUP BY `Category` 
                    ORDER BY `Amount`  
                    DESC";

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindValue(':firstDay', $firstDay, PDO::PARAM_STR);
            $stmt->bindValue(':lastDay', $lastDay, PDO::PARAM_STR);

            $i = 1;
            $stmt->execute();
            $tablica = array();

            while (($row = $stmt->fetch(PDO::FETCH_ASSOC))) {
                $firstLine = true;
                if ($firstLine) {
                    $tablica[0] = array_keys($row);
                    $firstLine = false;
                }
                $category = $row['Category'];
                $amount = $row['Amount'];
                $tablica[$i] = array(strval($category), floatval($amount));
                $i++;
            }
            return $tablica;
        }

        return false;
    }//end getPieChartIncomes()

    /**
     * * Get sum of all expenses/incomes.
     */
    public static function calcSum($sqlArray)
    {
        $sum = 0.0;
        foreach ($sqlArray as $values) {
            $sum += floatval($values['Amount']);
        }
        return $sum;
    }//end calcSum()

}//end class