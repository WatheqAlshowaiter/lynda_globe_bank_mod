<?php
require_once('../../../private/initialize.php');
?>

<?php
// first step to check get request or redirect 
if (!isset($_GET['id'])) {
    redirect_to(url_for('staff/subjects/index.php'));
}

//initial values  
$id = $_GET['id'];

// if there a post requset (submitting the form)
if (is_post_request()) {
    $result = delete_subject($id);
    $_SESSION['message'] = 'حذف الموضوع بنجاح';
    redirect_to(url_for("staff/subjects/index.php"));
} else {
    $subject = find_subject_by_id($id);
}


?>

<?php $page_title = "احذف العنوان"; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content" class="container">
    <div class="row">
        <div class="col-8">
            <a class="" href="<?= url_for('/staff/subjects/index.php'); ?>">&laquo; العودة للقائمة </a>

            <h2>احذف العنوان: "<?= $subject["menu_name"] ?>" </h2>
            <form action="" method="post">
                <div class="form-group ">
                    <label for="menu_name">هل أنت متأكد من حذف العنوان: "<?= h($subject["menu_name"]); ?>"؟</label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-danger">احذف العنوان</button>
                </div>
            </form>
        </div>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>