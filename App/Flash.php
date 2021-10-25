<?php

namespace App;

//wiadomości flash

class Flash
{
	const SUCCESS = 'success';
	const INFO = 'info';
	const WARNING = 'warning';
	
	 //dodawanie wadomości
	 public static function addMessage($message, $type = 'success')
	 {
		 //utworzenie tablicy w sesji, jeśli nie istnieje
		if (! isset($_SESSION['flash_notifications'])) {
            $_SESSION['flash_notifications'] = [];
        }
			
			//dodaj wiadomość do tablicy
			$_SESSION['flash_notifications'][] = [
					'body' =>$message,
					'type' =>$type
			];
	 }
	 
	 //otrzymywanie wiadomości
	 public static function getMessages()
	 {
        if (isset($_SESSION['flash_notifications'])) {
            $messages = $_SESSION['flash_notifications'];
            unset($_SESSION['flash_notifications']);

            return $messages;
        }
    }
}