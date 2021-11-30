<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Income;
use \App\Models\Expense;

// Balance Controller

class Balance extends \Core\Controller
{

    //pokazuje bilans użytkownika
    public function showAction()
    {
        $array=Income::getPieChartIncomes();
        $chartArray = Income::convertDataToChartForm($array);
        echo var_dump(json_encode($chartArray));
        //View::renderTemplate('Balance/show.html', 
        //array('incomes'=> Income::getAllIncomes(), 'expenses'=> Expense::getAllExpenses(), 'jsonincomes'=>json_encode($chartArray)));
    }

}