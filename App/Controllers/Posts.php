<?php

namespace App\Controllers;

use App\Models\Post;
use Core\View;

/**
 * * Logout function.
 */
class Posts extends \Core\Controller
{
    /**
     * * Function showing index page.
     */
    public function indexAction()
    {
        $posts = Post::getAll();

        View::renderTemplate(
            'Posts/index.html',
            ['posts' => $posts]
        );
    }// end indexAction()

    /**
     * * Function showing add new post page.
     */
    public function addNewAction()
    {
        echo 'Hello from the addNew action in the Posts controller!';
    }// end addNewAction()

    // funkcja wyświetlająca stronę edit
    public function editAction()
    {
        echo 'Hello from the edit action in the Posts controller!';
        echo '<p>Route parameters: <pre>'.
        htmlspecialchars(print_r(
            $this->route_params,
            true
        )).'</pre></p>';
    }// end editAction()
}// end class
