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
        $first_day = date('Y-m-01');
        $last_day = date('Y-m-t');
        $period_info = "Okres czasu od " . $first_day . " do " . $last_day;
        $period = "BETWEEN '" . $first_day . "' AND '" . $last_day . "'";
        $incomesArray = Balance::getPieChartIncomes($period);
        $expensesArray = Balance::getPieChartExpenses($period);

        View::renderTemplate(
            'Balance/Show.html',
            array(
                'incomes' => Balance::getAllIncomes($period),
                'expenses' => Balance::getAllExpenses($period),
                'jsonincomes' => json_encode($incomesArray),
                'jsonexpenses' => json_encode($expensesArray),
                'incomesSum' => Balance::calcSum(Balance::getAllIncomes($period)),
                'expensesSum' => Balance::calcSum(Balance::getAllExpenses($period)),
                'period_info' => $period_info,
                'detailedExpenses' => Balance::getDetailedExpenses($period),
                'detailedIncomes' => Balance::getDetailedIncomes($period)
            )
        );
    }

    /**
     * * Show user previous month balance.
     */
    public function showPreviousMonthAction()
    {
        $first_day = date('Y-m-d', strtotime('first day of last month'));
        $last_day = date('Y-m-d', strtotime('last day of last month'));
        $period_info = "Okres czasu od " . $first_day . " do " . $last_day;
        $period = "BETWEEN '" . $first_day . "' AND '" . $last_day . "'";
        $incomesArray = Balance::getPieChartIncomes($period);
        $expensesArray = Balance::getPieChartExpenses($period);

        View::renderTemplate(
            'Balance/Show.html',
            array(
                'incomes' => Balance::getAllIncomes($period),
                'expenses' => Balance::getAllExpenses($period),
                'jsonincomes' => json_encode($incomesArray),
                'jsonexpenses' => json_encode($expensesArray),
                'incomesSum' => Balance::calcSum(Balance::getAllIncomes($period)),
                'expensesSum' => Balance::calcSum(Balance::getAllExpenses($period)),
                'period_info' => $period_info,
                'detailedExpenses' => Balance::getDetailedExpenses($period),
                'detailedIncomes' => Balance::getDetailedIncomes($period)
            )
        );

    }

    /**
     * * Show user current year balance.
     */
    public function showCurrentYearAction()
    {
        $first_day = date('Y-m-d', strtotime('first day of January'));
        $last_day = date('Y-m-d', strtotime('last day of December'));
        $period_info = "Okres czasu od " . $first_day . " do " . $last_day;
        $period = "BETWEEN '" . $first_day . "' AND '" . $last_day . "'";
        $incomesArray = Balance::getPieChartIncomes($period);
        $expensesArray = Balance::getPieChartExpenses($period);

        View::renderTemplate(
            'Balance/Show.html',
            array(
                'incomes' => Balance::getAllIncomes($period),
                'expenses' => Balance::getAllExpenses($period),
                'jsonincomes' => json_encode($incomesArray),
                'jsonexpenses' => json_encode($expensesArray),
                'incomesSum' => Balance::calcSum(Balance::getAllIncomes($period)),
                'expensesSum' => Balance::calcSum(Balance::getAllExpenses($period)),
                'period_info' => $period_info,
                'detailedExpenses' => Balance::getDetailedExpenses($period),
                'detailedIncomes' => Balance::getDetailedIncomes($period)
            )
        );
    }
    /**
     * * Show user custom period balance.
     */
    public function showCustomAction()
    {
        $period_info = "Okres czasu od " . $_POST['startDate'] . " do " . $_POST['endDate'];
        $period = "BETWEEN '" . $_POST['startDate'] . "' AND '" . $_POST['endDate'] . "'";
        $incomesArray = Balance::getPieChartIncomes($period);
        $expensesArray = Balance::getPieChartExpenses($period);

        View::renderTemplate(
            'Balance/Show.html',
            array(
                'incomes' => Balance::getAllIncomes($period),
                'expenses' => Balance::getAllExpenses($period),
                'jsonincomes' => json_encode($incomesArray),
                'jsonexpenses' => json_encode($expensesArray),
                'incomesSum' => Balance::calcSum(Balance::getAllIncomes($period)),
                'expensesSum' => Balance::calcSum(Balance::getAllExpenses($period)),
                'period_info' => $period_info,
                'detailedExpenses' => Balance::getDetailedExpenses($period),
                'detailedIncomes' => Balance::getDetailedIncomes($period)
            )
        );
    }
}