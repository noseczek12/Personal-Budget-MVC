<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;
use Core\View;

/**
 * Password controller.
 **/
class Password extends Controller
{
    /**
     * Shows page forgot password.
     **/
    public function forgotAction()
    {
        View::renderTemplate('Password/forgot.html');
    }//end forgotAction()

    /**
     * Sends link with password reset action.
     **/
    public function requestResetAction()
    {
        User::sendPasswordReset($_POST['email']);
        View::renderTemplate('Password/reset_requested.html');
    }//end requestResetAction()

    /**
     * Executes password reset and sends unique reset token.
     **/
    public function resetAction()
    {
        $token = $this->route_params['token'];
        $user = $this->getUserOrExit($token);

        View::renderTemplate(
            'Password/reset.html',
            ['token' => $token]
        );
    }//end resetAction()

    /**
     * Function that makes password reset.
     **/
    protected function getUserOrExit($token)
    {
        $user = User::findByPasswordReset($token);

        if ($user === true) {
            return $user;
        } else {
            View::renderTemplate('Password/token_expired.html');
            exit;
        }
    }//end getUserOrExit()

    /**
     * Function that finds User connected with token.
     **/
    public function resetPasswordAction()
    {
        $token = $_POST['token'];
        $user = $this->getUserOrExit($token);

        if ($user->resetPassword($_POST['password'])) {
            View::renderTemplate('Password/reset_success.html');
        } else {
            View::renderTemplate(
                'Password/reset.html',
                ['token' => $token,
                    'user' => $user]
            );
        }
    }//end resetPasswordAction()
}//end class