<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>E-Discuss</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- <link rel="stylesheet" href="css/bootstrap.min.css.map"> -->
	</head>
	<body>

<?php
include("partials/_nav.php");
include("partials/_dbconnect.php");
if($_SERVER["REQUEST_METHOD"] === "POST"){
  $username = $_POST["username"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];

  $sql = "SELECT * from users WHERE username='$username'";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result  ) > 0){
    echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
			  <strong>ERROR ! </strong> The username alredy exists. Please choose an unique username.
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>';
  }else{
    if($cpassword !== $password){
    echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
			  <strong>ERROR ! </strong> The Password does not match with each other.
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>';
    }else{
      $hashpw = password_hash($password, PASSWORD_DEFAULT);

      $sql = "INSERT INTO users (username, password) VALUES('$username', '$hashpw')";
      $result = mysqli_query($conn, $sql);
      
      if(!$result){
        // echo "error while sending data to database";
        echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
			  <strong>ERROR ! </strong> Sorry! Some error occured. Please try again later.
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>';
      }else{
        // echo "";
        header("location: login.php");
      }
    }
  } 
}

// header('Location: #?signup');
echo '
<form class="container w-100 px-5 pb-4 rounded mt-5" method="post" action="signup.php" style="max-width:600px; background:hsla(0,0%,0%,.2)">
<h1 class="pt-3 mb-3">Sign Up</h1>
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" required>
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" id="password" placeholder="Password" name="password" required autocomplete="false">
		</div>
		<div class="form-group">
			<label for="cpassword">Confirm Password</label>
			<input type="password" class="form-control" id="cpassword" placeholder="Password" name="cpassword" required autocomplete="false">
			<small id="cpasswordHelp" class="form-text"></small>
		</div>
		<button type="submit" class="btn btn-primary">Sign up</button>
		<p class="mt-4">Already created an account? Click here to <a href="login.php">Log in</a></p>
	</form>
	';
?>


<script src="js/jquery.js"></script>
<script src="js/signup.js"></script>

		<!-- <script src="js/bootstrap.min.js"></script> -->
		<script src="js/bootstrap.bundle.min.js"></script>
	</body>
</html>