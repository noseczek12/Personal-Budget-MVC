<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;

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
}