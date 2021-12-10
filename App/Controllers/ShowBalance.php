<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Balance;

// Balance Controller

class ShowBalance extends \Core\Controller
{

    //pokazuje bilans użytkownika z bieżącego miesiąca (opcja domyślna)
    public function showCurrentMonthAction()
    {
        $first_day = date('Y-m-01');
        $last_day = date('Y-m-t');
        $period_info = "Okres czasu od ".$first_day." do ".$last_day;
        $period = "BETWEEN '".$first_day."' AND '".$last_day."'";
        $incomesArray=Balance::getPieChartIncomes($period);
        $expensesArray=Balance::getPieChartExpenses($period);
        
        View::renderTemplate('Balance/Show.html',
        array('incomes'=> Balance::getAllIncomes($period), 'expenses'=> Balance::getAllExpenses($period), 
        'jsonincomes'=>json_encode($incomesArray), 'jsonexpenses'=>json_encode($expensesArray),
        'incomesSum' => Balance::calcSum(Balance::getAllIncomes($period)), 'expensesSum'=> Balance::calcSum(Balance::getAllExpenses($period)),
        'period_info' => $period_info, 'detailedExpenses'=>Balance::getDetailedExpenses($period)));
    }

    //pokazuje bilans użytkownika z poprzedniego miesiąca
    public function showPreviousMonthAction()
    {
        $first_day = date('Y-m-d', strtotime('first day of last month'));
        $last_day = date('Y-m-d', strtotime('last day of last month'));
        $period_info = "Okres czasu od ".$first_day." do ".$last_day;
        $period = "BETWEEN '".$first_day."' AND '".$last_day."'";
        $incomesArray=Balance::getPieChartIncomes($period);
        $expensesArray=Balance::getPieChartExpenses($period);
        
        View::renderTemplate('Balance/Show.html',
        array('incomes'=> Balance::getAllIncomes($period), 'expenses'=> Balance::getAllExpenses($period), 
        'jsonincomes'=>json_encode($incomesArray), 'jsonexpenses'=>json_encode($expensesArray),
        'incomesSum' => Balance::calcSum(Balance::getAllIncomes($period)), 'expensesSum'=> Balance::calcSum(Balance::getAllExpenses($period)),
        'period_info' => $period_info, 'detailedExpenses'=>Balance::getDetailedExpenses($period)));

    }

    //pokazuje bilans użytkownika z bieżącego roku
    public function showCurrentYearAction()
    {
        $first_day = date('Y-m-d', strtotime('first day of January'));
        $last_day = date('Y-m-d', strtotime('last day of December'));
        $period_info = "Okres czasu od ".$first_day." do ".$last_day;
        $period = "BETWEEN '".$first_day."' AND '".$last_day."'";
        $incomesArray=Balance::getPieChartIncomes($period);
        $expensesArray=Balance::getPieChartExpenses($period);
        
        View::renderTemplate('Balance/Show.html',
        array('incomes'=> Balance::getAllIncomes($period), 'expenses'=> Balance::getAllExpenses($period), 
        'jsonincomes'=>json_encode($incomesArray), 'jsonexpenses'=>json_encode($expensesArray),
        'incomesSum' => Balance::calcSum(Balance::getAllIncomes($period)), 'expensesSum'=> Balance::calcSum(Balance::getAllExpenses($period)),
        'period_info' => $period_info, 'detailedExpenses'=>Balance::getDetailedExpenses($period)));
    }

    //pokazuje bilans użytkownika z wybranego okresu czasu
    public function showCustomAction()
    {
        $period_info = "Okres czasu od ".$_POST['startDate']." do ".$_POST['endDate'];
        $period = "BETWEEN '".$_POST['startDate']."' AND '".$_POST['endDate']."'";
        $incomesArray=Balance::getPieChartIncomes($period);
        $expensesArray=Balance::getPieChartExpenses($period);
        
        View::renderTemplate('Balance/Show.html',
        array('incomes'=> Balance::getAllIncomes($period), 'expenses'=> Balance::getAllExpenses($period), 
        'jsonincomes'=>json_encode($incomesArray), 'jsonexpenses'=>json_encode($expensesArray),
        'incomesSum' => Balance::calcSum(Balance::getAllIncomes($period)), 'expensesSum'=> Balance::calcSum(Balance::getAllExpenses($period)),
        'period_info' => $period_info, 'detailedExpenses'=>Balance::getDetailedExpenses($period)));
    }


}