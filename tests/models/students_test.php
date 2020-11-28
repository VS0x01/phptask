<?php
require_once 'students_model.php';

test("Add student", function() {
  return addStudent(new Student('Denis', 'Nesterenko'));
});

test("Add student with estimate", function() {
  return addStudentWithEstimate(90, new Student('Vadim', 'Shesterikov'), 1);
});

test("Get students", function() {
  return getStudents();
});
