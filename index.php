<?php
require_once 'includes/functions.php';
require_once('header.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory";
error_reporting(E_ALL & ~E_NOTICE);
if(!empty($_POST)){
  try {
    if($_POST['name'] && !empty($_POST['name'])) {
      $product = $_POST['name'];
       $sql="select * from product_detail where name = ?";

       $stmt= getPDO()->prepare($sql);
       $stmt->execute([$product]);
       $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
       echo $_SESSION['flag'];
     } elseif($_SESSION['flag'] ==1){

     $sql='INSERT INTO product_detail (name,description,sku) VALUES ("'.$_POST["productname"].'","'.$_POST["productdesc"].'","'.$_POST["sku"].'");';
echo $sql;
     getPDO()->exec($sql);
       echo "-------Added-----";
       }
     //
       } catch(Exception $e) {

             $_SESSION["error"] = $e->getMessage();
             // header("Location:index.php");
       }
     }
?>

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <form  action="index.php" method="post">
      <input type="text" name="name">Product Name
      <button type="submit" name="button">Search</button>
    </form>
    </div>
    <div class="col-md-6">
      <?php
      if(!empty($_POST)  ){
        // print_r($result[0]);
        if(!empty($result)  ){
        ?>
        <p>name:<?php echo $result[0]["name"]; ?></p>
          <p>description:<?php echo $result[0]["description"]; ?></p>
            <p> Unique ID:<?php echo $result[0]["sku"]; ?></p>
        <?php
      } else{?>
        <p>Product not found. Please add the new product</p>
        <form  action="index.php" method="post">
        Product Name<input type="text" name="productname" value="<?php echo $_POST['name'];?>">
        Product Description<input type="text" name="productdesc">
        Product Unique ID<input type="text" name="sku">
        <button type="submit" name="button">Add New</button>
      </form>
    <?php
  $_SESSION['flag']= 1;

  }
  }
      ?>
    </div>
  </div>

</div>
<?php

require_once('footer.php');
