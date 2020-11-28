<?php

$uri = $_SERVER['REQUEST_URI'];
$uri = explode('/', $uri);
array_shift($uri);
array_shift($uri);
$controller = array_shift($uri);
$params = [];

switch ($_SERVER['REQUEST_METHOD']) {
  case 'POST':
    $action = 'add';    
    break;
  case 'GET':
  default:
    if (isset($_GET['view'])) $params = array('view' => $_GET['view']);
    $action = isset($_GET['only'])?'getView':'get';
    if (isset($_GET['action'])) $action = $_GET['action'];
}
