<?php require_once('../../../private/initialize.php'); ?>
<!-- you shluod make this only with dots(../../) -->


<?php
$page_set = find_all_pages();
?>

<!-- page title -->
<?php $page_title = "قائمة الصفحات"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<div id="content" class="container">
    <div>
        <h1>الصفحات</h1>
        <a href="<?= url_for('staff/pages/new.php') ?>" class="">إنشئ صفحة جديدة</a>
    </div>
    <div class="table-responsive-sm">
        <!-- I will test it to know it's make table responsive or not -->
        <table class="table table-bordered table-hover">
            <caption>جدول الصفحات</caption>
            <thead>
                <tr class="table-primary">
                    <th>المعرّف</th>
                    <th>العنوان</th>
                    <th>الموقع</th>
                    <th>الظهور</th>
                    <th>الاسم</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <?php while ($page = $page_set->fetch(PDO::FETCH_ASSOC)) : ?>
            <?php $subject = find_subject_by_id($page['subject_id']); ?> 
                <tbody>
                    <tr>
                        <td><?= h($page['id']); ?></td>
                        <td><?= h($subject['menu_name']); ?></td>
                        <td><?= h($page['position']); ?></td>
                        <td><?= $page['visible'] == 1 ? 'نعم' : 'لا'; ?></td> <!-- because we've full control on this (true, false) so there is no need to h()-->
                        <td><?= h($page['menu_name']); ?></td>
                        <td><a href="<?= url_for('staff/pages/show.php?id=' . h(u($page['id']))); ?>">عرض</a></td> <!-- make sure is urlemcode and it is html safe-->
                        <td><a href="<?= url_for('staff/pages/edit.php?id=' . h(u($page['id']))); ?>">تعديل</a></td>
                        <td><a href="<?= url_for('staff/pages/delete.php?id=' . h(u($page['id']))); ?>">حذف</a></td>
                    </tr>
                </tbody>
            <? endwhile; ?>
        </table>
        <?php $page_set->closeCursor(); // close this statement
        ?>
    </div>
</div>

<!-- staff footer -->
<?php include(SHARED_PATH . '/staff_footer.php'); ?>