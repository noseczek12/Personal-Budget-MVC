<?php

namespace App\Controllers;

use App\Auth;
use App\Flash;
use App\Models\User;
use Core\View;

/**
 * * Login Controller.
 */
class Login extends \Core\Controller
{
    /**
     * * Function showing login page.
     */
    public function newAction()
    {
        View::renderTemplate('Login/new.html');
    }// end newAction();

    /**
     * * Loggin user function.
     */
    public function createAction()
    {
        $user = User::authenticate(
            $_POST['email'],
            $_POST['password']
        );
        $remember_me = isset($_POST['remember_me']);
        if ($user) {
            Auth::login(
                $user,
                $remember_me
            );
            Flash::addMessage('Zalogowano pomyślnie.');
            $this->redirect(Auth::getReturnToPage());
        } else {
            Flash::addMessage(
                'Nie udało się zalogować. Spróbuj ponownie.',
                Flash::WARNING
            );
            View::renderTemplate(
                'Login/new.html',
                ['email' => $_POST['email'],
                    'remember_me' => $remember_me, ]
            );
        }
    }// end createAction()

    /**
     * * Logout function.
     */
    public function destroyAction()
    {
        Auth::logout();
        $this->redirect('/login/show-logout-message');
    }// end destroyAction()

    /**
     * * Show logout message.
     */
    public function showLogoutMessageAction()
    {
        Flash::addMessage('Wylogowano pomyślnie.');
        $this->redirect(Auth::getReturnToPage());
    }// end showLogoutMessageAction()
}// end class
