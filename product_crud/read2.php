<?php
require_once '../header.php';
require_once '../includes/functions.php';
loginCheck(LOGIN_REQUIRE);
$prodId=$_GET['id'];
$obj = new Read($prodId);
$obj->getData();
$obj->showData();
class Read
{
    public $ID="";
    public $RESULT;

    public function __construct($par)
    {
        $this->ID=$par;
    }

    public function getData()
    {
        $sql="select * from product_detail where id= ?";
        $stmt= getPDO()->prepare($sql);
        $stmt->execute([$this->ID]);
        $this->RESULT = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function showData()
    {
        print_r("Id:".$this->RESULT[0]['id'].'<br>');
        print_r("name: ".$this->RESULT[0]['name'].'<br>');
        print_r("description: ".$this->RESULT[0]['description'].'<br>');
        print_r("sku: ".$this->RESULT[0]['sku'].'<br>');
        print_r("color_id: ".$this->RESULT[0]['color_id'].'<br>');
        print_r("minimum_qty: ".$this->RESULT[0]['minimum_qty'].'<br>');
        print_r("date_of_creation: ".$this->RESULT[0]['date_of_creation'].'<br>');
        print_r("status: ".$this->RESULT[0]['status'].'<br>');
    }
}
