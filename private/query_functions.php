<?php

/******************************************************
 * General Function 
 ******************************************************/

/**
 * function returns the number of rows (count) of certain table
 *
 * @param string $table_name
 * @return int
 */
function count_table($table_name)
{
    global $db;

    $sql = "SELECT COUNT( id ) as 'count' from " . $table_name . " ";
    $result = $db->query($sql);
    confirm_result_set($result);
    $table_count = $result->fetchColumn();
    $result->closeCursor();
    return $table_count;
}

/******************************************************
 * Subject Functions
 ******************************************************/

/**
 * get all subject in db
 *
 * @return array
 */
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

    // here we are validating because it will be all the time 
    // and before sql stamtement
    $errors = validate_subject($subject);
    if ($errors) {
        return $errors;
    }

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

    // here we are validating because it will be all the time 
    // and before sql stamtement
    $errors = validate_subject($subject);
    if ($errors) {
        return $errors;
    }

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

/******************************************************
 * Page Functions
 ******************************************************/
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
/**
 * returns all page rows based on id
 *
 * @param int $id
 * @return array $page
 */
function find_page_by_id($id)
{
    global $db;

    $sql  = "SELECT * FROM pages ";
    $sql .= "WHERE id = '" . $id . "'";

    $result = $db->query($sql);
    confirm_result_set($result);
    $result->execute();

    $page = $result->fetch(PDO::FETCH_ASSOC);
    $result->closeCursor();
    return $page;
}

/**
 * to insert a page
 *
 * @param array $page
 * @return bool
 */
function insert_page($page)
{
    global $db;

    // ensure there is on errors 
    $errors = validate_page($page);
    if ($errors) {
        return $errors;
    }

    $sql   =  "INSERT INTO pages ";
    $sql  .= " (subject_id, menu_name, position, visible, content) Values ( ";
    $sql  .= "'" . $page['subject_id'] . "', ";
    $sql  .= "'" . $page['menu_name'] . "', ";
    $sql  .= "'" . $page['position'] . "', ";
    $sql  .= "'" . $page['visible'] . "', ";
    $sql  .= "'" . $page['content'] . "' ";
    $sql  .= ")";

    $result = $db->query($sql);
    if ($result) {
        return true;
    } else {
        echo "custom insert error: " . $db->error();
        db_disconnect($db);
        exit;
    }
}

/**
 * upadate page
 *
 * @param array $page
 * @return bool
 */
function update_page($page)
{
    global $db;

    $errors = validate_page($page);
    if ($errors) {
        return $errors;
    }

    $sql = "UPDATE pages SET ";
    $sql .= "subject_id= '" . $page['subject_id'] . "', ";
    $sql .= "menu_name = '" . $page['menu_name'] . "', ";
    $sql .= "position = '" . $page['position'] . "', ";
    $sql .= "visible = '" . $page['visible'] . "', ";
    $sql .= "content = '" . $page['content'] . "' ";
    $sql .= "WHERE id = '" . $page['id'] . "' ";
    $sql .= "LIMIT 1";
    // echo $sql; exit; 
    $result = $db->query($sql);

    if ($result) {
        return true;
    } else {
        echo "custom update error: " . $db->error();
        db_disconnect($db);
        exit;
    }
}

/**
 * delet page
 *
 * @param int $id
 * @return bool
 */
function delete_page($id)
{
    global $db;

    $sql  = "DELETE FROM pages ";
    $sql .= "WHERE id = '" . $id . "'";
    $sql .= "LIMIT 1";

    $result = $db->query($sql);

    if ($result) {
        return true;
    } else {
        echo "custom delete error: " . $db->error();
        db_disconnect($db);
        exit;
    }
}


/******************************************************
 * Validation Functions
 ******************************************************/


function validate_subject($subject)
{

    $errors = [];
    // we need to validate every form input 

    // menu name (not blank, geater than 2 and smaller than 255 )
    if (!has_presence($subject['menu_name'])) {
        $errors[] = "يجب ألا يكون اسم العنوان فارغا";
    } elseif (!has_length($subject['menu_name'], ["min" => 2, "max" => 255])) {
        $errors[] = "يجب أن يكون طول النص أكبر من حرفين وأقل من ٢٥٥ حرفا";
    }

    // position (greater than 0, less or equal than 999)

    $position_int = (int) $subject['position']; // to insure it is an integer
    if ($position_int < 1) {
        $errors[] = "لا يمكن أن يكون موقع العدد أقل من الرقم ١";
    } elseif ($position_int > 999) {
        $errors[] = "لا يمكن أن يكون موقع العدد أكبر من الرقم ٩٩٩";
    }

    // visible ( contains only "1" or "0" )
    $visible_str = (string) $subject['visible']; // cast to string 
    if (!has_inclusion_of($visible_str, ["1", "0"])) {
        $errors[] = "يجب أن تكون قيمة الظهور نعم أو لا فقط";
    }

    return $errors;
}

function validate_page($page)
{
    $errors  = [];

    //subject id ( not null )
    if (!has_presence($page['subject_id'])) {
        $errors[] = "يجب أن توجد قيمة للعنوان المرتبط بهذه الصفحة";
    }

    // menu name ( not blank, min >=2, max <= 255 ) And unique
    if (!has_presence($page['menu_name'])) {
        $errors[] = "يجب إلا يكون  عنوان الصفحة فارغا";
    } elseif (!has_length($page["menu_name"], ["min" => 2, "max" => 255])) {
        $errors[] = "يجب أن يكون طول النص أكبر من حرفين وأقل من ٢٥٥ حرفا";
    }
    
    // there some troubles on checking uniqeness 
    // maybe I will solve it later 
    
    // $current_id  = (int)$page['id'] ?? '0';
    // if (!has_unique_page_menu_name($page['menu_name'], $current_id)) {
    //     $errors[] = "يجب أن يكون اسم العنونا فريدا غير مكررا";
    // }

    // position 
    $position_int = (int) $page['position'];
    if ($position_int < 1) {
        $errors[] = "لا يمكن أن يكون موقع العدد أقل من الرقم ١";
    } elseif ($position_int > 999) {
        $errors[] = "لا يمكن أن يكون موقع العدد أكبر من الرقم ٩٩٩";
    }
    // visible 
    $visible_str = (string) $page["visible"];
    if (!has_inclusion_of($visible_str, ["0", "1"])) {
        $errors[] = "يجب أن تكون قيمة الظهور نعم أو لا فقط";
    }
    // content 
    if (!has_presence($page['content'])) {
        $errors[] = "المحتوى يجب ألا يكون فارغا";
    }

    return $errors;
}
