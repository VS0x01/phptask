<?php
require 'estimates_model.php';

function getAll() {
  $offset = 0;
  if (isset($_GET['offset'])) $offset = intval($_GET['offset']);
  $res = getStudentsWithTheirEstimates($offset);
  if (isset($_GET['json'])) 
    echo json_encode($res);
  else {
    $students = array_map(function($el) {unset($el['estimates']);return $el;}, $res);
    $predata = $res[0];
    $content = 'estimates'.DS.'index_view.php';
    require_once 'layouts'.DS.'main_layout.php';
  }
}

function get($view='show') {
  if (isset($_GET['student_id'])) {
    $predata = $res = getEstimatesOfStudent($_GET['student_id']);
    if ($res) {
      if (!isset($_GET['json'])) 
        require_once 'estimates'.DS.$view.'_view.php';
      else {
        header('Content-type: application/json');
        echo json_encode($res);
      }
    }
    else http_response_code(404);
  } else echo 'Please, give us student_id';
}

function add() {
  $data = file_get_contents('php://input');
  $data = get_object_vars(json_decode($data));
  if (!empty($data)) {
    if (isset($data['student_id']) && !empty($data['estimates'])) {
      addEstimates($data['student_id'], get_object_vars($data['estimates']));
      return true;
    }
  }
  return false;
}
