<?php
function addStudent(Student $s) {
  $sql = "INSERT INTO students (id, name, surname) VALUES ('{$s->getId()}', '{$s->getName()}', '{$s->getSurname()}');";
  DB::query($sql);
  return true;
}

function getStudents(int $offset=0) {
  $sql = "SELECT * from students LIMIT {$GLOBALS["query_lines_limit"]} OFFSET {$offset};";
  $res = DB::query($sql);
  if (!empty($res)) {
    return $res->fetchAll(PDO::FETCH_ASSOC);
  }
  return false;
}

function addStudentWithEstimate(int $e, Student $s, int $subject_id) { 
  $sql1 = "INSERT INTO students (id, name, surname) VALUES ('{$s->getId()}', '{$s->getName()}', '{$s->getSurname()}');"; 
  $sql3 = "INSERT INTO estimates (value, student_id, subject_id) VALUES ('{$e}', '{$s->getId()}', '{$subject_id}');";
  $pl = array($sql1, $sql3);
  return DB::transact($pl);
}
