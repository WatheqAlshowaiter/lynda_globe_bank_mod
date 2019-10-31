<?php require_once('../../../private/initialize.php'); ?>
<!-- you shluod make this only with dots(../../) -->
<?php  require_login(); ?> 

<?php
$admin_set = find_all_admins();

?>


<!-- page title -->
<?php $page_title = "المديرون"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<div id="content" class="container">
    <div>
        <h1>المديرون</h1>
        <a href="<?= url_for('staff/admins/new.php') ?>" class="">إنشئ مديرا جديدا</a>
    </div>
    <div class="table-responsive-sm">
        <!-- I will test it to know it's make table responsive or not -->
        <table class="table table-bordered table-hover">
            <caption> جدول المديرين</caption>
            <thead>
                <tr class="table-primary">
                    <th>المعرّف</th>
                    <th>الاسم الأول</th>
                    <th>الاسم الثاني</th>
                    <th>البريد الإلكتروني</th>
                    <th>اسم المستخدم</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <?php while ($admin = $admin_set->fetch(PDO::FETCH_ASSOC)) :  ?>
                <tbody>
                    <tr>
                        <td><?php echo h($admin['id']); ?> </td>
                        <td><?php echo h($admin['first_name']); ?> </td>
                        <td><?php echo h($admin['last_name']); ?> </td>
                        <td><?php echo h($admin['email']); ?> </td>
                        <td><?php echo h($admin['username']); ?> </td>
                        <td><a href="<?= url_for('staff/admins/show.php?id=' . h(u($admin['id']))); ?>">عرض</a></td>    
                        <td><a href="<?= url_for('staff/admins/edit.php?id=' . h(u($admin['id']))); ?>">تعديل</a></td>
                        <td><a href="<?= url_for("staff/admins/delete.php?id=" . h(u($admin["id"]))) ?>">حذف</a></td>
                    </tr>
                </tbody>
            <? endwhile; ?>
        </table>
        <?php $admin_set->closeCursor(); ?>
    </div>
</div>

<!-- staff footer -->
<?php include(SHARED_PATH . '/staff_footer.php'); ?>