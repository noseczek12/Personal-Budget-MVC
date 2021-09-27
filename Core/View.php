<?php

namespace Core;

/* View*/

class View
{

    //renderowanie widoku
    public static function render($view)
    {
        $file = "../App/Views/$view";  // przekierowanie do folderu Core

        if (is_readable($file)) {
            require $file;
        } else {
            echo "$file not found";
        }
    }
}