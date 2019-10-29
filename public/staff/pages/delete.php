<?php
require_once('../../../private/initialize.php');
?>

<?php
// first step to check get request or redirect 
if (!isset($_GET['id'])) {
    redirect_to(url_for('staff/pages/index.php'));
}

//initial values  
$id = $_GET['id'];

// if there a post requset (submitting the form)
if (is_post_request()) {
    $result = delete_page($id);
    $_SESSION['message'] = 'حذفت الصفحة بنجاح';
    redirect_to(url_for("staff/pages/index.php"));
} else {
    $page = find_page_by_id($id);
}


?>

<?php $page_title = "احذف الصفحة"; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content" class="container">
    <div class="row">
        <div class="col-8">
            <a class="" href="<?= url_for('/staff/pages/index.php'); ?>">&laquo; العودة للقائمة </a>

            <h2>احذف العنوان: "<?= $page["menu_name"] ?>" </h2>
            <form action="" method="post">
                <div class="form-group ">
                    <label for="menu_name">هل أنت متأكد من حذف العنوان: "<?= h($page["menu_name"]); ?>"؟</label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-danger">احذف الصفحة</button>
                </div>
            </form>
        </div>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>