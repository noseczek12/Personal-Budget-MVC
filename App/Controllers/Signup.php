<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/** 
 * Signup controller.
 **/
class Signup extends \Core\Controller
{
    /** 
     * Function showing Signup Page.
     **/
    public function newAction()
    {
        View::renderTemplate('Signup/new.html');
    }//end newAction()

    /** 
     * Function creating new user.
     **/
    public function createAction()
    {
        $user = new User($_POST);
        if ($user->save()) {
            $user->addExpenseCategories();
            $user->addIncomeCategories();
            $user->sendActivationEmail();
            $this->redirect('/signup/success');
        } else {
            View::renderTemplate(
                'Signup/new.html',
                ['user' => $user]
            );
        }
    }//end createAction()

    /** 
     * Shows signup success action.
     **/
    public function successAction()
    {
        View::renderTemplate('Signup/success.html');
    }//end successAction()

    /** 
     * New account activation.
     **/
    public function activateAction()
    {
        User::activate($this->route_params['token']);
        $this->redirect('/signup/activated');
    }//end activateAction()

    /** 
     * Shows page during signup success.
     **/
    public function activatedAction()
    {
        View::renderTemplate('Signup/activated.html');
    }//end activatedAction()
}//end class
