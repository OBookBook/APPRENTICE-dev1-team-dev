<?php

require_once(__DIR__ . '/../functions/ConnectionToSql.php');

class Task
{
  public $connectionToSql;

  public function __construct()
  {
    $this->connectionToSql = new ConnectionToSql();
  }
}
