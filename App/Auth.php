<?php

namespace App;

use App\Models\User;

/**
 * * Authentication.
 */
class Auth
{
    /**
     * * Login Authentication.
     */
    public static function login($user, $remember_me)
    {
        session_regenerate_id(true);

        $_SESSION['user_id'] = $user->id;

        if ($remember_me) {
            if ($user->rememberLogin()) {
                setcookie(
                    'remember_me',
                    $user->remember_token,
                    $user->expiry_timestamp,
                    '/'
                );
            }
        }
    }//end login()

    /**
     * * Logout action.
     */
    public static function logout()
    {
        // wyłącz wszystkie zmienne sesyjne
        $_SESSION = array();

        // zniszcz sesję cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // i ostatecznie, zniszcz sesję
        session_destroy();
    }//end logout()

    /**
     * * Remembers requested page.
     */
    public static function rememberRequestedPage()
    {
        $_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
    }//end rememberRequestedPage()

    /**
     * * Returns to requested page.
     */
    public static function getReturnToPage()
    {
        return $_SESSION['return_to'] ?? ' ';
    }//end getReturnToPage()

    /**
     * * gets user by ID.
     */
    public static function getUser()
    {
        if (isset($_SESSION['user_id'])) {
            return User::findByID($_SESSION['user_id']);
        }
    }//end getUser()
}//end class