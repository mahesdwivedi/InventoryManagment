<?php
require_once '../includes/functions.php';
require_once('../header.php');
loginCheck(LOGIN_REQUIRE);
require_once '../vendor/autoload.php';
error_reporting(E_ALL & ~E_NOTICE);
$sql="select * from product_detail where status= 'active' ";

$stmt= getPDO()->prepare($sql);
$stmt->execute([$product]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">DOC</th>
    </tr>
  </thead>
  <tbody>
<?php

foreach($result as $res){
  echo '<tr>';
      echo '<th scope="row">'.$res['id'].'</th>';
        echo '<td>'.$res['name'].'</td>';
        echo '<td>'.$res['description'].'</td>';
        echo '<td>'.$res['date_of_creation'].'</td>';
        echo '<td><a href="delete.php?'.'id='.$res['id'].'"<button type="button" class="btn btn-danger"><i class="fa fa-ban" ></i> Set Inactive</button></a>
                  <a href="read.php?'.'id='.$res['id'].'"<button type="button" class="btn btn-info"><i class="fa fa-eye"></i> Read</button></a></td>';
  echo '</tr>';
}

echo "</tbody></table>";
// var_dump($result);
require_once('../footer.php');
?>
