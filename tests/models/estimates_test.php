<?php
require_once 'estimates_model.php';

test("Get estimates", function() {
  return getStudentsWithTheirEstimates();
});

test("Add estimates", function() {
  return addEstimates("98cbea0d18beedb5e1308d6229224450", [1 => 12, 2 => 65, 3 => 85, 4 => 56]);
});

test("Add estimates and get", function() {
  addEstimates("0f6e4cfe93217df5c0e37f3372398fce", [1 => 50, 2 => 67, 3 => 83, 4 => 99]);
  return getStudentsWithTheirEstimates();
});
