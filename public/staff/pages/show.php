<?php require_once('../../../private/initialize.php'); ?>
<?php require_login(); ?>

<?php
if (!isset($_GET['id'])) {
    redirect_to(url_for("staff/pages/index.php"));
}
?>

<?php

// $id =  isset($_GET['id']) ? $_GET['id']: '1'; // before php 7.0
$id = $_GET['id'] ?? '1'; // like previous one but for > PHP 7.0  
$page  = find_page_by_id($id);

?>
<?php $page_title = "عرض الصفحة"; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content" class="container page-show">
    <div>
        <a class="" href="<?= url_for('/staff/subjects/show.php?id=' . h(u($page['subject_id']))); ?>">&laquo; العودة للقائمة </a>
        <h1>الصفحة: <?= h($page['menu_name']) ?></h1>
        <a href="<?= url_for('/index.php?id=' . h(u($page["id"])) . "&preview=true"); ?>" target="_blank"> إظهار على الصفحة الرئيسية &raquo;</a>

        <div class="page-attributes">
            <?php $subject = find_subject_by_id($page['subject_id']); ?>
            <ul class="">
                <li><span> العنوان</span> <?php echo h($subject['menu_name']); ?></li>
                <li><span> اسم الصفحة</span> <?php echo h($page['menu_name']); ?></li>
                <li><span> الموقع</span> <?php echo h($page['position']); ?></li>
                <li><span> الظهور</span> <?php echo $page['visible'] == '1' ? 'نعم' : 'لا'; ?></li>
                <li><span> المحتوى</span> <?php echo h($page['content']); ?></li>
            </ul>
        </div>

    </div>

</div>



<?php include(SHARED_PATH . '/staff_footer.php');  ?>