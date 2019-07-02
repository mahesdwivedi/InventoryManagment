<?php
// require_once('../header.php');
require_once('../includes/functions.php');
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
	// print_r(1);
		if(!empty($_POST["key"]) && !is_null($_POST["key"])) {
			// print_r(2);

			$productByCode = $db_handle->runQuery("SELECT * FROM product_detail WHERE sku='" . $_POST["key"] . "'");
			$itemArray = array($productByCode[0]["sku"]=>array('name'=>$productByCode[0]["name"], 'sku'=>$productByCode[0]["sku"],
			'quantity'=>1 , 'description'=>$productByCode[0]["description"], 'image'=>$productByCode[0]["image"]));
			// print_r($productByCode);
			if(!empty($_SESSION["cart_item"]) && !is_null($productByCode) && !empty($productByCode))
			 {
				if(array_key_exists($productByCode[0]["sku"],$_SESSION["cart_item"]))
				{
					print_r(4);
					foreach($_SESSION["cart_item"] as $k => $v)
					{
							if($productByCode[0]["sku"] == $k)
							{
								if(empty($_SESSION["cart_item"][$k]["quantity"]))
								{
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += 1;
							}
					}
				}
				else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
					var_dump($_SESSION["cart_item"]);

				}
			}
			 else {
				 if(!is_null($productByCode) && !empty($productByCode))
				$_SESSION["cart_item"] = $itemArray;
				var_dump($_SESSION["cart_item"]);

			}
		}
	break;
	case "remove":
	print_r($_GET["sku"]);
		if(!empty($_SESSION["cart_item"])) {
			print_r("-------");
			foreach($_SESSION["cart_item"] as $k => $v) {
						if($_GET["sku"] == $v["sku"]){
						unset($_SESSION["cart_item"][$k]);
					}
		}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;
}
}
?>
<HTML>
<HEAD>
<TITLE>Cart</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
<div id="shopping-cart">
<div class="txt-heading">Cart</div>

<a id="btnEmpty" href="index.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Description</th>
<th style="text-align:left;">sku</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>
<?php
    foreach ($_SESSION["cart_item"] as $item){
        // $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
				<td><?php echo $item["description"]; ?></td>
				<td><?php echo $item["sku"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td style="text-align:center;"><a href="index.php?action=remove&sku=<?php echo $item["sku"]; ?>"
						class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				// $total_price += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="3" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td></td>
</tr>
</tbody>
</table>
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php
}
?>
</div>

<div id="product-grid">
	<div class="txt-heading">Products</div>
			<div class="product-item">
			<form method="post" action="index.php?action=add">
			<div class="product-tile-footer">
					<input type="text" name="key" value="" placeholder="Search">
				 	<input type="submit" value="Search" class="btnAddAction" /></div>
			</div>
			</form>
		</div>

</div>
</BODY>
</HTML>
