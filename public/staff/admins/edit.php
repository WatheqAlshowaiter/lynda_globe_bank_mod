<?php
require_once('../../../private/initialize.php');
?>

<?php
// first step to check get request or redirect 
if (!isset($_GET['id'])) {
    redirect_to(url_for('staff/pages/index.php'));
}

//id from get request
$id = $_GET['id'];

if (is_post_request()) {
    $admin = [];
    $admin['id'] = $id;
    $admin['first_name'] = $_POST['first_name'] ?? '';
    $admin['last_name'] = $_POST['last_name'] ?? '';
    $admin['email'] = $_POST['email'] ?? '';
    $admin['username'] = $_POST['username'] ?? '';
    $admin['password'] = $_POST['password'] ?? '';
    $admin['confirm_password'] = $_POST['confirm_password'] ?? '';

    $result  = update_admin($admin);
    if ($result === true) {
        $_SESSION['message'] = 'عدل حساب المدير';
        redirect_to(url_for('/staff/admins/show.php?id=' . $id));
    } else {
        $errors = $result;
    }
} else {
    $admin = find_admin_by_id($id);
}

?>

<?php $page_title = "عدل حساب المدير"; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content" class="container new-admin">
    <div class="row">
        <div class="col-md-6">
            <a class="" href="<?= url_for('/staff/admins/index.php'); ?>">&laquo; العودة للقائمة </a>

            <h2>عدّل حساب المدير </h2>
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
                    <button type="submit" class="btn btn-info"> عدل هذا الحساب</button>
                    <br> <br>
                </div>
                <br> <br>
            </form>


        </div>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>