<?php
require_once 'header.php';
 require_once 'includes/functions.php';
loginCheck(LOGIN_NOT_REQUIRE);

if(isset($_SESSION["error"] )){
echo   $_SESSION["error"];
unset($_SESSION["error"]);
}
// if(isset($_SESSION["error2"] )){
// echo   $_SESSION["error2"];
// unset($_SESSION["error2"]);
// }
?>

 <div class="wrapper">
<form action="loginhandler.php" method="post"class="form-signin">
  <h2 class="form-signin-heading">LogIn</h2>

<input type="text" name="name" class="form-control email-in" placeholder="Username" required="" autofocus="" value="  ">

<input type="password" name="password" class="form-control password-in" placeholder="Password" required="">
<input type="submit" value="Login" class="btn btn-primary btn-block">
<br>
<p>Forgot password??<a href="reset.php"> Click Here </a></p>
</form>
</div>
<?php

require_once 'footer.php'; ?>
