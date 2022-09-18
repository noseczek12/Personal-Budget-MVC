<?php

namespace App\Controllers;

/**
 * Authenticated base controller.
 */
abstract class Authenticated extends \Core\Controller
{
    /**
     * Function showing before action.
     */
    protected function before()
    {
        $this->requireLogin();
    }// end before()
}// end class
