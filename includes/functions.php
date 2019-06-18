<?php session_start();
define("LOGIN_REQUIRE", 1);
define("LOGIN_NOT_REQUIRE", 2);

define("PDO_DSN", 'mysql:host=localhost;dbname=inventory;');
define("PDO_USERNAME", 'root');
define("PDO_PASSWORD", '');

define('ENVIRONMENT', 'dev');

if (ENVIRONMENT == 'dev') {
  error_reporting(E_ALL);
} elseif (ENVIRONMENT == 'prod') {
  error_reporting(0);
}

/**
* Method to get instance of pdo .
* It is a single tone instance
*
* @Arguments: void
*
* @Returns: pdo instance
*/
function getPDO() {
  static $pdo = null;
  if (is_null($pdo)) {
    $pdo = new PDO(PDO_DSN, PDO_USERNAME, PDO_PASSWORD);
    if (ENVIRONMENT == 'dev') {
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
  }
  return $pdo;
}

function loginCheck($require=LOGIN_REQUIRE) {
  if ($require == LOGIN_REQUIRE) {
    if(!isset($_SESSION["login_user"] )){
      header("Location:login.php");
      exit;
    }
  }
  // if ($require == LOGIN_NOT_REQUIRE) {
  //   if(isset($_SESSION["login_user"] )){
  //     header("Location:test.php");
  //     exit;
  //   }
  // }
}
?>
