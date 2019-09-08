<?php

function url_for($script_path)
{
    // adding '/' if nor present 
    if ($script_path[0] != '/') {
        $script_path = '/' . $script_path;
    }
    return WWW_ROOT . $script_path;
}
