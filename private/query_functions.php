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

function find_subject_by_id($id)
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

/**
 * function to insert to subjects table the return true or echo error mesage 
 *
 * @param string $menu_name
 * @param int $position
 * @param int $visible
 * @return boolean or error message 
 */
function insert_subject($subject)
{
    global $db;

    $sql   =  "INSERT INTO subjects ";
    $sql  .= " (menu_name, position, visible) Values ( ";
    $sql  .= "'" . $subject['menu_name'] . "', ";
    $sql  .= "'" . $subject['position'] . "', ";
    $sql  .= "'" . $subject['visible'] . "' ";
    $sql  .= ")";


    $result = $db->query($sql);

    if ($result) {
        return true;
    } else {
        echo "custom error: " . $db->error();
        db_disconnect($db);
        exit;
    }
}
/**
 * updating subjects in edit.php 
 *
 * @param array $subject
 * @return bool
 */
function update_subject($subject)
{
    global $db;

    $sql = "UPDATE subjects SET ";
    $sql .= "menu_name = '" . $subject['menu_name'] . "', ";
    $sql .= "position = '" . $subject['position'] . "', ";
    $sql .= "visible = '" . $subject['visible'] . "' ";
    $sql .= "WHERE id = '" . $subject['id'] . "' ";
    $sql .= "LIMIT 1";

    $result = $db->query($sql);

    if ($result) {
        return true;
    } else {
        echo "custom error: " . $db->error();
        db_disconnect($db);
        exit;
    }
}
/**
 * function returns the number of rows (count) of certain table
 *
 * @param string $subjects
 * @return int
 */
function count_table($subjects)
{
    global $db;

    $sql = "SELECT COUNT( id ) as 'count' from " . $subjects . " ";
    $result = $db->query($sql);
    confirm_result_set($result);
    $table_count = $result->fetchColumn();
    $result->closeCursor();
    return $table_count;
}


/**
 * to delet subjects by its id      
 *
 * @param int $id
 * @return bool
 */
function delete_subject($id)
{
    global $db;

    $sql  = "DELETE FROM subjects ";
    $sql .= "WHERE id = '" . $id . "'";
    $sql .= "LIMIT 1";

    $result = $db->query($sql);

    if ($result) {
        return true;
    } else {
        echo "custom error: " . $db->error();
        db_disconnect($db);
        exit;
    }
}
