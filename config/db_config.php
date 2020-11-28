<?php

class DB {
  protected static $instance;
  protected function __construct() {}
  public static function getInstance() {
    if(empty(self::$instance)) {
      $db_info = array(
        "db" => "pgsql",
        "db_host" => "localhost",
        "db_port" => "5432",
        "db_user" => "postgres",
        "db_pass" => "root",
        "db_name" => "labtask",
        "db_charset" => "UTF-8");
      try {
        self::$instance = new PDO($db_info['db'].":host=".$db_info['db_host'].';port='.$db_info['db_port'].';dbname='.$db_info['db_name'], $db_info['db_user'], $db_info['db_pass']);
        self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        //self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);  
        self::$instance->query("SET NAMES 'utf8'");
        //self::$instance->query("SET CHARACTER SET utf8");
      } catch(PDOException $error) {
        trigger_error($error->getMessage(), E_USER_ERROR);
      }
    }
    return self::$instance;
  }

  public static function setCharsetEncoding() {
    if (self::$instance == null) {
      self::connect();
    }
    self::$instance->exec(
      "SET NAMES 'utf8';
    SET character_set_connection=utf8;
    SET character_set_client=utf8;
    SET character_set_results=utf8");
  }

  public static function setSilent() {
    self::getInstance()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
  }

  public static function transact(Array $queries) {
    try {
      self::getInstance()->beginTransaction();
      foreach ($queries as $sql) {
        self::query($sql);
      }
      self::getInstance()->commit();
      return true;
    } catch (PDOException $error) {
      self::getInstance()->rollBack();
      trigger_error($error->getMessage(), E_USER_ERROR);
      return false;
    }
  }

  public static function query($sql) {
    try {
      return self::getInstance()->query($sql);
    } catch(PDOException $error) {
      trigger_error($error->getMessage(), E_USER_ERROR);
    } 
  }
}
