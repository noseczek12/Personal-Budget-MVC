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
        $incomes = new Income();
        $expenses = new Expense();
        $incomes->getAllIncomes();
        View::renderTemplate('Balance/show.html', [
            'allIncomes' => $incomes
        ]);
    }

}