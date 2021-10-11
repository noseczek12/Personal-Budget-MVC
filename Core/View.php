<?php

namespace Core;

/* View*/

class View
{

    //renderowanie widoku
   public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = "../App/Views/$view";  // relative to Core directory

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }
	
	//renderowanie widoku z użyciem Twiga
	public static function renderTemplate($template, $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig\Loader\FilesystemLoader('../App/Views');
            $twig = new \Twig\Environment($loader);
			$twig->addGlobal('session' , $_SESSION);
        }

        echo $twig->render($template, $args);
    }
}