<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;
use App\Models\Balance;

/**
 * * ShowBalance Controller.
 */
class ShowBalance extends Controller
{
    /**
     * * Show user current month balance (default option).
     */
    public function showCurrentMonthAction()
    {
        $firstDay = date('Y-m-01');
        $lastDay = date('Y-m-t');
        $period_info = 'Okres czasu od ' . $firstDay . ' do ' . $lastDay;
        $incomesArray = Balance::getPieChartIncomes($firstDay, $lastDay);
        $expensesArray = Balance::getPieChartExpenses($firstDay, $lastDay);

        View::renderTemplate(
            'Balance/Show.html',
            array(
                'incomes' => Balance::getAllIncomes($firstDay, $lastDay),
                'expenses' => Balance::getAllExpenses($firstDay, $lastDay),
                'jsonincomes' => json_encode($incomesArray),
                'jsonexpenses' => json_encode($expensesArray),
                'incomesSum' => Balance::calcSum(Balance::getAllIncomes($firstDay, $lastDay)),
                'expensesSum' => Balance::calcSum(Balance::getAllExpenses($firstDay, $lastDay)),
                'period_info' => $period_info,
                'detailedExpenses' => Balance::getDetailedExpenses($firstDay, $lastDay),
                'detailedIncomes' => Balance::getDetailedIncomes($firstDay, $lastDay)
            )
        );
    }//end showCurrentMonthAction()

    /**
     * * Show user previous month balance.
     */
    public function showPreviousMonthAction()
    {
        $firstDay = date('Y-m-d', strtotime('first day of last month'));
        $lastDay = date('Y-m-d', strtotime('last day of last month'));
        $period_info = 'Okres czasu od ' . $firstDay . ' do ' . $lastDay;
        $incomesArray = Balance::getPieChartIncomes($firstDay, $lastDay);
        $expensesArray = Balance::getPieChartExpenses($firstDay, $lastDay);

        View::renderTemplate(
            'Balance/Show.html',
            array(
                'incomes' => Balance::getAllIncomes($firstDay, $lastDay),
                'expenses' => Balance::getAllExpenses($firstDay, $lastDay),
                'jsonincomes' => json_encode($incomesArray),
                'jsonexpenses' => json_encode($expensesArray),
                'incomesSum' => Balance::calcSum(Balance::getAllIncomes($firstDay, $lastDay)),
                'expensesSum' => Balance::calcSum(Balance::getAllExpenses($firstDay, $lastDay)),
                'period_info' => $period_info,
                'detailedExpenses' => Balance::getDetailedExpenses($firstDay, $lastDay),
                'detailedIncomes' => Balance::getDetailedIncomes($firstDay, $lastDay)
            )
        );
    }//end showPreviousMonthAction()

    /**
     * * Show user current year balance.
     */
    public function showCurrentYearAction()
    {
        $firstDay = date('Y-m-d', strtotime('first day of January'));
        $lastDay = date('Y-m-d', strtotime('last day of December'));
        $period_info = "Okres czasu od " . $firstDay . " do " . $lastDay;
        $incomesArray = Balance::getPieChartIncomes($firstDay, $lastDay);
        $expensesArray = Balance::getPieChartExpenses($firstDay, $lastDay);

        View::renderTemplate(
            'Balance/Show.html',
            array(
                'incomes' => Balance::getAllIncomes($firstDay, $lastDay),
                'expenses' => Balance::getAllExpenses($firstDay, $lastDay),
                'jsonincomes' => json_encode($incomesArray),
                'jsonexpenses' => json_encode($expensesArray),
                'incomesSum' => Balance::calcSum(Balance::getAllIncomes($firstDay, $lastDay)),
                'expensesSum' => Balance::calcSum(Balance::getAllExpenses($firstDay, $lastDay)),
                'period_info' => $period_info,
                'detailedExpenses' => Balance::getDetailedExpenses($firstDay, $lastDay),
                'detailedIncomes' => Balance::getDetailedIncomes($firstDay, $lastDay)
            )
        );
    }//end showCurrentYearAction()

    /**
     * * Show user custom period balance.
     */
    public function showCustomAction()
    {
        $period_info = "Okres czasu od " . $_POST['startDate'] . " do " . $_POST['endDate'];
        $incomesArray = Balance::getPieChartIncomes($_POST['startDate'], $_POST['endDate']);
        $expensesArray = Balance::getPieChartExpenses($_POST['startDate'], $_POST['endDate']);

        View::renderTemplate(
            'Balance/Show.html',
            array(
                'incomes' => Balance::getAllIncomes($_POST['startDate'], $_POST['endDate']),
                'expenses' => Balance::getAllExpenses($_POST['startDate'], $_POST['endDate']),
                'jsonincomes' => json_encode($incomesArray),
                'jsonexpenses' => json_encode($expensesArray),
                'incomesSum' => Balance::calcSum(Balance::getAllIncomes($_POST['startDate'], $_POST['endDate'])),
                'expensesSum' => Balance::calcSum(Balance::getAllExpenses($_POST['startDate'], $_POST['endDate'])),
                'period_info' => $period_info,
                'detailedExpenses' => Balance::getDetailedExpenses($_POST['startDate'], $_POST['endDate']),
                'detailedIncomes' => Balance::getDetailedIncomes($_POST['startDate'], $_POST['endDate'])
            )
        );
    }//end showCustomAction()
}//end class