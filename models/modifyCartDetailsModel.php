<?php
require_once('../headerSession.php');
if(isset($_POST['change'])){
    require_once('../mysqli_connect.php');  //get $dbc connection
    $username = $_SESSION['username'];
    $modify_amount = $_POST['change'];
    $item_id = $_POST['item'];
    
    $query = "
    UPDATE cart c 
    SET c.Quantity = c.Quantity+".$modify_amount."
    WHERE c.Username='".$username."' 
    AND c.ItemID=".$item_id; 
    
    $response = @mysqli_query($dbc, $query);
}
?>