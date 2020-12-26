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



		if(isset($_SESSION["loggedin"])){
			$user_id = $_SESSION["user_id"];
			include("partials/_dbconnect.php");
			$catid = $_GET['ci'];


			$sql= "SELECT * FROM categories where category_id='$catid'";
			$result = mysqli_query($conn, $sql);
			if($result){
				while($row = mysqli_fetch_assoc($result)){
					$cat_title =  '<h3>'. $row["category_title"] .'</h3>';
				}
			}

			if($_SERVER["REQUEST_METHOD"] === "POST"){
				$title = strval($_POST["thread_title"]);
				$description = strval($_POST["thread_description"]);


			$sql = "INSERT INTO threads(thread_title, thread_description, thread_user_id, thread_cat_id) VALUES('$title','$description', '$user_id', '$catid')";
			$result = mysqli_query($conn, $sql);
			if(!$result){
				// echo "error while sending data to the databasw";
				echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
					        <strong>ERROR ! </strong>An error occured while sending data. Please try again later.
					        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>';
			}else{
				// echo "done";
				header("location:threads.php?tc=$catid");
			}
			}
		

			

		
		echo '<div class="container mt-4">'.
		$cat_title
		.'<h4 class="mt-3">Ask a Question To Start a Discussion</h4>
			<form class="mt-3" action="ask_ques.php?ci='. $catid .'" method="post">
				<div class="form-group">
					<label for="title">Title of your Query</label>
					<input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="thread_title" required>
					<small id="emailHelp" class="form-text text-muted">Your title should be short and catchy</small>
				</div>
				<div class="form-group">
					<label for="description">Description of your Query</label>
					<textarea class="w-100 form-control" name="thread_description" id="description"  rows="8" required></textarea>
					<small id="emailHelp" class="form-text text-muted">Properly describe your Query with codes or examples</small>
				</div>
				<button type="submit" class="btn btn-primary">Post</button>
			</form>
		</div>';
	}else{
		echo '<h4 class="text-center mt-5">You must be logged in to continue. Click here to <a href="login.php"> Login </a><h4>';
	}


		?>

		<script src="js/jquery.js"></script>
		<!-- <script src="js/bootstrap.min.js"></script> -->
		<script src="js/bootstrap.bundle.min.js"></script>
	</body>
</html>


