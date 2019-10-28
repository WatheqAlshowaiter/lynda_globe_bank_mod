<?php require_once('../private/initialize.php'); ?>

<?php

if( is_post_request()){
$lang = $_POST['lang'] ?? 'أي لغة'; 
$expire = time() + 60*60*24*30; // for month 
setcookie('lang',$_POST['lang'], $expire); 
}else {
    $lang = $_COOKIE['lang']?? 'أي لغة';
    // from cookie if any 
}
?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<divs class="row main">
  <div class="col-sm-3 page">
    <?php include(SHARED_PATH . '/public_nav.php'); ?>

  </div>
  <div class="col-sm-9 content">
   <h2>اختر تفضيلات اللغة</h2>
   <p>اللغة المختارة هي: <em><?= $lang;?></em></p>
   <form action="" method="post">
       <div class="form-group col-3">
       <select class ="form-control" name="lang" id="">
           <?php 
           $lang_choice= ['أي لغة','العربية', 'English'];
           foreach($lang_choice as $choice){
               echo "<option vlaue=\"{$choice}\"";
               if( $lang == $choice){
                   echo " selected";
               }
               echo ">{$choice}</option>";
            }
           ?> 
       </select>
       </div>
       <div class="form-group col-3">
            <input type="submit" class="form-control btn btn-info" value="اختر اللغة المفضلة">
       </div>

   </form>
  </div>
</divs>



<?php include(SHARED_PATH . '/public_footer.php'); ?>