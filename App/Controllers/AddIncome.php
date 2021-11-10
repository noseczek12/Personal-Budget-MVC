<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Income;

/* Income controller */
class AddIncome extends \Core\Controller
{
    //funkcja wyśwetlająca stronę dodającą nowy przychód
    public function newAction()
    {
        View::renderTemplate('Income/new.html');
    }

    //funkcja tworząca wpis w bazie danych
    public function createAction()
	{
		$income = new Income($_POST);
        if ($income->save()) {
			$this->redirect('/income/success');
       } else {
            View::renderTemplate('Income/new.html', [
                'income' => $income
            ]);
       }
	}
}