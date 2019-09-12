<?php
require_once('../../../private/initialize.php');
?>


<?php
// initial values 
$menu_name =  '';
$position =  '';
$visible =  '';

?>
<?php
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

<?php $page_title = "إنشاء عنوان"; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content" class="container">
    <div class="row">
        <div class="col-6">
            <a class="" href="<?= url_for('/staff/subjects/index.php'); ?>">&laquo; العودة للقائمة </a>

            <h2>إنشئ عنوانا جديدا</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label for="menu_name">اسم العنوان</label>
                    <input type="text" class="form-control" name="menu_name" id="menu_name" autofocus value="<?= h($menu_name); ?>">
                </div>
                <div class="form-group ">
                    <label for="position">الموقع</label> &nbsp;
                    <select name="position" id="position" class="custom-select col-md-2">
                        <option value="1" <?= $position == "1" ? "selected" : ''; ?>>1</option>
                          <!--just for test -->
                        <!-- <option value="2" <?//= $position == "2" ? "selected" : ''; ?>>2</option> -->
                      
                    </select>
                </div>
                <div class="form-check ">
                    <label for="visible" class="form-check-label">الظهور</label>
                    <input type="hidden" class="" name="visible" value="0"> &nbsp;
                    <input type="checkbox" class="form-check-input position-static" 
                    name="visible" value="1" id="visible" <?= $visible == "1" ? "checked" : "" ?>>
                </div>

                <div class="form-group"> <br>
                    <button type="submit" class="btn btn-primary"> إنشئ عنوانا جديدا</button>
                </div>
            </form>


        </div>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>