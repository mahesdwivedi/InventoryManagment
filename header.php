<!DOCTYPE html>
<html lang="" dir="ltr">
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link rel = "stylesheet"
   type = "text/css"
   href = "assest/css/main.css" />
    <title> My Inventory</title>
  </head>
  <body>

    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">
          Inventoy
          </a>

        </div>
        <ul class="nav navbar-nav navbar-right">
          <?php if( isset($_SESSION["login_user"])) {?>
              <li><a href="/inventory/logout.php">Logout</a></li>
          <?php } else { ?>
            <li><a href="/inventory/login.php">LogIn</a></li>
        <?php } ?>
      </ul>
      </div>
    </nav>
<div class="container">
