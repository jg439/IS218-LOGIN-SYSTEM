<?php
//dbConn Singleton class that we developed in class
class dbConn{
  protected static $db;
  private function __construct() {
    try {
      self::$db = new PDO( 'mysql:host=sql2.njit.edu;dbname=jg439', 'jg439', 'Q1jq01Pv' );
      self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch (PDOException $e) {
      echo "Connection Error: " . $e->getMessage();
    }
  }
  public static function getConnection() {
    if (!self::$db) {
      new dbConn();
    }
    return self::$db;
  }
}

?>
