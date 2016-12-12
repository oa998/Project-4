<?php
    require_once('../headerSession.php'); 

		/**********************************************************
				Search the user's cart table for items and display
                them in the search area
		***********************************************************/

	if(isset($_SESSION['username'])){
        $tax_rate = 0.08;
        require_once('../mysqli_connect.php');  //get $dbc connection
        $username = $_SESSION['username'];

        $query = "SELECT * from inventory i, cart c 
                  WHERE '".$username."'=c.Username 
                  AND 
                  c.ItemID = i.ID
                  AND 
                  c.Quantity>0";

        $response = @mysqli_query($dbc, $query);

        if($response){
            
            $subtotal = 0.00;
            $num_items = 0;
            echo "<div id='items_column'>";  //hold items
            $r=0;
            $c=0;
            while($item = mysqli_fetch_array($response)){
                $subtotal += $item['Price'] * $item['Quantity'];
                $num_items += $item['Quantity'];
 
                $item_name = substr($item['Name'], 0, 22);
                $item_image = $item['Image'];
                $item_price = '$'.$item['Price'];
                $item_stock = $item['Stock'];
                $item_id = $item['ID'];
                $num_in_cart = $item['Quantity'];
                
                if($c==2 ){
                    $_id = "$r$c";
                    echo "<div id='$_id' class='col-lg-4 sale_product'></div>";
                    $c+=1;
                }
                
                if($c>2){
                    $r+=1;
                    $c=0;
                }
                $_id = "$r$c";
                //use bootstrap to auto-format results
                echo "<div id='$_id' class='col-lg-4 sale_product'>
                            <p class='item_title'>$item_name</p>
                            <img src=$item_image class='img_product' onclick='viewProductPage($item_id)'>
                            <div class='item_info'>
                                    $item_price 
                                    Stock: <span id='stock$item_id'>$item_stock</span><br>
                                    <button id='minus$item_id' class='modify_qty' onclick='reduceOrder(\"$username\",$item_id)'>&minus;</button>
                                    &nbsp
                                    <a id='cart$item_id'> $num_in_cart</a>&nbsp&nbsp&nbsp<button id='add$item_id' class='modify_qty' onclick='increaseOrder(\"$username\",$item_id)'>+</button>
                                    
                      </div>
                      </div>";  
                
                $c+=1;

            }
        
            $taxes = $subtotal * $tax_rate;
            $grand_total = $taxes + $subtotal;
            //echo "</div>"; //end items_column
                        
            echo 
                "<div id='receipt'>
                <table id='receipt_details'>
                    <tr><th></th><th></th></tr>
                    <tr>
                      <td align='left'>Number of Items:</td>
                      <td id=\"item_count\"align='right'>".sprintf("%-3d",$num_items)."</td>
                    </tr>
                    <tr>
                      <td align='left'>Subtotal:</td>
                      <td align='right'>".sprintf("%-6.2f",$subtotal)."</td>
                    </tr>
                    <tr>
                      <td align='left'>Taxes:</td>
                      <td align='right'>".sprintf("%-6.2f",$taxes)."</td>
                    </tr>
                </table>
                <br><hr><hr>
                ".sprintf("Cart Total: $%6.2f",$grand_total)."
                <br><br>                
                <button onclick=\"location.reload(true)\">Update Changes</button>
                <br><br>
                <button id=\"to_checkout\" onclick=\"checkout()\">Checkout</button>
                </div>
                </div>";

            if (mysqli_num_rows($response)==0) {

                //display message on empty set
                echo "<h2> &nbsp&nbsp You haven't added any items to your cart yet.</h2>";

            } 
        } else {
            
            echo "Couldn't issue database query<br>";
            echo mysqli_error($dbc);

        }

      mysqli_close($dbc);

    } else {

        echo "<h2> &nbsp&nbsp Log in to access your cart!</h2>";

    }
?>
        
