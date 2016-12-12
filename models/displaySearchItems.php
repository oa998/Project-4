
<?php
    require_once('../headerSession.php');
		/**********************************************************
				Search the inventory table for words in the search 
				bar from the main display page.
		***********************************************************/


	if(isset($_POST['keyword'])){

		if(empty($_POST['keyword'])){

		  //do nothing, dont search empty strings

		}else{

			$search_term_phrase = trim($_POST['keyword']);

		}

		if($search_term_phrase){
			//echo "<div id='99' class='col-lg-4 forsale'>Issuing query</div>";
			require_once('../mysqli_connect.php');  //get $dbc connection
			$all_terms = explode(" ",$search_term_phrase);

			$query = "SELECT * FROM inventory 
								WHERE 
								Name LIKE '%search_term_phrase%' OR 
								Keywords LIKE '%search_term_phrase%' ";


			foreach($all_terms as $term){
				if(trim($term)!="")
						$query .= "OR Name LIKE '%$term%' OR Keywords LIKE '%$term%' ";
			}
			$response = @mysqli_query($dbc, $query);

			//Paging logic

			//end paging


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

					if($item_stock!=0){
					//use bootstrap to auto-format results
				  	echo "<div id='$_id' class='col-lg-4 sale_product'>
								<p class='item_title'>$item_name</p>
								<img src=$item_image class='img_product'>
								<div class='item_info'>
										$item_price 
										Stock: $item_stock<br>
										<button id='$item_id' class='cart_button' onclick='insertIntoCart(\"$user_name\",$item_id, this)' title='Log In to add to cart'></button>
				  		  </div>
				  		  </div>";  
				  } else {
				  	echo "<div id='$_id' class='col-lg-4 sale_product'>
								<p class='item_title'>$item_name</p>
								<img src=$item_image class='img_product' onclick='viewProductPage($item_id)'>
								<div class='item_info'>
										$item_price 
										Stock: $item_stock<br>
										<button id='$item_id' class='cart_button sold_out'>sold out</button>
				  		  </div>
				  		  </div>";
				  }

				}
				
				if (mysqli_num_rows($response)==0) {

				//display message on empty set
				echo "<h2> &nbsp&nbsp No results found for that search.</h2>";

				}
	
			} else {

				echo "Couldn't issue database query<br>";
				echo mysqli_error($dbc);

			}

		  mysqli_close($dbc);

		}else{

			echo 'Input not valid.';
			
		}
	}
?>