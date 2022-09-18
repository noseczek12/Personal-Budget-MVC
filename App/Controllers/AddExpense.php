<?php

namespace App\Controllers;

use App\Models\Expense;
use Core\View;

/**
 * Expense controller.
 */
class AddExpense extends \Core\Controller
{
    /**
     * Function showing adding expense page.
     */
    public function newAction()
    {
        View::renderTemplate('Expense/new.html');
    }// end newAction()

    /**
     * Function creating database entry.
     */
    public function createAction()
    {
        $expense = new Expense($_POST);
        if (true === $expense->save()) {
            $this->redirect('/addexpense/success');
        } else {
            View::renderTemplate(
                'Expense/new.html',
                ['expense' => $expense]
            );
        }
    }// end createAction()

    /**
     * Show success page after properly added expense.
     */
    public function successAction()
    {
        View::renderTemplate('Expense/success.html');
    }// end successAction()
}// end class
