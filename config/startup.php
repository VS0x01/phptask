<?php
//ini_set('display_errors', true);
ini_set('display_errors', 0);

require_once 'config.php';
require_once 'db_config.php';
require_once 'router.php';

//DB::query("SELECT * FROM students;");

set_pathes();

function set_pathes() {
  $path = get_include_path();
  foreach ($GLOBALS['dirs'] as $dir) {
    $path .= PS . APP_DIR . DS . $dir;
  }
  set_include_path($path);
}

