<?php
require 'student.php';

function getStudentsWithTheirEstimates($offset=0) {
  $sql = "SELECT e.student_id, s.name, s.surname, array_to_json(array_agg(row_to_json(row(subj.id, subj.subject_name, e.value)))) estimates, MIN(e.value) min_value, MAX(e.value) max_value from students s, estimates e, subjects subj WHERE (s.id = e.student_id) AND (e.subject_id = subj.id) GROUP BY e.student_id, s.name, s.surname ORDER BY s.surname LIMIT {$GLOBALS["query_lines_limit"]} OFFSET {$offset};";
  $res = DB::query($sql);
  if (!empty($res)) {
    return $res->fetchAll(PDO::FETCH_ASSOC);
  }
  return false;
}

function getEstimatesOfStudent($student_id) {
  $sql = "SELECT e.value, s.name FROM estimates e, subject s WHERE e.student_id LIKE {$student_id};";
  $res = DB::query($sql);
  if (!empty($res)) {
    return $res->fetchAll(PDO::FETCH_ASSOC);
  }
  return false;
}

function addEstimates(string $student_id, Array $estimates) {
  if (!empty($estimates)) {
    $pre_sql = "DELETE FROM estimates WHERE student_id = '{$student_id}';";
    $sql = "INSERT INTO estimates (value, student_id, subject_id) VALUES ";
    foreach ($estimates as $subject_id => $estimate) {
      $sql .= "('{$estimate}', '{$student_id}', '{$subject_id}'),";
    }
    $sql = rtrim($sql, ',');
    $sql .= ';';
    DB::transact([$pre_sql, $sql]);
    return true;
  }
  return false;
}

