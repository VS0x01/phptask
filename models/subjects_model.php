<?php

function addSubjects(Array $subjects) {
  if (empty($subjects)) return false;
  $first_subject = array_shift($subjects);
  $sql = "INSERT INTO subjects (subject_name) VALUES ('{$first_subject}')";
  foreach ($subjects as $subject) {  
    $sql .= ", ('{$subject}')";
  }
  $sql .= ";";
  DB::query($sql);
  return true;
}
