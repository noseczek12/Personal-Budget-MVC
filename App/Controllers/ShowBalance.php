<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Balance;

// Balance Controller

class ShowBalance extends \Core\Controller
{

    //pokazuje bilans użytkownika z bieżącego miesiąca (opcja domyślna)
    public function showCurrentAction()
    {
        $first_day = date('Y-m-01');
        $last_day = date('Y-m-t');
        $period = "BETWEEN '".$first_day."' AND '".$last_day."'";
        $incomesArray=Balance::getPieChartIncomes($period);
        $expensesArray=Balance::getPieChartExpenses($period);
        
        View::renderTemplate('Balance/show.html',
        array('incomes'=> Balance::getAllIncomes($period), 'expenses'=> Balance::getAllExpenses($period), 
        'jsonincomes'=>json_encode($incomesArray), 'jsonexpenses'=>json_encode($expensesArray),
        'incomesSum' => Balance::calcSum(Balance::getAllIncomes($period)), 'expensesSum'=> Balance::calcSum(Balance::getAllExpenses($period))));
    }

    //wyświetlanie poprzedniego miesiąca
    public function showPreviousAction()
    {
        $first_day = date('Y-m-d', strtotime('first day of last month'));
        $last_day = date('Y-m-d', strtotime('last day of last month'));
        $period = "BETWEEN '".$first_day."' AND '".$last_day."'";
        $incomesArray=Balance::getPieChartIncomes($period);
        $expensesArray=Balance::getPieChartExpenses($period);
        
        View::renderTemplate('Balance/show.html',
        array('incomes'=> Balance::getAllIncomes($period), 'expenses'=> Balance::getAllExpenses($period), 
        'jsonincomes'=>json_encode($incomesArray), 'jsonexpenses'=>json_encode($expensesArray),
        'incomesSum' => Balance::calcSum(Balance::getAllIncomes($period)), 'expensesSum'=> Balance::calcSum(Balance::getAllExpenses($period))));

    }


}