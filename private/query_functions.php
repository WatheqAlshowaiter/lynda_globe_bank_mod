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
function find_all_subjects($option = [])
{
    global $db;

    $visible = $option['visible'] ?? false;

    $sql  = "SELECT * from subjects "; // importam to make a SPACE
    if ($visible) {
        $sql .= "WHERE visible = true ";
    }
    $sql .= "ORDER BY position ASC";

    // echo $sql; // just for troublehooting 
    $result =  $db->query($sql);
    confirm_result_set($result); // make sure sql command is correct
    $result->execute();
    return $result;
}


function find_subject_by_id($id, $option = [])
{
    global $db;

    $visible = $option['visible'] ?? false;

    $sql  = "SELECT * FROM subjects ";
    $sql .= "WHERE id = " . $db->quote($id) . " "; // containing 'id' with single quotes is for seacurity 
    if ($visible) {
        $sql .= "AND visible = true ";
    }
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
    $sql  .= "" . $db->quote($subject['menu_name']) . ", ";
    $sql  .= "" . $db->quote($subject['position']) . ", ";
    $sql  .= "" . $db->quote($subject['visible']) . " ";
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
    $sql .= "menu_name = " . $db->quote($subject['menu_name']) . ", ";
    $sql .= "position = " . $db->quote($subject['position']) . ", ";
    $sql .= "visible = " . $db->quote($subject['visible']) . " ";
    $sql .= "WHERE id = " . $db->quote($subject['id']) . " ";
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
    $sql .= "WHERE id = " . $db->quote($id) . "";
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
function find_page_by_id($id, $option = [])
{
    global $db;

    $visible = $option['visible'] ?? false;

    $sql  = "SELECT * FROM pages ";
    $sql .= "WHERE id = " . $db->quote($id) . " ";
    if ($visible) {
        $sql .= "AND visible = true";
    }

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
    $sql  .= "" . $db->quote($page['subject_id']) . ", ";
    $sql  .= "" . $db->quote($page['menu_name']) . ", ";
    $sql  .= "" . $db->quote($page['position']) . ", ";
    $sql  .= "" . $db->quote($page['visible']) . ", ";
    $sql  .= "" . $db->quote($page['content']) . " ";
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
    $sql .= "subject_id= " . $db->quote($page['subject_id']) . ", ";
    $sql .= "menu_name = " . $db->quote($page['menu_name']) . ", ";
    $sql .= "position = " . $db->quote($page['position']) . ", ";
    $sql .= "visible = " . $db->quote($page['visible']) . ", ";
    $sql .= "content = " . $db->quote($page['content']) . " ";
    $sql .= "WHERE id = " . $db->quote($page['id']) . " ";
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
    $sql .= "WHERE id = " . $db->quote($id) . "";
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

/**
 * get the pages that associate with each subject
 *
 * @param int $subject_id
 * @return result set
 */
function find_pages_by_subject_id($subject_id, $option = [])
{
    global $db;

    $visible = $option['visible'] ?? false;

    $sql  = "SELECT * FROM pages ";
    $sql .= "WHERE subject_id =" . $db->quote($subject_id) . " ";
    if ($visible) {
        $sql .= "AND visible = true ";
    }
    $sql .= "ORDER BY position ASC";

    $result = $db->query($sql);
    confirm_result_set($result);
    $result->execute();
    return $result; // result set
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
        $errors[] = "يجب أن يكون طول النص أكبر من حرف واحد وأقل من ٢٥٥ حرفا";
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

    $current_id  = (int) $page['id'] ?? '0';
    if (!has_unique_page_menu_name($page['menu_name'], $current_id)) {
        $errors[] = "يجب أن يكون اسم العنونا فريدا غير مكررا";
    }

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

/******************************************************
 * Admin Functions
 ******************************************************/

function find_all_admins()
{
    global $db;

    $sql  = "SELECT * from admins ";
    $sql .= "ORDER by last_name ASC, first_name ASC";
    $result = $db->query($sql);
    confirm_result_set($result);
    return $result;
}


function find_admin_by_id($id)
{
    global $db;

    $sql  = "SELECT * FROM admins ";
    $sql .= "WHERE id = " . $db->quote($id) . " ";
    $sql .= "LIMIT 1";

    $result = $db->query($sql);
    confirm_result_set($result);
    $result->execute();
    $admin = $result->fetch(PDO::FETCH_ASSOC);
    $result->closeCursor();
    return $admin;
}

function find_admin_by_username($username)
{
    global $db;

    $sql  = "SELECT * FROM admins ";
    $sql .= "WHERE username = " . $db->quote($username) . " ";
    $sql .= "LIMIT 1";

    $result = $db->query($sql);
    confirm_result_set($result);
    $result->execute();
    $admin = $result->fetch(PDO::FETCH_ASSOC);
    // die( print_r($admin)); 
    $result->closeCursor();
    return $admin;
}


function insert_admin($admin)
{
    global $db;

    $errors = validate_admin($admin);
    if (!empty($errors)) {
        return $errors;
    }


    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT); // we can use PASSWORD_DEFAULT

    $sql = "INSERT INTO admins ";
    $sql .= "(first_name, last_name, email, username, hashed_password) ";
    $sql .= "VALUES (";
    $sql .= "" . $db->quote($admin['first_name']) . ",";
    $sql .= "" . $db->quote($admin['last_name']) . ",";
    $sql .= "" . $db->quote($admin['email']) . ", ";
    $sql .= "" . $db->quote($admin['username']) . ", ";
    $sql .= "" . $db->quote($hashed_password) . " ";
    $sql .= ")";

    $result = $db->query($sql);
    $result->execute();
    // For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo "custom error: " . $db->error();
        db_disconnect($db);
        exit;
    }
}

function validate_admin($admin, $option = [])
{

    $password_required = $option['password_required'] ?? true;
    $errors = [];

    // first name (not blank betwen 2 - 255 chars)
    if (is_blank($admin['first_name'])) {
        $errors[] = "First name cannot be blank";
    } elseif (!has_length($admin['first_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "First name must be between 2 and 255 characters.";
    }

    // last name (not blank betwen 2 - 255 chars)
    if (is_blank($admin['last_name'])) {
        $errors[] = "Last name cannot be blank";
    } elseif (!has_length($admin['last_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Last name must be between 2 and 255 characters.";
    }
    // email (not blank, not greater than 255 chars, valid_email)
    if (is_blank($admin['email'])) {
        $errors[] = "Email cannot be blank";
    } else if (!has_length($admin['email'], ['max' => 255])) {
        $errors[] = "Email must be less than 255 characters";
    } elseif (!has_valid_email_format($admin['email'])) {
        $errors[] = "Email must be in a valid format";
    }

    // username (not blank, <=8 and <=255, unique)
    if (is_blank($admin['username'])) {
        $errors[] = "Username cannot be blank";
    } elseif (!has_length($admin['username'], ['min' => 8, 'max' => 255])) {
        $errors[] = "Username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($admin['username'], $admin['id'] ?? 0)) {
        $errors[] = "Username not allowed. Try another.";
    }

    if ($password_required) {
        // password (not blank, (12<=pass), at least one UPPERCASR, one lowercase, one number)
        if (is_blank($admin['password'])) {
            $errors[] = "Password cannot be blank";
        } elseif (!has_length($admin['password'], ['min' => 12])) {
            $errors[] = "Password must contain 12 or more characters";
        } elseif (!preg_match('/[A-Z]/', $admin['password'])) {
            $errors[] = "Password must contain at least 1 UPPERCASE letter";
        } else if (!preg_match('/[a-z]/', $admin['password'])) {
            $errors[] = "Password must contain at least 1 lowercase letter";
        } else if (!preg_match('/[0-9]/', $admin['password'])) {
            $errors[] = "Password must contain at least 1 number";
        } elseif (!preg_match('/[^A-Za-z0-9\s]/', $admin['password'])) {
            $errors[] = "Password must contain at least 1 symbol";
        }


        // confirm password (not blank, match password)
        if (is_blank($admin['confirm_password'])) {
            $errors[] = "Confirm password cannot be blank.";
        } elseif ($admin['password'] !== $admin['confirm_password']) {
            $errors[] = "Password and confirm password must match.";
        }
    }


    return $errors;
}


function update_admin($admin)
{
    global $db;

    $password_sent = !is_blank($admin['password']);

    $errors = validate_admin($admin, ['password_required' => $password_sent]);
    if (!empty($errors)) {
        return $errors;
    }

    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT); // we can use PASSWORD_DEFAULT

    $sql = "UPDATE admins SET ";
    $sql .= "first_name=" . $db->quote($admin['first_name'])  . ", ";
    $sql .= "last_name=" . $db->quote($admin['last_name'])  . ", ";
    $sql .= "email=" . $db->quote($admin['email'])  . ", ";
    if ($password_sent) {
        $sql .= "hashed_password=" . $db->quote($hashed_password) . ", ";
    }
    $sql .= "username=" . $db->quote($admin['username']) . " ";
    $sql .= "WHERE id=" . $db->quote($admin['id'])  . " ";
    $sql .= "LIMIT 1";
    $result = $db->query($sql);
    $result->execute();

    // For UPDATE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo "custom error: " . $db->error();
        db_disconnect($db);
        exit;
    }
}

function delete_admin($admin)
{
    global $db;

    $sql = "DELETE FROM admins ";
    $sql .= "WHERE id=" . $db->quote($admin['id']) . " ";
    $sql .= "LIMIT 1;";
    $result = $db->query($sql);
    $result->execute();

    // For DELETE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // DELETE failed
        echo "custom error: " . $db->error();
        db_disconnect($db);
        exit;
    }
}
