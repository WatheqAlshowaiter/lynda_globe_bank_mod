<?php

function url_for($script_path) {
  // add the leading '/' if not present
  if($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

// url encode for links (after ? wich is important)
function u($string = ""){
  return urlencode($string);
}

// url encode for links (before ? wich is less important)
function raw_u($string = ""){
  return rawurlencode($string); 
}

// excape special chars 
function h ($string = ""){
  return htmlspecialchars($string); 
}
 

?>
