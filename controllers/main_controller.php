<?php
function get($view="main") {
  $content = $view.'_view.php';
  require_once 'layouts/main_layout.php';
}

function getView($view="main") {
  require_once $view.'_view.php';
}
