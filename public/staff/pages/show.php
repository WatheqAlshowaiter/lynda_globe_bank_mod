<?php require_once('../../../private/initialize.php'); ?>
<?php

// $id =  isset($_GET['id']) ? $_GET['id']: '1'; // before php 7.0
$id = $_GET['id'] ?? '1'; // like previous one but for > PHP 7.0  
?>
<?php $page_title = "عرض الصفحة"; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content" class="container">
    <div>
        <a class="" href="<?= url_for('/staff/pages/index.php'); ?>">&laquo; العودة للقائمة </a>
        <h3>معرف الصفحة: <?= h($id) ?></h3>

    </div>

</div>




<?php include(SHARED_PATH . '/staff_footer.php');  ?>