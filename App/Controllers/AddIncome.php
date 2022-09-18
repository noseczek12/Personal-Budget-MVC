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
     * Function showing adding income page.
     */
    public function newAction()
    {
        View::renderTemplate('Income/new.html');
    }// end newAction()

    /**
     * Function creating database entry.
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
     * Show success page after properly added income.
     */
    public function successAction()
    {
        View::renderTemplate('Income/success.html');
    }// end successAction()
}// end class
