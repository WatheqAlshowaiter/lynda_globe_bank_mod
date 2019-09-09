<?php require_once('../../../private/initialize.php'); ?>
<!-- you shluod make this only with dots(../../) -->

<?php
// like DB for develping 

$subjects = [
    ['id' => '1', 'position' => '1', 'visible' => '1', 'menu_name' => 'عن البنك الدولي'],
    ['id' => '2', 'position' => '2', 'visible' => '1', 'menu_name' => 'الزبون'],
    ['id' => '3', 'position' => '3', 'visible' => '1', 'menu_name' => 'المتاجر الصغيرة'],
    ['id' => '4', 'position' => '4', 'visible' => '0', 'menu_name' => 'التجاري'],
];
?>

<!-- page title -->
<?php $page_title = "قائمة العناوين"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<div id="content" class="container">
    <div>
        <h1>العناوين</h1>
        <a href="" class="">إنشئ عنوانا جديدا</a>
    </div>
    <div class="table-responsive-sm"> <!-- I will test it to know it's make table responsive or not -->
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
            <?php foreach ($subjects as $subject) : ?>
                <tbody>
                    <tr>
                        <td><?= $subject['id']; ?></td>
                        <td><?= $subject['position']; ?></td>
                        <td><?= $subject['visible'] == 1 ? 'نعم' : 'لا'; ?></td>
                        <td><?= $subject['menu_name']; ?></td>
                        <td><a href="<?= 'show.php?id=' . $subject['id'] ?>">عرض</a></td>
                        <td><a href="">تعديل</a></td>
                        <td><a href="">حذف</a></td>
                    </tr>
                </tbody>
            <? endforeach; ?>
        </table>
    </div>
</div>

<!-- staff footer -->
<?php include(SHARED_PATH . '/staff_footer.php'); ?>