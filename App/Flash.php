<?php

namespace App;

//wiadomości flash

class Flash
{
	 //dodawanie wadomości
	 public static function addMessage($message)
	 {
		 //utworzenie tablicy w sesji, jeśli nie istnieje
			if(! isset($_SESSION['flash_notifications'])) {
					$_SESSION['flash_notifications'] = [];
			}
			
			//dodaj wiadomość do tablicy
			$_SESSION['flash_notifications'][] = $message;
	 }
}