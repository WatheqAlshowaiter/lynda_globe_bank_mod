<?php
require_once('../../../private/initialize.php');
?>
<?php require_login(); ?>


<?php
// first step to check get request or redirect 
if (!isset($_GET['id'])) {
    redirect_to(url_for('staff/admins/index.php'));
}

//initial values  
$id = $_GET['id'];

// if there a post requset (submitting the form)
if (is_post_request()) {
    $result = delete_admin($id);
    $_SESSION['message'] = 'حذف حساب المدير بنجاح';
    redirect_to(url_for("staff/admins/index.php"));
} else {
    $admin = find_admin_by_id($id);
}


?>

<?php $page_title = "احذف حساب المدير "; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content" class="container">
    <div class="row">
        <div class="col-8">
            <a class="" href="<?= url_for('/staff/admins/index.php'); ?>">&laquo; العودة للقائمة </a>

            <h2>احذف حساب المدير :"<?= $admin["username"] ?>" </h2>
            <form action="" method="post">
                <div class="form-group ">
                    <label for="menu_name">هل أنت متأكد من حذف العنوان: "<?= h($admin["username"]); ?>"؟</label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-danger">احذف حساب المدير هذا </button>
                </div>
            </form>
        </div>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>