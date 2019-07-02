<?php
require_once '../header.php';
require_once '../includes/functions.php';
loginCheck(LOGIN_REQUIRE);
$uid=$_GET['id'];
$sql="select * from product_detail where id= ?";
$stmt= getPDO()->prepare($sql);
$stmt->execute([$uid]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r("Id:".$result[0]['id'].'<br>');
print_r("name: ".$result[0]['name'].'<br>');
print_r("description: ".$result[0]['description'].'<br>');
print_r("sku: ".$result[0]['sku'].'<br>');
print_r("color_id: ".$result[0]['color_id'].'<br>');
print_r("minimum_qty: ".$result[0]['minimum_qty'].'<br>');
print_r("date_of_creation: ".$result[0]['date_of_creation'].'<br>');
print_r("status: ".$result[0]['status'].'<br>');

 ?>
 
