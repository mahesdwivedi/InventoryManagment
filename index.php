<?php
require_once 'includes/functions.php';
require_once('header.php');
loginCheck(LOGIN_REQUIRE);
require_once __DIR__ . '/vendor/autoload.php';
error_reporting(E_ALL & ~E_NOTICE);
if(!empty($_POST)){
  try {
    if($_POST['name'] && !empty($_POST['name'])) {
      $product = $_POST['name'];
       $sql="select * from product_detail where name = ?";

       $stmt= getPDO()->prepare($sql);
       $stmt->execute([$product]);
       $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
       // echo $_SESSION['flag'];

       if($result[0]){

         $sku = $result[0]["sku"];
       }
     } elseif($_SESSION['flag'] ==1){

     $sql='INSERT INTO product_detail (name,description,sku) VALUES ("'.$_POST["productname"].'","'.$_POST["productdesc"].'","'.$_POST["sku"].'");';
// echo $sql;
     getPDO()->exec($sql);

     $product = $_POST["productname"];
     $sku = $_POST["sku"];
       // echo "-------Added-----";
       }

       if($product && $sku) {
         $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
         // $code = hash('ripemd160', $result[0]["name"].$result[0]["sku"]);
         $barcode = $generator->getBarcode($product.$sku, $generator::TYPE_CODE_128);

       }
     //
       } catch(Exception $e) {

             $_SESSION["error"] = $e->getMessage();
             // header("Location:index.php");
       }
     }
?>


  <div class="row">
    <div class="col-md-6 product-search">
      <form  action="index.php" method="post">
      <input type="text" name="name" placeholder="Search the product ...">
      <button type="submit" name="button">Search</button>
    </form>
    </div>
    <div class="col-md-6 product-details">
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
