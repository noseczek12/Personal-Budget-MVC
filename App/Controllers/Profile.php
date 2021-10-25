<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;

//Profile controller

class Profile extends Authenticated
{
    //filtr przed - wywoływany przed każdą metodą
    protected function before()
    {
        parent::before();
        $this->user = Auth::getUser();

    }

    //pokazuje profil użytkownika
    public function showAction()
    {
        View::renderTemplate('Profile/show.html', [
            'user' => $this->user
        ]);
    }

    //pokazuje formularz edycji profilu
    public function editAction()
    {
        View::renderTemplate('Profile/edit.html', [
            'user' => $this->user
        ]);
    }

    //aktualizuje profil
    public function updateAction()
    {
        if ($this->user->updateProfile($_POST)){
            Flash::addMessage('Changes saved');
            $this->redirect('/profile/show');
        }else{
            View::renderTemplate('Profile/edit.html', [
                'user' => $this->user
            ]);
        }
    }
}