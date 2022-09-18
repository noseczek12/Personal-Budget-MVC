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
     * Funkcja wyśwetlająca stronę dodającą nowy wydatek.
     */
    public function newAction()
    {
        View::renderTemplate('Expense/new.html');
    }// end newAction()

    /**
     * Funkcja tworząca wpis w bazie danych.
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
     * Wyświetlenie strony przy sukcesie dodania wydatku.
     */
    public function successAction()
    {
        View::renderTemplate('Expense/success.html');
    }// end successAction()
}// end class
