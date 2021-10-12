<?php

namespace App\Controllers;
use \Core\View;
use App\Models\Post;

/* Posts Controller */
class Posts extends \Core\Controller
{

    // funkcja wyświetlająca stronę index 
    public function indexAction()
    {
		$posts = Post::getAll();
		
       View::renderTemplate('Posts/index.html', [
					'posts' => $posts
		]);
    }

     // funkcja wyświetlająca stronę add-new 
    public function addNewAction()
    {
        echo 'Hello from the addNew action in the Posts controller!';
    }
	
	// funkcja wyświetlająca stronę edit 
	 public function editAction()
    {
        echo 'Hello from the edit action in the Posts controller!';
        echo '<p>Route parameters: <pre>' .
             htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';
    }
}
