<?php
require_once('../../../private/initialize.php');
?>
<?php require_login(); ?>


<?php
if (is_post_request()) {
    $admin = [];
    $admin['first_name'] = $_POST['first_name'] ?? '';
    $admin['last_name'] = $_POST['last_name'] ?? '';
    $admin['email'] = $_POST['email'] ?? '';
    $admin['username'] = $_POST['username'] ?? '';
    $admin['password'] = $_POST['password'] ?? '';
    $admin['confirm_password'] = $_POST['confirm_password'] ?? '';

    $result = insert_admin($admin);
    if ($result === true) {
        $new_id = $db->lastInsertId(); // Returns the ID of the last inserted row (Native function)
        $_SESSION['message'] = 'أنشئ حساب المدير بنجاح';
        redirect_to(url_for("/staff/admins/show.php?id=" . $new_id));
    } else {
        $errors = $result;
    }
} else { // if no creation new subject yet
    // display the blank form
    $admin = [];
    $admin["first_name"] = '';
    $admin["last_name"] = '';
    $admin["email"] = '';
    $admin["username"] = '';
    $admin['password'] = '';
    $admin['confirm_password'] = '';
}




?>

<?php $page_title = "إنشاء حساب مدير"; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content" class="container new-admin">
    <div class="row">
        <div class="col-md-6 m-50">
            <a class="" href="<?= url_for('/staff/admins/index.php'); ?>">&laquo; العودة للقائمة </a>

            <h2>إنشئ حساب مدير جديد</h2>
            <?php echo display_errors($errors); ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="first_name">الاسم الأول</label>
                    <input type="text" class="form-control" name="first_name" id="first_name" autofocus value="<?= ($admin['first_name']); ?>">
                </div>
                <div class="form-group">
                    <label for="last_name">الاسم الثاني</label>
                    <input type="text" class="form-control" name="last_name" id="last_name" value="<?= ($admin['last_name']); ?>">
                </div>
                <div class="form-group">
                    <label for="username">اسم المستخدم</label>
                    <input type="text" class="form-control" name="username" id="username" value="<?= ($admin['username']); ?>">
                </div>
                <div class="form-group">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?= ($admin['email']); ?>">
                </div>
                <div class="form-group">
                    <label for="password">كلمة المرور</label>
                    <input type="password" class="form-control" name="password" id="password" value="">
                </div>
                <div class="form-group">
                    <label for="confirm_password">تأكيد كلمة المرور</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" value="">
                </div>


                <div class="form-group"> <br>
                    <button type="submit" class="btn btn-primary"> إنشئ اسم حساب جديد </button>
                </div>
            </form>


        </div>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>