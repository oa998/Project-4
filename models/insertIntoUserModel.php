<?php
require_once('../headerSession.php');

require_once('../mysqli_connect.php');  //get $dbc connection
$username   = $_POST['user_name'];
$password   = $_POST['pass_word'];
$level      = $_POST['access_lvl'];

$query = 
    "
    INSERT INTO users (Username, Password, Level) 
    VALUES ('".$username."','".$password."','".$level."')  
    ";


$response = @mysqli_query($dbc, $query);
if($response){
    echo "Success!";
}

?>