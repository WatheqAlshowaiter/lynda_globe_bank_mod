<?php

// make a constants for links and includes 

// dirname() return the father folder
// __FILE__ returns the currnent file path 

define("PRIVATE_PATH", dirname(__FILE__));
define("SHARED_PATH", PRIVATE_PATH . '/shared');
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . "/public");


require_once('functions.php');
