<?php
if (isset($_GET['id'])) {
    $uid= $_GET['id'];
}
require_once '../header.php';
require_once '../includes/functions.php';
loginCheck(LOGIN_REQUIRE);
error_reporting(E_ALL & ~E_NOTICE);
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $sql='UPDATE product_detail SET status= "inactive" where id='.$_POST['id'].';';
    getPDO()->exec($sql);
    header("Location:productlist.php");
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="delete.php"  method="POST">
      Are you Sure?
  <input type="hidden" name="id" value="<?php echo $uid; ?>">
      <button type="submit" name="yes">Yes</button>

    </form>
    <a href="productlist.php">No</a>

  </body>
</html>
