<?php
class Db {

  public function connect() {
    $connection = new Mongo("localhost:27017", array("persist" => "dude"));
    $db = $connection->test;
    return $connection;
  }

  public function set_collection() {
    $connection = $this->connect();
    $collection = $connection->test->users;
    return $collection;
  }

}
?>
