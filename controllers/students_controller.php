<?php

require_once 'students_model.php';
require_once 'student.php';

function get() {
  $offset = 0;
  if (isset($_GET['offset'])) $offset = $_GET['offset'];
  echo json_encode(getStudents($offset));
}

function add() {
  $data = file_get_contents('php://input');
  $data = get_object_vars(json_decode($data));
  if (!empty($data)) {
    if (isset($data['name']) && isset($data['surname'])) {
      $student = new Student($data['name'], $data['surname']);
      addStudent($student);
      echo json_encode($student->getId());
    }
  }
  return false;
}
