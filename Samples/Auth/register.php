<?php
include_once("db_class.php");
include_once("login_class.php");

if (isset($_POST["submit"])) { 
  $auth = new Auth();
  $auth -> register($_POST["email"], $_POST["password"], $_POST["password_confirm"]);
}
?>
 
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
  <table border="0">
    <tr>
      <td>Email:</td>
      <td><input type="text" name="email" maxlength="60"></td>
    </tr>
    <tr>
      <td>Password:</td>
      <td><input type="password" name="password" maxlength="10"></td>
    </tr>
    <tr>
      <td>Confirm Password:</td>
      <td><input type="password" name="password_confirm" maxlength="10"></td>
    </tr>
    <tr>
      <th colspan=2><input type="submit" name="submit" value="Register"></th>
    </tr>
  </table>
</form>