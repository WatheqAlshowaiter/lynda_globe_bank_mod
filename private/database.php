<?php require_once('db_credintials.php'); ?>

<?php

function db_connect()
{
    try {
        // couldn't make them CONSTANTS instead of $variables (maybe this time works fine)
        $con = new PDO(DSN, DB_USER, DB_PASS);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    } catch (Exception $ex) {
        exit("فشل الاتصال بقاعدة البيانات " . $ex->getMessage());
    }
    return $con;
}

function db_disconnect($connection)
{
    if (isset($connection)) {
        $connection = null;
    }
}

// THERE IS NO NEED FOR CONFIRM_DB_CONNECT() fucnition 
// because we have try and catch in db_connect() 

/**
* this function handle it when result set query failed
*	
* @param  mixed $result_set
* @return void
*/
function confirm_result_set($result_set)
{
    if (!$result_set) {
        exit("<p style='color:red'> !فشل أمر الاسترجاع من قاعدة البيانات. تحقق من أمر الاسترجاع الذي كتبته</p>");
    }
}
?> 
