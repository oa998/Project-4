<?php
require_once('../headerSession.php');

require_once('../mysqli_connect.php');  //get $dbc connection
$username = $_POST['username'];
$item_id = $_POST['item'];

$query = 
    "
    INSERT INTO cart (Username, ItemID, Quantity) 
    VALUES ('".$username."',$item_id,1)  
    ON DUPLICATE KEY 
      UPDATE Quantity = 1
    ";


$response = @mysqli_query($dbc, $query);

?>