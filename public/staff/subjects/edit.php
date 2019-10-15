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

// if there a post requset (submitting the form)
if (is_post_request()) {
    $subject = []; // define an array then pass it as a parameter
    $subject['id'] = $id;
    $subject['menu_name'] = $_POST['menu_name'] ?? '';
    $subject['position'] = $_POST['position'] ?? '';
    $subject['visible'] = $_POST['visible'] ?? '';

    $result = update_subject($subject); // pass an array as a parameter 
    redirect_to(url_for('/staff/subjects/show.php?id=' . $id));
} else {
    $subject = find_subject_by_id($id);
    $subject_count = count_table("subjects");
}

?>

<?php $page_title = "عدل العنوان"; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content" class="container">
    <div class="row">
        <div class="col-6">
            <a class="" href="<?= url_for('/staff/subjects/index.php'); ?>">&laquo; العودة للقائمة </a>

            <h2>عدل العنوان</h2>
            <form action="" method="post">
                <div class="form-group ">
                    <label for="menu_name">اسم العنوان</label>
                    <input type="text" class="form-control" name="menu_name" id="menu_name" autofocus value="<?= h($subject['menu_name']); ?>">
                </div>
                <div class="form-group ">
                    <label for="position">الموقع</label> &nbsp;
                    <select name="position" id="position" class="custom-select col-md-2">
                        <?php
                        for ($i = 1; $i <= $subject_count; $i++) {
                            echo "<option value=\"$i\" ";
                            if ($subject['position'] == $i) {
                                echo "selected";
                            }
                            echo ">{$i}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-check ">
                    <label for="visible" class="form-check-label">الظهور</label>
                    <input type="hidden" class="" name="visible" value="0"> &nbsp;
                    <input type="checkbox" class="form-check-input position-static" name="visible" value="1" id="visible" <?= $subject['visible'] == "1" ? "checked" : "" ?>>
                </div>

                <div class="form-group"> <br>
                    <button type="submit" class="btn btn-primary">عدل العنوان</button>
                </div>
            </form>


        </div>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>