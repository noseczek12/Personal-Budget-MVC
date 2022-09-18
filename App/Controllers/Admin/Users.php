<?php

namespace App\Controllers\Admin;

/**
 * User admin controller.
 */
class Users extends \Core\Controller
{
    /**
     * Function showing index page.
     */
    public function indexAction()
    {
        echo 'User admin index';
    }

// end indexAction()
    /**
     * Filter before show.
     */
    protected function before()
    {
        // Make sure an admin user is logged in for example.
        // return false.
    }// end before()
}// end class
