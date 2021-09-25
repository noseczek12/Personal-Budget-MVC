<?php

namespace App\Controllers;
/* Posts Controller */
class Posts
{

    // funkcja wyświetlająca stronę index 
    public function index()
    {
        echo 'Hello from the index action in the Posts controller!';
		echo '<p>Query string parameters: <pre>' .
						htmlspecialchars(print_r($_GET, true)) . '</pre></p>';
    }

     // funkcja wyświetlająca stronę add-new 
    public function addNew()
    {
        echo 'Hello from the addNew action in the Posts controller!';
    }
}
