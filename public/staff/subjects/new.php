<?php
require_once('../../../private/initialize.php');
?>

<?php
if (is_post_request()) {
    $subject = [];

    $subject['menu_name'] = $_POST['menu_name'] ?? '';
    $subject['position'] = $_POST['position'] ?? '';
    $subject['visible'] = $_POST['visible'] ?? '';

    $result = insert_subject($subject);
    if ($result === true) {
        $new_id = $db->lastInsertId(); // Returns the ID of the last inserted row (Native function)
        redirect_to(url_for("/staff/subjects/show.php?id=" . $new_id));
    } else {
        $errors = $result;
    }
} else { // if no creation new subject yet
    $subject = [];
    $subject["menu_name"] = "";

    $subject_count = count_table("subjects") + 1;
    $subject['position'] = $subject_count;
    
    $subject["visible"] = "";
}
$subject_count = count_table("subjects") + 1; // to make a value position when there an error after submit



?>

<?php $page_title = "إنشاء عنوان"; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content" class="container">
    <div class="row">
        <div class="col-6">
            <a class="" href="<?= url_for('/staff/subjects/index.php'); ?>">&laquo; العودة للقائمة </a>

            <h2>إنشئ عنوانا جديدا</h2>
            <?php echo display_errors($errors); ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="menu_name">اسم العنوان</label>
                    <input type="text" class="form-control" name="menu_name" id="menu_name" autofocus value="<?= isset($subject['menu_name']) ? h($subject['menu_name']) : '' ?>">
                </div>
                <div class="form-group ">
                    <label for="position">الموقع</label> &nbsp;
                    <select name="position" id="position" class="custom-select col-md-2">
                        <?php
                        for ($i = 1; $i <= $subject_count; $i++) {
                            echo "<option value=\"$i\" ";
                            if ($subject["position"] == $i) {
                                echo " selected";
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
                    <button type="submit" class="btn btn-primary"> إنشئ عنوانا جديدا</button>
                </div>
            </form>


        </div>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>