<?php
    require_once('../headerSession.php'); 

		/**********************************************************
				Show all items with fewer than 10 remaining stock
		***********************************************************/
    require_once('../mysqli_connect.php');  //get $dbc connection
    
    $query = "SELECT * FROM inventory WHERE Price < 40 AND Stock > 0 ORDER BY Price";
    
    $response = @mysqli_query($dbc, $query);
    
    if($response){
        $r=0;
        $c=0;
        while($item = mysqli_fetch_array($response)){
            $_id = "$r$c";		//give each div a unique ID in case I want to give css/js later
            $c+=1;
            if($c>2){
                $r+=1;
                $c=0;
            }
            $item_name = substr($item['Name'], 0, 22);
            $item_image = $item['Image'];
            $item_price = '$'.$item['Price'];
            $item_stock = $item['Stock'];
            $item_keywords = $item['Keywords'];
            $item_id = $item['ID'];
            $user_name = isset($_SESSION['username'])?$_SESSION['username']:"none";

            echo "<div id='$_id' class='col-lg-4 sale_product'>
                    <p class='item_title'>$item_name</p>
                    <img src=$item_image class='img_product'>
                    <div class='item_info'>
                            $item_price 
                            Stock: $item_stock<br>
                            <button id='$item_id' class='cart_button' onclick='insertIntoCart(\"$user_name\",$item_id, this)' title='Log In to add to cart'></button>
                    </div>
                  </div>";  

        }

        if (mysqli_num_rows($response)==0) {

        echo "<h2> &nbsp&nbsp No popular items at this time.</h2>";

        }

    } else {

        echo "Couldn't issue database query<br>";
        echo mysqli_error($dbc);

    }

  mysqli_close($dbc);
?>