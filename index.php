<?php

require_once 'config/startup.php';
//echo $controller.'<br>';
//var_dump($_GET);
$controller_file = $controller.'_controller.php';
if (file_exists('controllers'.DS.$controller_file)) {
  require_once $controller_file;
} else {
  require_once 'main_controller.php';
}

call_user_func_array($action, $params);
