<?php require_once('../../../private/initialize.php'); ?>
<!-- you shluod make this only with dots(../../) -->
<?php
$subject_set = find_all_subjects();

?>


<!-- page title -->
<?php $page_title = "قائمة العناوين"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<div id="content" class="container">
    <div>
        <h1>العناوين</h1>
        <a href="<?= url_for('staff/subjects/new.php') ?>" class="">إنشئ عنوانا جديدا</a>
    </div>
    <div class="table-responsive-sm">
        <!-- I will test it to know it's make table responsive or not -->
        <table class="table table-bordered table-hover">
            <caption> جدول العناوين</caption>
            <thead>
                <tr class="table-primary">
                    <th>المعرّف</th>
                    <th>الموقع</th>
                    <th>الظهور</th>
                    <th>الاسم</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <?php while($subject = $subject_set->fetch(PDO::FETCH_ASSOC)):  ?> 
                <tbody>
                    <tr>
                        <td><?= h($subject['id']); ?></td>
                        <td><?= h($subject['position']); ?></td>
                        <td><?= $subject['visible'] == 1 ? 'نعم' : 'لا'; ?></td> <!-- because we've full control on this (true, false) so there is no need to h()-->
                        <td><?= h($subject['menu_name']); ?></td>
                        <td><a href="<?= url_for('staff/subjects/show.php?id=' . h(u($subject['id']))); ?>">عرض</a></td> <!-- make sure is urlemcode and it is html safe-->
                        <td><a href="<?= url_for('staff/subjects/edit.php?id=' . h(u($subject['id']))); ?>">تعديل</a></td>
                        <td><a href="<?= url_for("staff/subjects/delete.php?id=". h(u($subject["id"])))?>">حذف</a></td>
                    </tr>
                </tbody>
            <? endwhile; ?>
        </table>
        <?php $subject_set->closeCursor();?> 
    </div>
</div>

<!-- staff footer -->
<?php include(SHARED_PATH . '/staff_footer.php'); ?>