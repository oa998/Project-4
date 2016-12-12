<?php
require_once('../headerSession.php');

require_once('../mysqli_connect.php');  //get $dbc connection
$username        = $_POST['user_name'];

$query = 
    "
    DELETE FROM users WHERE Username='".$username."'  
    ";

$response = @mysqli_query($dbc, $query);

if($response){
    echo "Gone";
}

?>