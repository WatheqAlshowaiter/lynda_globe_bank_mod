<?php
require_once('../../../private/initialize.php');
?>

<?php
// first step to check get request or redirect 
if (!isset($_GET['id'])) {
    redirect_to(url_for('staff/subjects/index.php'));
}

//initial values  
$id = $_GET['id'];
$menu_name = '';
$position = '';
$visible = '';

// if there a post requset (submitting the form)
if (is_post_request()) {
    $menu_name = $_POST['menu_name'] ?? '';
    $position = $_POST['position'] ?? '';
    $visible = $_POST['visible'] ?? '';

    echo "Form parameters<br />";
    echo "Menu name: " . $menu_name . "<br />";
    echo "Position: " . $position . "<br />";
    echo "Visible: " . $visible . "<br />";
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
                    <input type="text" class="form-control" name="menu_name" id="menu_name" autofocus value="<?= $menu_name ?>">
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