<?php require_once '../header.php';
      require_once '../includes/functions.php';

if($_POST){
  try {
    $sql='INSERT INTO user_detail(emp_id,firstname,lastname,email,username,password,role)
    VALUES('.$_POST['empid'].',
      "'.$_POST['firstname'].'",
      "'.$_POST['lastname'].'",
      "'.$_POST['email'].'",
      "'.$_POST['username'].'",
      "'.$_POST['password'].'",
      '.$_POST['role'].');';
// print_r($sql);
    getPDO()->exec($sql);

   header("Location:userlist.php");
   exit;
 }
 catch(Exception $e) {
   echo $e;
   // header("Location:adduser.php");
   exit;
 }
}
 ?>
 <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="adduser.php" method="post"class="form-group">
      <h2 class="form-signin-heading">Add User</h2>

    <b>Employee ID</b><input type="text" name="empid"  class="form-control" placeholder="Employee ID" required="">
    <b>Firstname</b><input type="text" name="firstname"  placeholder="firstname" class="form-control" required="">
    <b>Lastname</b><input type="text" name="lastname"  placeholder="lastname" class="form-control" required="">
    <b>Email</b><input type="text" name="email"  placeholder="email" class="form-control email-in" required="">
    <b>Username</b><input type="text" name="username"  placeholder="username" class="form-control" required="">
    <b>Password</b><input type="text" name="password"  placeholder="password" class="form-control" required="">
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
    <input type="submit" value="AddUser" class="btn btn-primary ">
    <br>
    </form>
  </body>
</html>
