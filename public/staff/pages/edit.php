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

if (is_post_request()) {
    $page = [];
    $page['id'] = $id;
    $page['subject_id'] = $_POST['subject_id'] ?? '';
    $page['menu_name'] = $_POST['menu_name'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';
    $page['content'] = $_POST['content'] ?? '';

    $result  = update_page($page);
    redirect_to(url_for('/staff/pages/show.php?id=' . $id));
} else {
    $page = [];
    $page = find_page_by_id($id);
    $page_count = count_table("pages");
}
?>

<?php $page_title = "عدل الصفحة"; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content" class="container new-page">
    <div class="row">
        <div class="col-6">
            <a class="" href="<?= url_for('/staff/pages/index.php'); ?>">&laquo; العودة للقائمة </a>

            <h2>عدّل الصفحة</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label for="subject_id">العنوان</label>
                    <select class="custom-select col-6" name="subject_id" id="subject_id" autofocus>
                        <?php
                        $subject_set = find_all_subjects();
                        while ($subject = $subject_set->fetch((PDO::FETCH_ASSOC))) {
                            echo "  <option value=\"" . h($subject["id"]) . "\"";
                            if ($page["subject_id"] == $subject['id']) {
                                echo " selected";
                            }
                            echo ">" . h($subject['menu_name']) . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="menu_name">اسم الصفحة</label>
                    <input type="text" class="form-control" name="menu_name" id="menu_name" value="<?= h($page['menu_name']); ?>">
                </div>
                <div class="form-group ">
                    <label for="position">الموقع</label> &nbsp;
                    <select name="position" id="position" class="custom-select col-md-2">
                        <?php
                        for ($i = 1; $i <= $page_count; $i++) {
                            echo "<option value=\"{$i}\"";
                            if ($page["position"] == $i) {
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
                    <input type="checkbox" class="form-check-input position-static" name="visible" value="1" id="visible" <?= $page['visible'] == "1" ? "checked" : "" ?>>
                </div>

                <div class="form-group"> <br>
                    <label for="conent">المحتوى </label> <br>
                    <textarea class="form-control" name="content" id="content" cols="30" rows="5"><?= $page['content']?></textarea>
                </div>

                <div class="form-group"> <br>
                    <button type="submit" class="btn btn-primary"> عدل هذه الصفحة</button>
                </div>
            </form>


        </div>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>