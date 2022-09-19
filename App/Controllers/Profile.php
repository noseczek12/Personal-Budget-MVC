<?php

namespace App\Controllers;

use App\Auth;
use App\Flash;
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
            ['user' => $this->user]
        );
    }//end showAction()

    /**
     * Shows user profile.
     **/
    public function editAction()
    {
        View::renderTemplate(
            'Profile/edit.html',
            ['user' => $this->user]
        );
    }//end editAction()

    /**
     * Shows update user profile.
     **/
    public function updateAction()
    {
        if ($this->user->updateProfile($_POST)) {
            Flash::addMessage('Changes saved');
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
