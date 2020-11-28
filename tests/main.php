<?php

DB::setSilent();
_require_all(TEST_DIR, 3);

function _require_all($dir, $depth=0) {
  if ($depth == 0) {
    return;
  }
  // require all php files
  $scan = glob("$dir/*");
  foreach ($scan as $path) {
    if (preg_match('/\.php$/', $path)) {
      require_once $path;
    }
    elseif (is_dir($path)) {
      _require_all($path, $depth--);
    }
  }
}

function test($msg, $cb) {
  echo $msg;
  echo ":<br>";
  var_dump($cb());
  echo "<br>";
}

