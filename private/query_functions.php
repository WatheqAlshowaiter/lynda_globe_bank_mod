<?php

function find_all_subjects()
{
    global $db;

    $sql  = "SELECT * from subjects "; // importam to make a SPACE
    $sql .= "ORDER BY position ASC";

    // echo $sql; // just for troublehooting 
    $result =  $db->query($sql);
    confirm_result_set($result); // make sure sql command is correct
    $result->execute();
    return $result;
}
/**
 * return all pages from pages database table 
 *
 * @return mixed $result
 * 
 */
function find_all_pages()
{
    global $db;

    $sql  = "SELECT * from pages "; // importam to make a SPACE
    $sql .= "ORDER BY  subject_id, position ASC";

    // echo $sql; // just for troublehooting 
    $result =  $db->query($sql);
    confirm_result_set($result); // make sure sql command is correct
    $result->execute();
    return $result;
}
