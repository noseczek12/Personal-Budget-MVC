<?php

namespace App\Controllers;

use App\Models\User;

/**
 * Account controller.
 */
class Account extends \Core\Controller
{
    /**
     * Function checking if email exists.
     */
    public function validateEmailAction()
    {
        $isValid = !User::emailExists($_GET['email'], $_GET['ignore_id'] ?? null);

        header('Content-Type: application/json');
        echo json_encode($isValid);
    }// end validateEmailAction()
}// end class
