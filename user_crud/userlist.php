<?php
require_once '../includes/functions.php';
require_once('../header.php');
loginCheck(LOGIN_REQUIRE);
require_once '../vendor/autoload.php';
error_reporting(E_ALL & ~E_NOTICE);
$sql="select * from user_detail ";

$stmt= getPDO()->prepare($sql);
$stmt->execute([$product]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<a href="adduser.php"><button type="button" class="btn btn-primary">Add User <i class="fa fa-user-plus"></i></button></a>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Emp ID</th>
      <th scope="col">Name</th>
      <th scope="col">Role</th>

    </tr>
  </thead>
  <tbody>
<?php

foreach($result as $res){
  echo '<tr>';
      echo '<th scope="row">'.$res['emp_id'].'</th>';
        echo '<td>'.$res['firstname'].' '.$res['lastname'].'</td>';
        echo '<td>'.$res['role'].'</td>';
        echo '<td><a href="delete.php?'.'id='.$res['id'].'"<button type="button" class="btn btn-danger"><i class="fa fa-trash" ></i> Delete</button></a>
                  <a href="update.php?'.'id='.$res['id'].'"<button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i> Update</button></a>
                  <a href="read.php?'.'id='.$res['id'].'"<button type="button" class="btn btn-info"><i class="fa fa-eye"></i> Read</button></a></td>';
  echo '</tr>';
}

echo "</tbody></table>";
// var_dump($result);
require_once('../footer.php');
?>
