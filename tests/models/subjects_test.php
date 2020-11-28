<?php 

require_once 'subjects_model.php';

test("Add subjects", function() {
  $arr = array('Математика', 'Фізика', "Програмування", "Фізкультура :)");
  return addSubjects($arr);
});
