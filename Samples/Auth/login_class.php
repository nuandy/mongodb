<?php
class Auth {

  public function register($email, $password, $password_confirm) {
    $connection = new Db();
    $collection = $connection->set_collection();
    if (!$email | !$password | !$password_confirm ) {
      die("You did not complete all of the required fields");
    }
    if (!get_magic_quotes_gpc()) {
      $email = addslashes($email);
    }
    $email_exists = $collection->count(array("email" => $email));
    if ($email_exists != 0) {
      die("Sorry, the email ".$email." is already in use.");
    }
    if ($password != $password_confirm) {
      die("Your passwords do not match.");
    }
    $password = md5($password);
    if (!get_magic_quotes_gpc()) {
      $password = addslashes($password);
      $email = addslashes($email);
    }
    $document = array("email" => $email, "password" => $password);
    $collection->insert($document);
    header("Location: mongo.php");
  }

  public function login($email, $password) {
    $connection = new Db();
    $collection = $connection->set_collection();
    if(!$email | !$password) {
      die("You did not fill in a required field.");
    }
    if (!get_magic_quotes_gpc()) {
      $email = addslashes($email);
    }
    $email_exists = $collection->count(array("email" => $email));
    if ($email_exists == 0) {
      die("That user does not exist in our database. <a href=register.php>Click Here to Register</a>");
    }
    $find_email = $collection->findOne(array("email" => $email));
    $password = stripslashes($password);
    $find_email["password"] = stripslashes($find_email["password"]);
    $password = md5($password);
    if ($password != $find_email["password"]) {
      die("Incorrect password, please try again.");
    } else {
      $email = stripslashes($email);
      $hour = time() + 3600;
      setcookie(Email_Mongo, $email, $hour);
      setcookie(Password_Mongo, $password, $hour);
      header("Location: mongo.php");
    } 
  }

  public function check_cookie($cookie) {
    $connection = new Db();
    $collection = $connection->set_collection();
    $email = $_COOKIE["Email_Mongo"];
    $password = $_COOKIE["Password_Mongo"];
    $find_email = $collection->findOne(array("email" => $email));
    if ($password != $find_email["password"]) {
    } else {
      header("Location: mongo.php");
    }
  }

}
?>