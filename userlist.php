<?php
require_once 'includes/functions.php';
require_once('header.php');
loginCheck(LOGIN_REQUIRE);
require_once __DIR__ . '/vendor/autoload.php';
error_reporting(E_ALL & ~E_NOTICE);
$sql="select * from user_detail ";

$stmt= getPDO()->prepare($sql);
$stmt->execute([$product]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<button type="button" class="btn btn-primary">Add New User</button>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Emp ID</th>
      <th scope="col">Name</th>
      <th scope="col">Role</th>
      <th scope="col">Responsibility</th>

    </tr>
  </thead>
  <tbody>
<?php

foreach($result as $res){
  echo '<tr>';
      echo '<th scope="row">'.$res['emp_id'].'</th>';
        echo '<td>'.$res['firstname'].' '.$res['lastname'].'</td>';
        echo '<td>'.$res['role'].'</td>';
        echo '<td>'.$res['responsibility'].'</td>';
        echo '<td><button type="button" class="btn btn-danger">Delete</button>
<button type="button" class="btn btn-warning">Update</button>
<button type="button" class="btn btn-info">Read</button></td>';
        echo '</tr>';
}

echo "</tbody></table>";
// var_dump($result);
require_once('footer.php');
?>
