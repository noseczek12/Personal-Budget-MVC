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
       echo static::getTemplate($template, $args);
    }
	
	//renderowanie widoku z użyciem Twiga
	public static function getTemplate($template, $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig\Loader\FilesystemLoader('../App/Views');
            $twig = new \Twig\Environment($loader);
			$twig->addGlobal('current_user', \App\Auth::getUser());
			$twig->addGlobal('flash_messages', \App\Flash::getMessages());
        }

        return $twig->render($template, $args);
    }
}