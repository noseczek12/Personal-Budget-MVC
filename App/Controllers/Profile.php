<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;

//Profile controller

class Profile extends Authenticated
{
    //pokazuje profil użytkownika
    public function showAction()
    {
        View::renderTemplate('Profile/show.html', [
            'user' => Auth::getUser()
        ]);
    }

    //pokazuje formularz edycji profilu
    public function editAction()
    {
        View::renderTemplate('Profile/edit.html', [
            'user' => Auth::getUser()
        ]);
    }

    //aktualizuje profil
    public function updateAction()
    {
        $user = Auth::getUser();
        if ($user->updateProfile($_POST)){
            Flash::addMessage('Changes saved');
            $this->redirect('/profile/show');
        }else{
            View::renderTemplate('Profile/edit.html', [
                'user' => $user
            ]);
        }
    }
}