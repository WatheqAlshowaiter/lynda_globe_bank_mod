<?php require_once('../../private/initialize.php'); ?>
<!-- you shluod make this only with dots(../../) -->

<!-- staff header -->
<!-- page titile -->
<?php $page_title = "قائمة الموطفين"; ?> 
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<div id="content" class="container">
    <div id="main-menu">
        <h2>القائمة الرئيسية</h2>
         <ul>
            <li><a href="<?= url_for('staff/subjects/index.php');?>">العناوين</a></li>
        </ul>
    </div>
</div>

<!-- staff footer -->
<?php include(SHARED_PATH . '/staff_footer.php'); ?>