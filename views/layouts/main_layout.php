<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?=isset($title)?$title:'Lab task';?></title>
  <?php if (isset($style)): ?>
  <link rel="stylesheet" href="<?=$style;?>">
  <?php endif; ?>
  <style>
    .switcher {
      width: 32px;
      margin-bottom: 8px;
    }

    .student_status {
      margin: 8px 0 16px 0;
      text-align: center;
      border-right-color: #eee;
      border-bottom-color: #eee;
      background: #d3d3d3;
      color: #002ef8;
    }

    .excellent {
      background: green;
      color: white;
    }

    .risk {
      background: yellow;
      color: black;
    }

    .deduct {
      background: red;
      color: white;
    }

    .add {
      display: grid;
      width: min-content;
      grid-template-columns: 1fr 1fr;
      grid-column-gap: 32px;
      grid-row-gap: 4px;
    }

    .add b {
      grid-column: 1 / 3;
      text-align: center;
      margin: 4px 0;
    }
  </style>
</head>
<body>
<div class="container">
<?php
if (isset($content))
  require_once $content;
else require_once '404.php';
?>
</div>
</body>
</html>

