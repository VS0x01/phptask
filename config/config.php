<?php

define('PS', PATH_SEPARATOR);
define('DS', DIRECTORY_SEPARATOR);
//define('APP_DIR', $_SERVER['DOCUMENT_ROOT']);
define('APP_DIR', "C:/Bitnami/wappstack-7.4.12-0/apps/phptask/htdocs");
define('TEST_DIR', 'tests');
define('PROTOCOL', 'http');

$dirs = array(
  "models"=>"models",
  "views"=>"views",
  "controllers"=>"controllers",
  "dto"=>"dto"
);

$query_lines_limit = 20;
