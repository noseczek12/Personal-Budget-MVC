<?php

namespace App;

/**
 * * Adding flash messages.
 */
class Flash
{
    const SUCCESS = 'success';
    const INFO = 'info';
    const WARNING = 'warning';

    /**
     * * Adds new message.
     */
    public static function addMessage($message, $type = 'success')
    {
        if (!isset($_SESSION['flash_notifications'])) {
            $_SESSION['flash_notifications'] = [];
        }
        $_SESSION['flash_notifications'][] = [
            'body' => $message,
            'type' => $type
        ];
    }//end addMessage()

    /**
     * * Gets message content.
     */
    public static function getMessages()
    {
        if (isset($_SESSION['flash_notifications'])) {
            $messages = $_SESSION['flash_notifications'];
            unset($_SESSION['flash_notifications']);

            return $messages;
        }
    }//end getMessages()
}//end class