<?php

namespace App\Controllers\Admin;

/* User admin controller */

class Users extends \Core\Controller
{

    // Filtr przed
    protected function before()
    {
        // Make sure an admin user is logged in for example
        // return false;
    }

    //funkcja pokauzująca stronę index
    public function indexAction()
    {
        echo 'User admin index';
    }
}
