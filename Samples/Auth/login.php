<?php
include_once ("db_class.php");
include_once ("login_class.php");

if (isset($_POST["submit"]) && !isset($_COOKIE["Email_Mongo"])) { 
  $auth = new Auth();
  $auth -> login($_POST["email"], $_POST["password"]);
}

if(isset($_COOKIE["Email_Mongo"])) {
  $auth = new Auth();
  $auth -> check_cookie($_COOKIE["Email_Mongo"]);
}

?>

<form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
  <table border="0">
    <tr>
      <td colspan=2><h1>Login</h1></td>
    </tr>
    <tr>
      <td>Username:</td>
      <td><input type="text" name="email" maxlength="40"></td>
    </tr>
    <tr>
      <td>Password:</td>
      <td><input type="password" name="password" maxlength="50"></td>
    </tr>
    <tr>
      <td colspan="2" align="right"><input type="submit" name="submit" value="Login"></td>
    </tr>
  </table>
</form>