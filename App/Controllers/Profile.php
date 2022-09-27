<?php

namespace App\Controllers;

use App\Auth;
use App\Flash;
use App\Models\Balance;
use Core\View;

/**
 * Profile controller.
 **/

class Profile extends Authenticated
{
    /**
     * Shows user profile credentials.
     **/
    public function showAction()
    {
        View::renderTemplate(
            'Profile/show.html',
            ['user' => $this->user,
            'expenseCategories' => Balance::getExpensesCategories(),
            'incomeCategories' => Balance::getIncomesCategories(),
            'paymentMethods' => Balance::getPaymentMethods()]
        );
    }//end showAction()

    /**
     * Shows update user profile.
     **/
    public function updateAction()
    {
        if ($this->user->updateProfile($_POST)) {
            Flash::addMessage('Zapisano zmiany.');
            $this->redirect('/profile/show');
        } else {
            View::renderTemplate(
                'Profile/edit.html',
                ['user' => $this->user]
            );
        }
    }//end updateAction()

    /**
     * Before filter.
     **/
    protected function before()
    {
        parent::before();
        $this->user = Auth::getUser();
    }//end before()
}//end class
