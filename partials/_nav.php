  <?php 
  include("_dbconnect.php");
  session_start(); 
  ?>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">E-Discuss</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Browse topics
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php 
          $sql = "SELECT * from categories";
          $result = mysqli_query($conn, $sql);

          while($row = mysqli_fetch_assoc($result)){
            echo '<a class="dropdown-item border-bottom" href="threads.php?tc='.$row['category_id'].'">'.  $row["category_title"] .'</a>'; 
          }

          
          ?>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Start discussion
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <span class="px-2 m-auto"> Choose a topic to </span>
          <span class="px-2 m-auto"> Start discussion </span>
          <hr>
          <?php 
          $sql = "SELECT * from categories";
          $result = mysqli_query($conn, $sql);

          while($row = mysqli_fetch_assoc($result)){
            echo '<a class="dropdown-item border-bottom" href="ask_ques.php?ci='. $row["category_id"] .'">'.  $row["category_title"] .'</a>'; 
          }

          
          ?>
        </div>
      </li>
    </ul>

<?php
  if(isset($_SESSION["loggedin"])){
    if($_SESSION["loggedin"] == false){
      echo '<a href="login.php" class="btn btn-outline-primary mr-2">Log in</a>
            <a href="signup.php" class="btn btn-primary">Sign  up</a>';
        }else{
          echo '<div class="hello d-flex flex-column text-light mx-3">
            <span style="user-select:none;">Hello! ,</span>
            <span style="user-select:none;">'. $_SESSION["username"] .'</span>
          </div>
          <a href="partials/_logout.php" class="btn btn-danger">Log out</a>';
        }
            
  }else{
    echo '<a href="login.php" class="btn btn-outline-primary mr-2">Log in</a>
            <a href="signup.php" class="btn btn-primary">Sign  up</a>';
  }
    
    ?>
  </div>
</nav>
