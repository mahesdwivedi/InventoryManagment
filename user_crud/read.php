<?php
require_once '../header.php';
require_once '../includes/functions.php';

$uid=$_GET['id'];
$sql="select * from user_detail where id= ?";
$stmt= getPDO()->prepare($sql);
$stmt->execute([$uid]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r('<img src="../assest/image/'.$result[0]['image'].'" height="50" width="50" ></img> <br>');
print_r( "Id:".$result[0]['id'].'<br>');
print_r( "Emp_id: ".$result[0]['emp_id'].'<br>');
print_r ("Firstname: ".$result[0]['firstname'].'<br>');
print_r ("Lastname: ".$result[0]['lastname'].'<br>');
print_r ("Email: ".$result[0]['email'].'<br>');
print_r ("Username: ".$result[0]['username'].'<br>');
print_r ("Password: ".$result[0]['password'].'<br>');
print_r ("Role: ".$result[0]['role'].'<br>');
print_r ("Date_of_Creation: ".$result[0]['date_of_creation'].'<br>');
print_r ("Date_of_Modification: ".$result[0]['date_of_modification']."<br>");

 ?>
 <div class="wrapper">

   <div class="row">
     <div class="col-md-3">
       Employee_id:
     </div>
     <div class="col-md-3">
       <?php echo $result[0]['emp_id']; ?>
     </div>
     <div class="col-md-3">
       Email:
     </div>
     <div class="col-md-3">
       <?php echo $result[0]['email']; ?>
     </div>
   </div>
   <div class="row">

   </div>
 </div>
