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
        $incomesArray=Income::getPieChartIncomes();
        $expensesArray=Expense::getPieChartExpenses();
        $chartIncomesArray = Income::convertDataToChartForm($incomesArray);
        $chartExpensesArray = Expense::convertDataToChartForm($expensesArray);
        View::renderTemplate('Balance/show.html',
        array('incomes'=> Income::getAllIncomes(), 'expenses'=> Expense::getAllExpenses(), 
        'jsonincomes'=>json_encode($chartIncomesArray), 'jsonexpenses'=>json_encode($chartExpensesArray),
        'incomesSum' => Income::calcSum($incomesArray), 'expensesSum'=> Expense::calcSum($expensesArray)));
    }

}