<?php
require_once 'includes/functions.php';
// loginCheck(LOGIN_NOT_REQUIRE);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory";

$email= $_POST['email'];
$pw= $_POST['password'];

 try {
   $sql="select * from user_detail where email= ? ";
   $stmt= getPDO()->prepare($sql);
   $stmt->execute([$email]);
   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
   if($result){
     $sql= "UPDATE user_detail
   SET
       password= '$pw'
   WHERE
       email = '$email'  ";
   getPDO()->exec($sql);
   $stmt=getPDO()->prepare($sql);
   $stmt->execute();
   header("Location: login.php");
 }
    else{
     echo "Email not registered";
   exit();
   }

}
catch(PDOException $e)
   {
   echo $sql . "<br>" . $e->getMessage();
   }

$conn = null;


?>
