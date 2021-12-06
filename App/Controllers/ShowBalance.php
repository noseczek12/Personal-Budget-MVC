<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Balance;

// Balance Controller

class ShowBalance extends \Core\Controller
{

    //pokazuje bilans użytkownika
    public function showAction()
    {
        $incomesArray=Balance::getPieChartIncomes();
        $expensesArray=Balance::getPieChartExpenses();
        
        View::renderTemplate('Balance/show.html',
        array('incomes'=> Balance::getAllIncomes(), 'expenses'=> Balance::getAllExpenses(), 
        'jsonincomes'=>json_encode($incomesArray), 'jsonexpenses'=>json_encode($expensesArray),
        'incomesSum' => Balance::calcSum(Balance::getAllIncomes()), 'expensesSum'=> Balance::calcSum(Balance::getAllExpenses())));
    }

}