<?php

namespace App\Controllers;

use Core\View;

/**
 * *Home controller.
 */
class Home extends \Core\Controller
{
    /**
     * *Function showing index page.
     */
    public function indexAction()
    {
        View::renderTemplate('Home/index.html');
    }

// end indexAction()
    protected function before()
    {
        // echo "(before)";
    }// end before()

    protected function after()
    {
        // echo "(after)";
    }// end after()
}// end class
