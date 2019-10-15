<?php
require_once('../../../private/initialize.php');
?>

<?php
// first step to check get request or redirect 
if (!isset($_GET['id'])) {
    redirect_to(url_for('staff/pages/index.php'));
}

//id from get request
$id = $_GET['id'];


// // if there a post requset (submitting the form)
// if (is_post_request()) {
//     $subject = []; // define an array then pass it as a parameter
//     $subject['id'] = $id; 
//     $subject['menu_name'] = $_POST['menu_name'] ?? '';
//     $subject['position'] = $_POST['position'] ?? '';
//     $subject['visible'] = $_POST['visible'] ?? '';

//     $result = update_subject($subject); // pass an array as a parameter 
//     redirect_to(url_for('/staff/subjects/show.php?id=' . $id));  
// }else {
//     $subject = find_subject_by_id($id); 
// }


?>

<?php $page_title = "عدل الصفحة"; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content" class="container">
    <div class="row">
        <div class="col-6">
            <a class="" href="<?= url_for('/staff/pages/index.php'); ?>">&laquo; العودة للقائمة </a>

            <h2>عدل الصفحة</h2>
            <form action="" method="post">
                <div class="form-group ">
                    <label for="menu_name">اسم الصفحة</label>
                    <input type="text" class="form-control" name="menu_name" id="menu_name" autofocus value="<?= h($subject['menu_name']); ?>">
                </div>
                <div class="form-group ">
                    <label for="position">الموقع</label> &nbsp;
                    <select name="position" id="position" class="custom-select col-md-2">
                        <option value="1" <?= $position == "1" ? "selected" : "" ?>>1</option>
                        <!-- <option value="2" <? //= $position == "2"? "selected": ""
                                                ?>>2</option> -->
                    </select>
                </div>
                <div class="form-check ">
                    <label for="visible" class="form-check-label">الظهور</label>
                    <input type="hidden" class="" name="visible" value="0"> &nbsp;
                    <input type="checkbox" class="form-check-input position-static" name="visible" value="1" id="visible" <?= $visible == "1" ? "checked" : "" ?>>
                </div>

                <div class="form-group"> <br>
                    <button type="submit" class="btn btn-primary">عدل الصفحة</button>
                </div>
            </form>


        </div>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>