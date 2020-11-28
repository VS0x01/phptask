<?php
ini_set('display_errors', true);
require_once 'db_config.php';

function create_tables() {
  $sql1 = 'CREATE TABLE IF NOT EXISTS "students" ("id" varchar(32) NOT NULL UNIQUE PRIMARY KEY, "name" varchar(32), "surname" varchar(32));';
  $sql2 = 'CREATE TABLE IF NOT EXISTS "estimates" ("id" SERIAL UNIQUE NOT NULL, "subject_id" int REFERENCES subjects(id) ON DELETE CASCADE, "value" int, "student_id" varchar(32) NOT NULL, CONSTRAINT fk_student_id FOREIGN KEY (student_id) REFERENCES students (id));';
  $sql3 = 'CREATE TABLE IF NOT EXISTS "subjects" ("id" SERIAL UNIQUE NOT NULL, "subject_name" varchar(32) UNIQUE NOT NULL);
';
  DB::transact(array($sql1, $sql3, $sql2));
}

function drop_tables() {
  $tables = ['estimates', 'subjects', 'students'];
  $sql=[];
  foreach ($tables as $value) {
    array_push($sql, "drop table if exists {$value} cascade;");
  }
  DB::transact($sql);
}

drop_tables();
create_tables();
