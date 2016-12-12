
<?php

		/**********************************************************
				Search the Users table and confirm if the username
				provided and password are correct
		***********************************************************/
	require_once('../headerSession.php'); //keep the session alive

	if( isset($_POST['username']) && isset($_POST['password']) ){

		$username_given = $_POST['username'];
		$password_given = $_POST['password'];

		if($username_given){  		//not sure if this test is really needed
			require_once('../mysqli_connect.php');  	 //get $dbc connection

			$query = "SELECT * FROM users 
								WHERE 
								Username = '$username_given' AND 
								Password = '$password_given' ";

			$response = @mysqli_query($dbc, $query);

			if($response && mysqli_num_rows($response)==1){
		
				$item = mysqli_fetch_array($response);
				$_SESSION['username'] = $username_given;
				$_SESSION['level'] = $item['Level'];

				if( strcmp($_SESSION['level'],"cust")!=0){  //will return FALSE if substring not contained.  does NOT return '-1'

					echo "<div>".$_SESSION['username']."</div>
								<button onclick='showAdmin()'>Admin Options</div>
								<button onclick='logOut()'>Log Out</button>"; 

				} else {

					echo "<div class='loggedIn'>Welcome Back!</div>
								<div class='loggedIn'>".$_SESSION['username']."</div>
								<button onclick='logOut()'>Log Out</button>";
				}
			} else {

				//if no valid match is found in database, assume the password is incorrect
				echo "<input type='text' name='user_name' value='$username_given' size=20><br>
  						<input type='password' name='pass_word' value='' style='background-color: red' size=20 id='password_text'><br>
							<button onclick='logIn()' id='log_in_button'>Log In</button>";
			} 
		}
		  mysqli_close($dbc);

	} else {

		//if the username or password were not passed in the POST
		echo "<input type='text' name='user_name' value='username' size=20><br>
  				<input type='password' name='pass_word' value='password' style='background-color: darkred' size=20 id='password_text'><br>
					<button onclick='logIn()' id='log_in_button'>Log In</button>";

	}
?>