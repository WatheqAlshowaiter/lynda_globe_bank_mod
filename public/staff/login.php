<?php
require_once('../../private/initialize.php');

$errors = [];
$username = '';
$password = '';

if (is_post_request()) {

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $_SESSION['username'] = $username;

    redirect_to(url_for('/staff/index.php'));
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
                <input class="form-control col-6" id="username" type="text" name="username" value="<?php echo h($username); ?>" autofocus/>
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