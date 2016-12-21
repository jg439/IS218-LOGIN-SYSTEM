<?php
//model class that you developed in class

  abstract class model {
    private $guid;
    private $db;
    public function __construct() {
      $this->db = dbConn::getConnection();
      $this->guid = uniqid();
    }
    public function save() {
      $_SESSION[$this->guid] = (array) $this;
    }
  }
?>
