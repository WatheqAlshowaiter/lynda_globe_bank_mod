<?php require_once('../../../private/initialize.php'); ?>
<!-- you shluod make this only with dots(../../) -->

<?php
// like DB for develping 

$pages = [
    ['id' => '1', 'position' => '1', 'visible' => '1', 'menu_name' => 'عن البنك الدولي'],
    ['id' => '2', 'position' => '2', 'visible' => '1', 'menu_name' => 'التاريخ'],
    ['id' => '3', 'position' => '3', 'visible' => '0', 'menu_name' => 'القيادة'],
    ['id' => '4', 'position' => '4', 'visible' => '0', 'menu_name' => 'تواصل معنا'],
];
?>

<!-- page title -->
<?php $page_title = "قائمة الصفحات"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<div id="content" class="container">
    <div>
        <h1>الصفحات</h1>
        <a href="<?= url_for('staff/pages/new.php')?>" class="">إنشئ صفحة جديدة</a>
    </div>
    <div class="table-responsive-sm"> <!-- I will test it to know it's make table responsive or not -->
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
            <?php foreach ($pages as $page) : ?>
                <tbody>
                    <tr>
                        <td><?= h($page['id']); ?></td>
                        <td><?= h($page['position']); ?></td>
                        <td><?= $page['visible'] == 1 ? 'نعم' : 'لا'; ?></td> <!-- because we've full control on this ('true, false) so there is no need to h()--> 
                        <td><?= h($page['menu_name']); ?></td>
                        <td><a href="<?= url_for('staff/pages/show.php?id=' . h(u($page['id']))); ?>">عرض</a></td> <!-- make sure is urlemcode and it is html safe--> 
                        <td><a href="<?= url_for('staff/pages/edit.php?id=' . h(u($page['id']))); ?>">تعديل</a></td>
                        <td><a href="">حذف</a></td>
                    </tr>
                </tbody>
            <? endforeach; ?>
        </table>
    </div>
</div>

<!-- staff footer -->
<?php include(SHARED_PATH . '/staff_footer.php'); ?>