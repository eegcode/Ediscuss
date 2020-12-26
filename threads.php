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
		?>
		
		<?php
		$category_id = $_GET['tc'];
		$sql = "SELECT * FROM categories WHERE category_id='$category_id'";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			// echo "error in quer";
		}else{
			if(!$row = mysqli_fetch_assoc($result)){
				// echo "error while fetchind data from database";
				echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
						        <strong>ERROR ! </strong>Sorry! an error while fetching data from database.
						        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>';
			}else{
			
			
			echo '<div class="jumbotron container py-4">
							<h1 class="display-5">'. $row["category_title"] .'</h1>
							<p class="lead">'. $row["category_description"] .'</p>
							<hr class="my-4">
							<p>No Spam / Advertising / Self-promote. Do not post copyright-infringing material. Do not post “offensive” posts, links or images.Do not cross post questions.Do not PM users asking for help.Remain respectful of other members at all times.</p>
							<p class="lead">
								<a href="ask_ques.php?ci='. $row["category_id"] .'" class="btn btn-success">Start a Discussion</a>
							</p>
				</div>';
			}
		}
		?>
		<div class="container my-5 threads-container">
			<?php
			
			$sql = "SELECT * FROM threads WHERE thread_cat_id='$category_id'";
			$result = mysqli_query($conn, $sql);
			if(!$result){
				// echo "error while loading thread lists";
				echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
						        <strong>ERROR ! </strong>Sorry! an error while loading threads.
						        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>';

			}else{
				if(mysqli_num_rows($result) > 0){	
			echo '<h1 class="my-4 text-center">Browse Threads</h1>';
					while ($row = mysqli_fetch_assoc($result)) {
						if(strlen($row["thread_description"])>255){
							$remaining = ". . . .";
						}else{
							$remaining = "";
						}

						$tuser_id = $row["thread_user_id"];
						// Getting user name who posted the thread
						$sqlui = "SELECT * FROM users where user_id='$tuser_id'";
						$resultui = mysqli_query($conn, $sqlui);
						while($rowui = mysqli_fetch_assoc($resultui)){
							$tusername = $rowui["username"];
						}


						echo '<div class="media py-4 px-3 border-bottom thread-item">
								<img class="mr-3" src="assets/images/defuser.jpg" width="100" alt="Generic placeholder image">
								<div class="media-body">
									<a href="thread_details.php?ti='. $row["thread_id"] .'" class=""><h5 class="mt-0">'. $row["thread_title"] .'</h5></a> 
									'. substr($row["thread_description"], 0,255). " " . $remaining . '
								<h6 class="mt-3 display-5">Posted by:'. $tusername.' </h6>
								</div>
							</div>';
					}
				}else{
					echo '<div class="container text-center mb-5 pb-5">
							<h4 class="">No Threads Availabe<h4>
							<h6 class=" mt-5">Be the first to Start Discussion in this topic?</h6 class="">
							<p class="">Post Your thread by <a href="ask_ques.php?ci='. $row["category_id"] .'"> clicking Here </a></p>
								</div>';
				}
			}

			?>
			
		
		</div>
		
		<script src="js/jquery.js"></script>
		<!-- <script src="js/bootstrap.min.js"></script> -->
		<script src="js/bootstrap.bundle.min.js"></script>
				
	</body>
</html>