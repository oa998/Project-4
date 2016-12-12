<?php
require_once('../headerSession.php');

require_once('../mysqli_connect.php');  //get $dbc connection
$item_id        = $_POST['itemID'];
$item_name      = $_POST['itemName'];
$item_price     = $_POST['itemPrice'];
$item_stock     = $_POST['itemStock'];
$item_keywords  = $_POST['itemKeywords'];
$item_image     = $_POST['itemImage'];

$query = 
    "
    INSERT INTO inventory (ID, Name, Price, Stock, Keywords, Image) 
    VALUES ($item_id,'".$item_name."',$item_price,$item_stock,'".$item_keywords."','".$item_image."')  
    ";


$response = @mysqli_query($dbc, $query);
if($response){
    echo "Success!";
}

?>