<?php

namespace App;

// Application configuration
 
class Config
{

    // nazwa hosta bazy danych
    const DB_HOST = 'localhost';
	//nazwa bazy danych
    const DB_NAME = 'tomaszno_budzet_osobisty';
	//nazwa użytkownika bazy danych
    const DB_USER = 'tomaszno_budzet_osobisty_admin';
	//hasło bazy danych
    const DB_PASSWORD = 'budzetosob1sty!';
	// pokazywanie lub ukrywanie wiadomości o błędach
	const SHOW_ERRORS = true;
	//tajny klucz do hashowania
	const SECRET_KEY = 'Sl49kwPkTzC38R9EdMZqfUDKtxjl5HO7';
}
