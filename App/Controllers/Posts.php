<?php

namespace App\Controllers;
/* Posts Controller */
class Posts extends \Core\Controller
{

    // funkcja wyświetlająca stronę index 
    public function index()
    {
        echo 'Hello from the index action in the Posts controller!';
    }

     // funkcja wyświetlająca stronę add-new 
    public function addNew()
    {
        echo 'Hello from the addNew action in the Posts controller!';
    }
	
	// funkcja wyświetlająca stronę edit 
	 public function edit()
    {
        echo 'Hello from the edit action in the Posts controller!';
        echo '<p>Route parameters: <pre>' .
             htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';
    }
}
