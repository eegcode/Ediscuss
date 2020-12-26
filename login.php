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

  $sql = "SELECT * FROM users WHERE username='$username'";
  $result = mysqli_query($conn, $sql);

  if(!mysqli_num_rows($result)){
    // echo "User not found";
    echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Invalid Username ! </strong>There is no account with such username.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
  }else{
    $row = mysqli_fetch_assoc($result);
    if(!password_verify($password, $row["password"])){
      // echo "password did not match";
      echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Invalid Password ! </strong>The password you entered is incorrect. Please try again.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }else{
      // echo "logged in SUCCESS";
      echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Congratulations ! </strong>You are logged in succesfully. Now you get access to all features here.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      session_start();
      $_SESSION["username"] = $username;
      $_SESSION["loggedin"] = true;

      $sql = "SELECT * FROM users where username='$username'";
      $result = mysqli_query($conn, $sql);
      if(!$result){
        // echo "error occured while fetching user data from database";
        echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>ERROE ! </strong> Unable to connect to database. Please try again later.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      }else{
        $row = mysqli_fetch_assoc($result);
        $user_id = $row["user_id"];
        $_SESSION["user_id"] = $user_id;
        header("location: index.php");
      }
      
    }
  }

}
echo '
        <form class="container w-100 px-5 pb-4 rounded mt-5" method="post" action="login.php" style="max-width:600px; background:hsla(0,0%,0%,.2)">
        <h1 class="pt-3 mb-3">Log In</h1>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required autocomplete="false">
          </div>
          <button type="submit" class="btn btn-primary">Log in</button>
          <p class="mt-4">Don\'t have an account? Click here to <a href="signup.php">Create a new account</a></p>
        </form>

      ';
?>


<script src="js/jquery.js"></script>

    <!-- <script src="js/bootstrap.min.js"></script> -->
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>