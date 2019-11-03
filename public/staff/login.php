<?php
require_once('../../private/initialize.php');

$errors = [];
$username = '';
$password = '';


// demo username and password
// cconsanoncann
// 12345678912aB!

if (is_post_request()) {

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // verifications 
    if (is_blank($username)) {
        $errors[]  = "لا يمكن أن تكون خانة الاسم فارغة";
    }
    if (is_blank($password)) {
        $errors[]  = "لا يمكن أن تكون خانة كلمة المرور فارغة";
    }
    // one message to hide wich input is missing (password or username)
    // to make harder to be hacked 
    $msg_for_error_login = "فشل تسجيل الدخول. حاول مرة أخرى";
    if (empty($errors)) {
        $admin = find_admin_by_username($username);
        if ($admin) {
            if (password_verify($password, $admin['hashed_password'])) {
                // password match 
                log_in_admin($admin);
                redirect_to(url_for('/staff/index.php'));
            } else {
                // username found but passwrod doesn't match 
                $errors[] = $msg_for_error_login;
            }
        } else {
            // no usernme found. 
            $errors[]  =  $msg_for_error_login;
        }
    }
}

?>

<?php $page_title = 'تسجيل الدخول'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="row">
    <div class=" col-sm-6 m-5 py-5">
        <h1>تسجيل الدخول </h1>

        <?php echo display_errors($errors); ?>

        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">اسم المستخدم</label>
                <input class="form-control col-6" id="username" type="text" name="username" value="<?php echo h($username); ?>" autofocus />
            </div>
            <div class="form-group">
                <label for="password">كلمة المرور</label>
                <input class="form-control col-6" type="password" id="password" name="password" value="" /><br />
            </div>

            <input class="form-control col-2 btn btn-info" type="submit" name="submit" value="الدخول" />
        </form>
    </div>


</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>