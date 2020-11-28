<?php

class Student {
  private $name, $surname, $id;

  function getName() {
    return $this->name;
  }

  function getSurname() {
    return $this->surname;
  }

  function getId() {
    return $this->id;
  }

  function __construct($name, $surname) {
    $this->name = $name;
    $this->surname = $surname;
    $this->id = md5($name.$surname);
  }
}

