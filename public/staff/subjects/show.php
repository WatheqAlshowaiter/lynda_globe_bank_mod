<?php require_once('../../../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

// $id =  isset($_GET['id']) ? $_GET['id']: '1'; // before php 7.0
$id = $_GET['id'] ?? '1'; // like previous one but for > PHP 7.0  

$subject = find_subject_by_id($id);
$page_set = find_pages_by_subject_id($id); 

?>
<?php $page_title = "عرض العنوان"; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content" class="container subject-show">
    <div>
        <a class="" href="<?= url_for('/staff/subjects/index.php'); ?>">&laquo; العودة للقائمة </a>
        <h1>العنوان: <?= h($subject['menu_name']) ?></h1>

        <div class="subject-attributes">
            <ul class="">
                <li><span> اسم العنوان</span> <?php echo h($subject['menu_name']); ?></li>
                <li><span> الموقع</span> <?php echo h($subject['position']); ?></li>
                <li><span> الظهور</span> <?php echo $subject['visible'] == '1' ? 'نعم' : 'لا'; ?></li>
            </ul>
        </div>
        <!-- PAGES SECTION -->
        <hr>
        <div id="content" class="container">
            <div>
                <h2>الصفحات</h2>
                <a href="<?= url_for('staff/pages/new.php') ?>" class="">إنشئ صفحة جديدة</a>
            </div>
            <div class="table-responsive-sm">
                <!-- I will test it to know it's make table responsive or not -->
                <table class="table table-bordered table-hover">
                    <caption>جدول الصفحات</caption>
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
                    <?php while ($page = $page_set->fetch(PDO::FETCH_ASSOC)) : ?>
                        <?php $subject = find_subject_by_id($page['subject_id']); ?>
                        <tbody>
                            <tr>
                                <td><?= h($page['id']); ?></td>
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

    </div>

</div>




<?php include(SHARED_PATH . '/staff_footer.php');  ?>