<?php require_once('db_credintials.php'); ?>

<?php

function db_connect()
{
    try {
        // couldn't make them CONSTANTS instead of $variables (maybe this time works fine)
        $con = new PDO(DSN, DB_USER, DB_PASS);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    } catch (Exception $ex) {
        echo "Connection Failed " . $ex->getMessage();
    }
    return $con;
}

function db_disconnect($connection)
{
    if (isset($connection)) {
        $connection = null;
    }
}

?> 
