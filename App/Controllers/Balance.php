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
        
        View::renderTemplate('Balance/show.html',
        array('incomes'=> Income::getAllIncomes(), 'expenses'=> Expense::getAllExpenses(), 
        'jsonincomes'=>json_encode($incomesArray), 'jsonexpenses'=>json_encode($expensesArray),
        'incomesSum' => Income::calcSum(Income::getAllIncomes()), 'expensesSum'=> Expense::calcSum(Expense::getAllExpenses())));
    }

}