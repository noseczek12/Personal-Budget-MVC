<?php

namespace App\Controllers;

use \Core\View;

//Profile controller

class Profile extends Authenticated
{
    //pokazuje profil użytkownika
    public function showAction()
    {
        View::renderTemplate('Profile/show.html');
    }
}