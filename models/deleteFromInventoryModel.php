<?php
require_once('../headerSession.php');

require_once('../mysqli_connect.php');  //get $dbc connection
$item_id        = $_POST['itemID'];

$query = 
    "
    DELETE FROM inventory WHERE ID=$item_id  
    ";

$response = @mysqli_query($dbc, $query);

if($response){
    echo "Gone";
}

?>