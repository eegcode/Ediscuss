<?php
include("_dbconnect.php");
$headerloc = 
if($_SERVER["REQUEST_METHOD"] === "POST"){
  $username = $_POST["username"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];

  $sql = "SELECT * from users WHERE username='$username'";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result  ) > 0){
    echo "username already exists";
  }else{
    if($cpassword !== $password){
    echo "passwords donot match";
    }else{
      $hashpw = password_hash($password, PASSWORD_DEFAULT);

      $sql = "INSERT INTO users (username, password) VALUES('$username', '$hashpw')";
      $result = mysqli_query($conn, $sql);
      
      if(!$result){
        echo "error while sending data to database";
      }else{
        // echo "";
      }
    }
  } 
}
?>
