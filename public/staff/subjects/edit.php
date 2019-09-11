<?php
require_once('../../../private/initialize.php');

$test = $_GET['test'] ?? '';

if ($test == '404') {
    error_404();
} elseif ($test == '500') {
    error_500();
} elseif ($test == 'redirect') {
    redirect_to(url_for('staff/subjects/index.php'));
}
?>

<?php $page_title = "عدل العنوان"; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content" class="container">
    <div class="row">
        <div class="col-8">
        <a class="" href="<?= url_for('/staff/subjects/index.php'); ?>">&laquo; العودة للقائمة </a>

            <h2>عدل العنوان</h2>
            <form action="" method="post">
                <div class="form-group ">
                    <label for="menu_name">اسم العنوان</label>
                    <input type="text" class="form-control" id="menu_name" autofocus>
                </div>
                <div class="form-group ">
                    <label for="position">الموقع</label> &nbsp;
                    <select name="position" id="position" class="custom-select col-2">
                        <option value="1">1</option>
                    </select>
                </div>
                <div class="form-check ">
                    <label for="visible" class="form-check-label">الظهور</label>
                    <input type="hidden" class="" name="visible" value="0"> &nbsp;
                    <input type="checkbox" class="form-check-input position-static" name="visible" value="1" id="visible">
                </div>

                <div class="form-group"> <br>
                    <button type="submit" class="btn btn-primary">عدل العنوان</button>
                </div>
            </form>


        </div>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>