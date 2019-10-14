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

function fnd_subject_by_id($id)
{
    global $db;

    $sql  = "SELECT * FROM subjects ";
    $sql .= "WHERE id = '" . $id . "'"; // containing 'id' with single quotes is for seacurity 
    $result = $db->query($sql);
    confirm_result_set($result);
    $result->execute();
    $subject = $result->fetch(PDO::FETCH_ASSOC);
    $result->closeCursor();  // closing cursers or freeing results is in the result set not array you will return 

    return $subject; // returns assoc array not a result set  
}
