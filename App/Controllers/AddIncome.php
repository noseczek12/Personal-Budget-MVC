<?php

namespace App\Controllers;

use App\Models\Income;
use Core\View;

/**
 * Income controller.
 */
class AddIncome extends \Core\Controller
{
    /**
     * Funkcja wyśwetlająca stronę dodającą nowy przychód.
     */
    public function newAction()
    {
        View::renderTemplate('Income/new.html');
    }// end newAction()

    /**
     * Funkcja tworząca wpis w bazie danych.
     */
    public function createAction()
    {
        $income = new Income($_POST);
        if (true === $income->save()) {
            $this->redirect('/addincome/success');
        } else {
            View::renderTemplate(
                'Income/new.html',
                ['income' => $income]
            );
        }
    }// end createAction()

    /**
     * Wyświetlenie strony przy sukcesie dodania przychodu.
     */
    public function successAction()
    {
        View::renderTemplate('Income/success.html');
    }// end successAction()
}// end class
