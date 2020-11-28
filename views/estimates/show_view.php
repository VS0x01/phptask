<?php
$estimates = (array) json_decode($predata['estimates']);
?>
<form>
  <table border='1' cellspacing='0' cellpadding='5'>
    <thead>
      <tr>
        <th>Студент:</th>
        <th><?=$predata['surname']?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($estimates as $value): ?>
      <tr>
        <td><?=$value->f2;?></td>
        <td><?=$value->f3;?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php
  $student_status = "OK!";
  $class = "";
  if ($predata['min_value']>89) {$student_status = "Відмінник";$class="excellent";}
  else {
    if ($predata['max_value']>60 && $predata['min_value']<60) {
      $student_status = "Ризик відрахування";
      $class = "risk";
    }
    else if ($predata['max_value']<60) {
      $class = "deduct";
      $student_status = "Відрахувати !";
    }
  }
  ?>
  <input class="student_status <?=$class?>" value="<?=$student_status?>" disabled>
</form>
