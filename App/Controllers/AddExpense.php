<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Expense;

/* Expense controller */
class AddExpense extends \Core\Controller
{
    //funkcja wyśwetlająca stronę dodającą nowy wydatek
    public function newAction()
    {
        View::renderTemplate('Expense/new.html');
    }

    //funkcja tworząca wpis w bazie danych
    public function createAction()
	{
		$expense = new Expense($_POST);
        if ($expense->save()) {
			$this->redirect('/addexpense/success');
       } else {
            View::renderTemplate('Expense/new.html', [
                'expense' => $expense
            ]);
       }
	}

    //wyświetlenie strony przy sukcesie dodania wydatku
    public function successAction()
	{
		View::renderTemplate('Expense/success.html');
	}
}