<?php require_once('../private/initialize.php'); ?>

<?php
if (isset($_GET['id'])) {
  $page_id = $_GET['id'];
  $page = find_page_by_id($page_id);
  if (!$page) {
    redirect_to(url_for('/index.php'));
  }
  $subject_id = $page["subject_id"];
} elseif (isset($_GET["subject_id"])) {
  $subject_id = $_GET["subject_id"];
  $page_set = find_pages_by_subject_id($subject_id);
  $page =  $page_set->fetch(PDO::FETCH_ASSOC); // just 1st result 
  $page_set->closeCursor();
  if (!$page) {
    redirect_to(url_for('/index.php'));
  }
  $page_id = $page['id'];
} else {
  // do nothing 
  //  display homepage
}

?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<divs class="row main">
  <div class="col-sm-3 page">
    <?php include(SHARED_PATH . '/public_nav.php'); ?>

  </div>
  <div class="col-sm-9 content">
    <?php
    if (isset($page)) {
      // show the page from DB 
      // TODO add html escape back 
      echo $page['content'];
    } else {
      // Show the homepage
      // The homepage content could:
      // * be static content (here or in a shared file)
      // * show the first page from the nav
      // * be in the database but add code to hide in the nav
      include(SHARED_PATH . '/static_homepage.php');
    }
    ?>
  </div>
</divs>



<?php include(SHARED_PATH . '/public_footer.php'); ?>