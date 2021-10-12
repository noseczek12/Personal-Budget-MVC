<?php

namespace App;

// Application configuration
 
class Config
{

    // nazwa hosta bazy danych
    const DB_HOST = 'localhost';
	//nazwa bazy danych
    const DB_NAME = 'mvclogin';
	//nazwa użytkownika bazy danych
    const DB_USER = 'mvcuser';
	//hasło bazy danych
    const DB_PASSWORD = 'secret';
	// pokazywanie lub ukrywanie wiadomości o błędach
	const SHOW_ERRORS = true;
	//tajny klucz do hashowania
	const SECRET_KEY = 'Sl49kwPkTzC38R9EdMZqfUDKtxjl5HO7';
}
