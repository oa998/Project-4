<?php
require_once('../headerSession.php'); 

		/**********************************************************
				Show all admin features
		***********************************************************/


	if(isset($_SESSION['level']) && strcmp($_SESSION['level'],"admin")==0){  //is admin user

        require_once('../mysqli_connect.php');  //get $dbc connection

        
        /***********************************************
                        PRINT INVENTORY
        ***********************************************/
        $query = "SELECT * FROM inventory";

        $response = @mysqli_query($dbc, $query);

        if($response){
            echo "<h2>Inventory</h2>";
            echo "<table id=\"inventory_list\">";
            echo "
                <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Keywords</th>
                <th>Image</th>
                <th>Modify</th>
                <th>DELETE</th>
                </tr>
                ";
    
            while($item = mysqli_fetch_array($response)){
                $item_id        = $item['ID'];
                $item_name      = $item['Name'];
                $item_price     = $item['Price'];
                $item_stock     = $item['Stock'];
                $item_keywords  = $item['Keywords'];
                $item_image     = $item['Image'];
                
                echo "
                    <tr>
                    <td><input type=\"text\" value=\"$item_id\" id=\"id$item_id\" size=\"3\" disabled></td>
                    <td><input type=\"text\" value=\"$item_name\" id=\"name$item_id\" size=\"30\"></td>
                    <td><input type=\"text\" value=\"$item_price\" id=\"price$item_id\" size=\"6\"></td>
                    <td><input type=\"text\" value=\"$item_stock\" id=\"stock$item_id\" size=\"6\"></td>
                    <td><input type=\"text\" value=\"$item_keywords\" id=\"keywords$item_id\" size=\"50\"></td>
                    <td><input type=\"text\" value=\"$item_image\" id='image$item_id'\" size=\"20\"></td>
                    <td><button onclick=\"modifyInventoryItem('id$item_id','name$item_id','price$item_id', 'stock$item_id','keywords$item_id','image$item_id', this)\">Save Changes</button></td>
                    <td><button onclick=\"deleteFromInventory('id$item_id', this)\" style=\"background-color:#ff9090\">Delete?</button></td>
                    </tr>
                    ";
            } //end of displaying inventory
            
            echo "
                <tr>
                <td><input type=\"text\" value=\"\" placeholder=\"ID\" id=\"idCustom\" size=\"3\"></td>
                <td><input type=\"text\" value=\"\" placeholder=\"NAME/TITLE\" id=\"nameCustom\" size=\"30\"></td>
                <td><input type=\"text\" value=\"\" placeholder=\"PRICE\" id=\"priceCustom\" size=\"6\"></td>
                <td><input type=\"text\" value=\"\" placeholder=\"STOCK\" id=\"stockCustom\" size=\"6\"></td>
                <td><input type=\"text\" value=\"\" placeholder=\"SEARCH KEYWORDS\" id=\"keywordsCustom\" size=\"50\"></td>
                <td><input type=\"text\" value=\"\" placeholder=\"IMAGE PATH\" id='imageCustom'\" size=\"20\"></td>
                <td><button onclick=\"createInventoryItem('idCustom','nameCustom','priceCustom','priceCustom','keywordsCustom','imageCustom', this)\" style=\"width:100%\">Create Item</button></td>
                <td><button style=\"background-color:transparent; width:100%; color:transparent;\" disabled>&nbsp</button></td>
                </tr>
                ";
            
            echo "</table>";
            echo "<p style=\"margin:0px\">(To add a new item to the inventory, must use an ID that is not already in-use)</p>";
            echo "<br><br><br>";

            if (mysqli_num_rows($response)==0) {

                //display message on empty set
                echo "<h2> Inventory is Empty. </h2>";

            } 
                    
        } else {
            
            echo "Couldn't issue database query for Inventory<br>";
            echo mysqli_error($dbc);

        }
        
        /***********************************************
                        PRINT USERS
        ***********************************************/
        $query = "SELECT * FROM users";

        $response = @mysqli_query($dbc, $query);

        if($response){
            echo "<h2>Registered Users</h2>";
            echo "<table id=\"user_list\">";
            echo "
                <tr>
                <th>Username</th>
                <th>Password</th>
                <th>Level</th>
                <th>Modify</th>
                <th>DELETE</th>
                </tr>
                ";
            $count = 1;
            while($item = mysqli_fetch_array($response)){
                $item_uname     = $item['Username'];
                $item_pword     = $item['Password'];
                $item_level     = $item['Level'];
                if(strcasecmp($item_uname,$_SESSION['username'])==0){
                    echo "
                        <tr>
                        <td><input type=\"text\" value=\"$item_uname\" id=\"un$count\" size=\"10\" disabled></td>
                        <td><input type=\"text\" value=\"$item_pword\" id=\"pw$count\" size=\"10\"></td>
                        <td><input type=\"text\" value=\"$item_level\" id=\"lvl$count\" size=\"6\" disabled></td>
                        <td><button onclick=\"modifyUser('un$count','pw$count','lvl$count',this)\">Save Changes</button></td>
                        <td><button style=\"background-color:transparent; color:gray; width:100%;\" disabled>self</button></td>
                        </tr>
                        ";
                } else {
                    echo "
                        <tr>
                        <td><input type=\"text\" value=\"$item_uname\" id=\"un$count\" size=\"10\" disabled></td>
                        <td><input type=\"password\" value=\"$item_pword\" id=\"pw$count\" size=\"10\" disabled></td>
                        <td><input type=\"text\" value=\"$item_level\" id=\"lvl$count\" size=\"6\"></td>
                        <td><button onclick=\"modifyUser('un$count','pw$count','lvl$count',this)\">Save Changes</button></td>
                        <td><button onclick=\"deleteUser('un$count',this)\" style=\"background-color:#ff9090\">Delete?</button></td>
                        </tr>
                        ";
                }
                $count+=1;
            } //end of displaying inventory
            echo "
                <tr>
                <td><input type=\"text\" value=\"\" placeholder=\"username\" id=\"unCustom\" size=\"10\"></td>
                <td><input type=\"text\" value=\"\" placeholder=\"password\" id=\"pwCustom\" size=\"10\"></td>
                <td><input type=\"text\" value=\"\" placeholder=\"accessLVL\" id=\"lvlCustom\" size=\"6\"></td>
                <td><button onclick=\"createUser('unCustom','pwCustom','lvlCustom',this)\" style=\"width:100%\">Create User</button></td>
                <td><button style=\"background-color:transparent; color:transparent; width:100%;\" disabled>&nbsp</button></td>
                </tr>
                ";
                        
            echo "</table>";
            echo "<p style=\"margin:0px\">(To create a new user, must use a username that is not already in-use.)</p>";
            echo "<br><br><br>";

            if (mysqli_num_rows($response)==0) {

                //display message on empty set
                echo "<h2> Users is Empty. </h2>";

            } 
                    
        } else {
            
            echo "Couldn't issue database query for Users<br>";
            echo mysqli_error($dbc);

        }
        
        /***********************************************
                        PRINT SALES SUMMARY
        ***********************************************/
        $query = "
            SELECT Username, SUM(Quantity) AS Items, SUM(Quantity * Price) AS Spent
            FROM  inventory, sales
            WHERE inventory.ID = sales.ItemID
            GROUP BY Username
            ";

        $response = @mysqli_query($dbc, $query);

        if($response){
            echo "<h2>Sales Summary</h2>";
            echo "<table id=\"sales_list\">";
            echo "
                <tr>
                <th>Username</th>
                <th>Items Bought</th>
                <th>Total Spent</th>
                </tr>
                ";
    
            while($item = mysqli_fetch_array($response)){
                $item_uname     = $item['Username'];
                $item_num_items = $item['Items'];
                $item_amt_spent = $item['Spent'];
                $item_amt_spent = sprintf("$%6.2f",$item_amt_spent);
                echo "
                    <tr>
                    <td><input type=\"text\" value=\"$item_uname\" size=\"10\"disabled></td>
                    <td><input type=\"text\" value=\"$item_num_items\" size=\"10\" disabled></td>
                    <td><input type=\"text\" value=\"$item_amt_spent\" size=\"10\" disabled></td>
                    </tr>
                    ";
            } //end of displaying inventory
            echo "</table>";
            echo "<br><br><br>";

            if (mysqli_num_rows($response)==0) {

                //display message on empty set
                echo "<h2> Sales is Empty. </h2>";

            } 
                    
        } else {
            
            echo "Couldn't issue database query for Sales<br>";
            echo mysqli_error($dbc);

        }
        

      mysqli_close($dbc);

    } else {

        echo "<h2> Must be administrator to view this page. </h2>";

    }
?>
        