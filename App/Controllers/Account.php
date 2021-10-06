<?php

namespace App\Controllers;

use \App\Models\User;

//Account controller

class Account extends \Core\Controller
{

  //funkcja sprawdzająca czy email już istnieje
  public function validateEmailAction()
  {
    $is_valid = ! User::emailExists($_GET['email']);

    header('Content-Type: application/json');
    echo json_encode($is_valid);
  }
}
