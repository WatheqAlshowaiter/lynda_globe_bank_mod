<?php require_once('../../../private/initialize.php'); ?>
<?php

// $id =  isset($_GET['id']) ? $_GET['id']: '1'; // before php 7.0
$id = $_GET['id'] ?? '1'; // like previous one but for > PHP 7.0  

$subject = fnd_subject_by_id($id);


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
            <li><span>  الظهور</span> <?php echo $subject['visible'] == '1' ? 'true' : 'false'; ?></li> 
        </ul>
        </div>

    </div>

</div>




<?php include(SHARED_PATH . '/staff_footer.php');  ?>