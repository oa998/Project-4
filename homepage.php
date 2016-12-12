<?php require_once('headerSession.php'); ?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Thirty First</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="../homepage.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    

</head>
<body>
	<br>
  <div class="container-fluid header" id="headDiv">
  	<p class="banner text-nowrap text-center" onclick="window.location.assign('/homepage.php')">ThirtyFirst</p>
  	<div id="login_div">
  	<?php
        if(isset($_SESSION['username']) ){
            if( strcmp($_SESSION['level'],"cust")!=0){  
                echo "<div>".$_SESSION['username']."</div>
				    <button onclick='showAdmin()'>Admin Options</button>
				    <button onclick='logOut()'>Log Out</button>"; 

            } else {
                echo "<div class='loggedIn'>Welcome Back!</div>
			         <div class='loggedIn'>".$_SESSION['username']."</div>
                     <button onclick='logOut()'>Log Out</button>";
            }
        }else{
  			echo "
		  	   <input type='text' name='user_name' value='username' size=20><br>
		  	   <input type='password' name='pass_word' value='password' size=20 id='password_text'><br>
		  	   <button onclick='logIn()' id='log_in_button'>Log In</button>
               ";
	   }
    ?>
  	</div>
  </div>
  <div class='options'>
  	<button class='col-lg-3 hov' onclick="slideProducts()">Product Categories</button>
  	<div id='toggleCategories'>
  		<div class='hov dropdown'onclick="searchTerms('costume')">Costumes</div>
  		<div class='hov dropdown' onclick="searchTerms('decoration')">Decorations</div>
  		<div class='hov dropdown' onclick="searchTerms('cosmetic')">Cosmetics</div>
  	</div>
  	<button class='col-lg-3 hov' onclick='showPopular()'>Popular Items</button>
  	<button class='col-lg-3 hov' onclick='showCheap()'>Sale Items</button>
  	<button class='col-lg-3 hov' onclick='showCart()'>View Cart</button>
  </div>
  <div class="search">
	  <div>
		  <input type="text" id="search_terms" value="Search Terms" size=65 style="padding-left: 10px;">
		  <button onclick="searchButton('search_terms')" id='search_button'>Search</button>
		</div>
  </div>
  <input type="hidden" id="first_visit" value="no">
  <div class="container salesfloor">
  	<div id="results_here" class="row" page="new">
  	</div>
  </div>
  <?php
    $current_page = $_SERVER['PHP_SELF'];
    echo "<script src=\"../jsControllers/defaultController.js\"></script>";
    switch($current_page){
        case '/homepage.php':
            echo "
                <script src=\"./jsControllers/homepageController.js\"></script>
                ";
            break;
        case '/phpFrame/cart.php':
            echo "
                <script src=\"../jsControllers/cartController.js\"></script>
                ";
            break;
        case '/phpFrame/admin.php':
            echo "
                <script src=\"../jsControllers/adminController.js\"></script>
                ";
            break;
        case '/phpFrame/sales.php':
            echo "
                <script src=\"../jsControllers/salesController.js\"></script>
                ";
            break;
        case '/phpFrame/popular.php':
            echo "
                <script src=\"../jsControllers/popularController.js\"></script>
                ";
            break;
        case '/phpFrame/checkout.php':
            echo "
                <script src=\"../jsControllers/checkoutController.js\"></script>
                ";
            break;
    } 
    echo "</body></html>";
  ?>