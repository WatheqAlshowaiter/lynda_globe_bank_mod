<?php

ob_start(); // turn on output buffering

session_start();

// THIS IS FILE PATH (WITH INCLUDES)
// dirname() return the father folder
// __FILE__ returns the currnent file path 

define("PRIVATE_PATH", dirname(__FILE__));
define("SHARED_PATH", PRIVATE_PATH . '/shared');
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . "/public");

// THIS IS BROWSER PATH (WITH ECHOS AND LINKS 
//  TO CLICK AND STYLSHEETS/JS)

// Assign the root URL to a PHP constant
// * Do not need to include the domain
// * Use same document root as webserver
// * Can set a hardcoded value:
// define("WWW_ROOT", '/~kevinskoglund/globe_bank/public');
// define("WWW_ROOT", '');
// * Can dynamically find everything in URL up to "/public"

$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);


require_once('functions.php');
require_once('database.php');
require_once('query_functions.php');
require_once('validation_functions.php');
require_once('auth_functions.php');



// DATABASE CONNECT HERE 
$db = db_connect();
$errors = []; // to be always available
