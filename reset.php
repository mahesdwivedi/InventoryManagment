<?php
require_once 'header.php';
 require_once 'includes/functions.php';
 ?>
 <div class="wrapper">
    <form action="resethandler.php" method="POST" class="form-signin">
      <h2 class="form-signin-heading">Reset Password</h2>

        <input type="text" name="email"  class="form-control email-in" placeholder="Email Address" required="" autofocus="">

        <input type="text" name="password" class="form-control con-password-in" placeholder="New Password" required="">
        <input type="text" name="password" class="form-control password-in" placeholder="Confirm Password" required="">

        <input type="submit" class="btn btn-primary btn-block" value="Reset">

    </form>

  </div>
    <?php
    require_once 'footer.php';
