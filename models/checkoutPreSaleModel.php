<?php
    require_once('../headerSession.php');

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
            while($item = mysqli_fetch_array($response)){
                $subtotal += $item['Price'] * $item['Quantity'];
                $num_items += $item['Quantity'];
            }
        
            $taxes = $subtotal * $tax_rate;
            $grand_total = $taxes + $subtotal;

            echo "
                <div id='cc_imgs' class='col-lg-4'>
                    <img src=\"http://www.fancyicons.com/free-icons/101/credit-cards/png/256/visa_256.png\"  id=\"visa\"><br>
                    <img src=\"http://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/American-Express-icon.png\" id=\"amex\"><br>
                    <img src=\"https://passportcandles.com/wp-content/uploads/2016/10/discover.png\" id=\"disc\"><br>
                    <img src=\"http://iboothoc.com/wp-content/uploads/mastercard_256.png\" id=\"mast\"><br>
                </div>
                
                <div id='sale_options' class='col-lg-5 payment_info'>
                
                <p class=\"pay_label\">Delivery Name: </p> 
                <input type=\"text\" size=\"25\" placeholder=\"Name for address\">
                <br><br>
                <p class=\"pay_label\">Street Address:</p> 
                <input type=\"text\" size=\"25\" placeholder=\"12 Street Avenue\"><br>
                <input type=\"text\" size=\"25\" placeholder=\"\">
                <br><br>
                <p class=\"pay_label\">Apartment Number:</p> 
                <input type=\"number\" size=\"1\" placeholder=\"113\" min=\"0\" max=\"999\">
                <br><br>
                <p class=\"pay_label\">City:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                &nbsp&nbsp&nbsp&nbsp&nbspState:&nbsp&nbsp&nbsp&nbspZip: </p> 
                <input type=\"text\" size=\"10\">
                    <select name=\"state\" size=\"1\">
                      <option value=\"AK\">AK</option>
                      <option value=\"AL\">AL</option>
                      <option value=\"AR\">AR</option>
                      <option value=\"AZ\">AZ</option>
                      <option value=\"CA\">CA</option>
                      <option value=\"CO\">CO</option>
                      <option value=\"CT\">CT</option>
                      <option value=\"DC\">DC</option>
                      <option value=\"DE\">DE</option>
                      <option value=\"FL\">FL</option>
                      <option value=\"GA\">GA</option>
                      <option value=\"HI\">HI</option>
                      <option value=\"IA\">IA</option>
                      <option value=\"ID\">ID</option>
                      <option value=\"IL\">IL</option>
                      <option value=\"IN\">IN</option>
                      <option value=\"KS\">KS</option>
                      <option value=\"KY\">KY</option>
                      <option value=\"LA\">LA</option>
                      <option value=\"MA\">MA</option>
                      <option value=\"MD\">MD</option>
                      <option value=\"ME\">ME</option>
                      <option value=\"MI\">MI</option>
                      <option value=\"MN\">MN</option>
                      <option value=\"MO\">MO</option>
                      <option value=\"MS\">MS</option>
                      <option value=\"MT\">MT</option>
                      <option value=\"NC\">NC</option>
                      <option value=\"ND\">ND</option>
                      <option value=\"NE\">NE</option>
                      <option value=\"NH\">NH</option>
                      <option value=\"NJ\">NJ</option>
                      <option value=\"NM\">NM</option>
                      <option value=\"NV\">NV</option>
                      <option value=\"NY\">NY</option>
                      <option value=\"OH\">OH</option>
                      <option value=\"OK\">OK</option>
                      <option value=\"OR\">OR</option>
                      <option value=\"PA\">PA</option>
                      <option value=\"RI\">RI</option>
                      <option value=\"SC\">SC</option>
                      <option value=\"SD\">SD</option>
                      <option value=\"TN\">TN</option>
                      <option value=\"TX\">TX</option>
                      <option value=\"UT\">UT</option>
                      <option value=\"VA\">VA</option>
                      <option value=\"VT\">VT</option>
                      <option value=\"WA\">WA</option>
                      <option value=\"WI\">WI</option>
                      <option value=\"WV\">WV</option>
                      <option value=\"WY\">WY</option>
                    </select>
                <input type=\"number\" size=\"2\" placeholder=\"55044\" min=\"0\" max=\"99999\">
                <br><br>
                
                
                <p class=\"pay_label\">Credit Card Number:</p> 
                <input type=\"number\" size=\"25\" placeholder=\"1111222233334444\" id=\"cc_num\">
                <br><br>
                <p class=\"pay_label\">CVN (Verification Number):</p> 
                <input type=\"number\" size=\"1\" placeholder=\"345\" min=\"0\" max=\"999\">
                <br><br>
                <p class=\"pay_label\">Full Name: </p> 
                <input type=\"text\" size=\"25\" placeholder=\"Exactly as typed on card\">
                <br><br>
                <p class=\"pay_label\">Expiration (Month / Year): </p> 
                <input type=\"number\" size=\"1\" min=\"1\" max=\"12\" value=\"1\">
                <a style=\"pointer-events: none; color: black;\">&nbsp&nbsp/ 20</a>
                <input type=\"number\" size=\"1\" min=\"16\" max=\"99\" value=\"16\">
                <button id=\"purchase\" onclick=\"makePayment()\">Submit Payment</button>
                </div>";
            
            echo 
                "<div id='receipt'>
                <table id='receipt_details'>
                    <tr><th></th><th></th></tr>
                    <tr>
                      <td align='left'>Number of Items:</td>
                      <td align='right'>".sprintf("%-3d",$num_items)."</td>
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
                <button onclick=\"window.location.assign('/phpFrame/cart.php')\">Back to Cart</button>
                <br><br><br><br>
                <input type=\"text\" size=\"23\" placeholder=\" Input Discount Code\" id=\"code_input\">
                <button onclick=\"checkCode('code_input')\">Apply Code to Cart</button>

                </div></div>";

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