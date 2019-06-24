<?php
require_once '../header.php';
require_once '../includes/functions.php';
$target = "/opt/lampp/htdocs/inventory/assest/image/";

if(isset($_GET['id'])){
  $uid= $_GET['id'];
  unset($GET['id']);
try{
  $sql="select * from user_detail where id= ?";
  $stmt= getPDO()->prepare($sql);
  $stmt->execute([$uid]);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch(Exception $e) {
  echo $e;
  exit;
}}
if($_POST){
  try {
    $sql='UPDATE user_detail
    SET
    emp_id= ?,
    firstname=?,
    lastname=?,
    email=?,
    username=?,
    password=?,
    role=?
    WHERE
    id= ?';
$stmt= getPDO()->prepare($sql);
$stmt->execute([$_POST['empid'],$_POST['firstname'],$_POST['lastname'],
                $_POST['email'],$_POST['username'],$_POST['password'],$_POST['role'],$_POST['id']]);
header("Location:userlist.php");
 }
catch(Exception $e) {
   echo $e;
   exit;
 }
 $target = $target . basename( $_FILES['Filename']['name']);
 $Filename=basename( $_FILES['Filename']['name']);
 if (move_uploaded_file($_FILES['Filename']['tmp_name'], $target)) {
   $sql='UPDATE user_detail
   SET image = ?
   WHERE id= ?;';
   $stmt= getPDO()->prepare($sql);
   $stmt->execute([$Filename,$_POST['id']]);
   exit;
 }
 else {
 echo "Move upload seems to be struct !" ;
 }
}

 ?>
 <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="update.php" method="post"class="form-group" enctype="multipart/form-data">
      <h2 class="form-signin-heading">Update User</h2>

    <b>Employee ID</b><input type="text" name="empid"  class="form-control"
    placeholder="Employee ID" value="<?php print_r($result[0]['emp_id']); ?>">
    <b>Firstname</b><input type="text" name="firstname"
      placeholder="firstname" class="form-control" value="<?php print_r($result[0]['firstname']); ?>" required="">
    <b>Lastname</b><input type="text" name="lastname"
     placeholder="lastname" class="form-control" value="<?php print_r($result[0]['lastname']); ?>"required="">
    <b>Email</b><input type="text" name="email"
    placeholder="email" class="form-control email-in" value="<?php print_r($result[0]['email']); ?>"required="">
    <b>Username</b><input type="text" name="username"
    placeholder="username" class="form-control" value="<?php print_r($result[0]['username']); ?>"required="">
    <b>Password</b><input type="text" name="password"
     placeholder="password" class="form-control" value="<?php print_r($result[0]['password']); ?>"required="">

    <?php
    $sql2="select * from role ";
    $stmt= getPDO()->prepare($sql2);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
     ?>

    <div class="form-group">
    <label for="role">Role</label>
    <select class="form-control" name="role" id="role">

    <?php
    foreach($result as $res){?>
    <option value= "<?php print_r($res['id']) ?>"><?php print_r($res['name']) ?></option>
    <?php } ?>
    </select>

    </div>
    <b>image</b>
    <input type="file" name="Filename">
    <br>
    <input type="hidden" name="id" value="<?php print_r($uid); ?>">
    <input TYPE="submit" name= "uploadid" value="Update" class="btn btn-primary ">
    <br>
    </form>
    <!-- <form method="POST" action="../upload.php" enctype="multipart/form-data">
        <input type="file" name="Filename">
        <input TYPE="submit" name="uploadid" value="
        ">
    </form> -->
  </body>
</html>
