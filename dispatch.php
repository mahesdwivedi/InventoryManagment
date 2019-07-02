<?php
require_once 'includes/functions.php';
// require_once('header.php');
loginCheck(LOGIN_REQUIRE);
if(!isset($_SESSION['cart'])){
$_SESSION['cart']=array();
error_reporting(E_ALL & ~E_NOTICE);
}

if(isset($_POST['key']) && !empty($_POST['key'])){
  $sql="select * from product_detail where sku = ?;";
  $stmt= getPDO()->prepare($sql);
  $stmt->execute([$_POST['key']]);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $a=[];
  if(!array_key_exists('clr',$_POST) && !is_null($result) && !empty($result)){
  array_push($a,$result[0]['name']);
  array_push($a,$result[0]['sku']);
  array_push($_SESSION['cart'],$a);
  $a=[];

}}

var_dump($_SESSION['cart']);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="row">
      <div class="col-md-6">
          <form action="dispatch.php" method="post">
              <input type="text" name="key" value="">
              <input type="submit" name="search" value="search">
              <button type="submit" name="clr" id="clr" value="RUN">Clear</button>
          </form>

      </div>
      <div class="cole-md-6">
          <?php if(isset($_SESSION['cart'])) { ?>
            <div class="disp">
            <ul>

          <?php
              $i=0;
              for($i=0; $i < sizeof($_SESSION['cart']);$i++){
              ?>
                <li><?php print_r($_SESSION['cart'][$i][0]);  ?></li>
              <?php } ?>

            </ul>
              </div>
          <?php } ?>

      </div>

    </div>
  </body>
  <?php
  function clear()
  {
    unset($_SESSION['cart']);
    unset($_POST['clr']);
  }
  if(array_key_exists('clr',$_POST)){
   clear();
}
  ?>
</html>
