<?php
require_once('../headerSession.php'); 

		/**********************************************************
				Take all items in user's cart, buy them.  Put the 
                correct data into the sales table, remove them 
                from cart table, adjust inventory, return success. 
		***********************************************************/


	if(isset($_SESSION['username'])){
        $tax_rate = 0.08;
        require_once('../mysqli_connect.php');  //get $dbc connection
        $username = $_SESSION['username'];

        /************************
        * Get all items in 
        * cart for this user.
        * Store them in array as
        * "itemID" => "qtyToBuy".
        ************************/
        
        $query = "SELECT * from inventory i, cart c 
                  WHERE '".$username."'=c.Username 
                  AND 
                  c.ItemID = i.ID
                  AND 
                  c.Quantity>0";

        $response = @mysqli_query($dbc, $query);
        $items_bought = array();
        if($response){
            while($item = mysqli_fetch_array($response)){
                $item_id = $item['ID'];
                $num_in_cart = $item['Quantity'];
                $items_bought[$item_id] = $num_in_cart;
            }
 
            if (mysqli_num_rows($response)==0) {

                //display message on empty set
                echo "<h2> &nbsp&nbsp Your cart is empty.</h2>";

            } 
        } else {
            
            echo "Couldn't issue database query<br>";
            echo mysqli_error($dbc);

        }
        
        foreach($items_bought as $ID => $QTY){
            $query = "
                INSERT INTO sales (Username, ItemID, Quantity) 
                VALUES ('".$username."',$ID,$QTY)
                ON DUPLICATE KEY UPDATE
                Quantity=Quantity+$QTY               
                ";
            $response = @mysqli_query($dbc, $query);        
            $query = "
                UPDATE inventory
                SET Stock=Stock-$QTY
                WHERE ID=$ID               
                ";
            $response = @mysqli_query($dbc, $query);
        }
        
        if($response) {
            $query = "
                DELETE FROM cart 
                WHERE Username='".$username."'
                ";
            $response = @mysqli_query($dbc, $query);
        }
        echo "<div id='sold' class='col-lg-12'> Thanks for your patrionage!  Your order should be delivered soon! <br> Your order number is 3983e-8er32-zwrr1.<br>Hope your Halloween is safe and fun!!</div><div id='fun_pic' class='col-lg-12'><img src=\"http://www.costumepop.com/wp-content/uploads/2010/08/crazy-beetlejuice-movie-costume.jpg\"></div>";
      mysqli_close($dbc);

    } else {

        echo "<h2> &nbsp&nbsp Log in to access your cart!</h2>";

    }
?>
        
