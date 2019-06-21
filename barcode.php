<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
// $barcode = $generator->getBarcode($_SESSION['barcode'], $generator::TYPE_CODE_128);
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <script type="text/javascript">
    function printcode(){
    var print_div = document.getElementById("code");
    var print_area = window.open();
    print_area.document.write(print_div.innerHTML);
    print_area.document.close();
    print_area.focus();
    print_area.print();
    print_area.close();
    }
    </script>
    <div id='code'><?php echo '<img src="data:image/png;base64,' .
    base64_encode($generator->getBarcode($_SESSION['barcode'], $generator::TYPE_CODE_128)) . '">'; ?></div>
    <div class="">
      wdsdsdsdsds
    </div>
    <div class="">
      dsanudunnda
    </div>
    <form>
    <input type="button" value="Print" onclick="printcode()">
  </form>
  </body>
</html>
