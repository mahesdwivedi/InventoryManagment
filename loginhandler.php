<?php require_once 'includes/functions.php';
loginCheck(LOGIN_NOT_REQUIRE);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory";

$name = isset($_POST['name'])  ? trim($_POST['name']) : null;
$pass =  isset($_POST['password'])  ? trim($_POST['password']) : null;

if (is_null($name) || is_null($pass)) {
  $_SESSION["error"] = "Form is malfunctioned.";
  header("Location:login.php");
  exit;
}
if (empty($name) || empty($pass)) {
  $_SESSION["error"] = "Empty submission.";
  header("Location:login.php");
  exit;
}
// try{
//   $sql="INSERT INTO login_detail VALUES ('$name');";
//   $stmt=getPDO()->prepare($sql);
//   $stmt->execute();
// }
// catch(Exception $e) {
//
//       $_SESSION["error"] = $e->getMessage();
//       header("Location:login.php");
//       exit;
// }

try {
   $sql="select * from user_detail where username= ? AND password= ?";
   $stmt= getPDO()->prepare($sql);
   $stmt->execute([$name, $pass]);
   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
   if($result){
     $_SESSION["login_user"]=$result[0];
     header("Location: index.php");
   } else{
       $_SESSION["error"] = "Invalid credentials.";
       header("Location:login.php");
       exit;
   }
} catch(Exception $e) {

      $_SESSION["error"] = $e->getMessage();
      header("Location:login.php");
      exit;
}



?>
