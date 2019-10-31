<?php require_once('../../../private/initialize.php'); ?>
<?php

// $id =  isset($_GET['id']) ? $_GET['id']: '1'; // before php 7.0
$id = $_GET['id'] ?? '1'; // like previous one but for > PHP 7.0  

$admin = find_admin_by_id($id);

?>
<?php $page_title = "عرض المدير"; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content" class="container admins-show">
    <div>
        <a class="" href="<?= url_for('/staff/admins/index.php'); ?>">&laquo; العودة للقائمة </a>
        <h1> المدير: <?= h($subject['menu_name']) ?></h1>
        <div class="m-3">
            <a class="action" href="<?php echo url_for('/staff/admins/edit.php?id=' . h(u($admin['id']))); ?>">تعديل</a>
            <a class="action" href="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin['id']))); ?>">حذف</a>
        </div>

        <div class="admin-attributes">
            <ul class="">
                <li><span> الاسم الأول</span> <?php echo h($admin['first_name']); ?></li>
                <li><span> الاسم الثاني </span> <?php echo h($admin['last_name']); ?></li>
                <li><span> البريد الإلكتروني </span> <?php echo h($admin['email']); ?></li>
                <li><span> اسم المستخدم </span> <?php echo h($admin['username']); ?></li>

            </ul>
        </div>

    </div>

</div>




<?php include(SHARED_PATH . '/staff_footer.php');  ?>