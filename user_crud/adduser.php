<?php require_once '../header.php';
      require_once '../includes/functions.php';
      $target = "/opt/lampp/htdocs/inventory/assest/image/";
      loginCheck(LOGIN_REQUIRE);

      if ($_POST) {
          try {
              $sql='INSERT INTO user_detail(emp_id,firstname,lastname,email,username,password,role)
              VALUES('.$_POST['empid'].',
              "'.$_POST['firstname'].'",
              "'.$_POST['lastname'].'",
              "'.$_POST['email'].'",
              "'.$_POST['username'].'",
              "'.$_POST['password'].'",
              '.$_POST['role'].');';
              getPDO()->exec($sql);

              header("Location:userlist.php");
          } catch (Exception $e) {
              echo $e;
          }

          $target = $target . basename($_FILES['Filename']['name']);
          $Filename=basename($_FILES['Filename']['name']);
          if (move_uploaded_file($_FILES['Filename']['tmp_name'], $target)) {
              $sql='UPDATE user_detail
   SET image = ?
   WHERE username= ?;';
              $stmt= getPDO()->prepare($sql);
              $stmt->execute([$Filename,$_POST['username']]);
              exit;
              echo $_POST['username'];
          } else {
              echo "Move upload seems to be struct !" ;
          }
          // echo $target;
          // echo "-------";
          // echo $Filename;
          exit;
      }
 ?>
 <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="adduser.php" method="post"class="form-group" enctype="multipart/form-data">
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
      foreach ($result as $res) {
          ?>
      <option value= "<?php print_r($res['id']) ?>"><?php print_r($res['name']) ?></option>
    <?php
      } ?>
    </select>
  </div>
    <b>image</b>
    <input type="file" name="Filename">
    <input TYPE="submit" value="Add user" class="btn btn-primary ">
    <br>
    </form>
  </body>
</html>
