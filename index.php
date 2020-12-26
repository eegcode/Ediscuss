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
		<!-- Carousel Slider -->
		<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img class="d-block w-100" src="assets/images/c6.jpg" alt="First slide">
				</div>
			</div>
		</div>
		<!-- Categories Section -->
		<div class="container mt-5">
			<h1 class="text-center">Thread Categories</h1>
			<div class="row">
				<?php
				$sql = "SELECT * from categories";
				$result = mysqli_query($conn, $sql);
				if(!$result){
					// echo " no db";
					echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
						        <strong>ERROR ! </strong>Error while loading data.
						        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>';
				}else{
					if (mysqli_num_rows($result) == 0) {
					// echo "No rows found, nothing to print so am exiting";
					echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
						        <strong>NO DATA ! </strong>Category data not found.
						        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>';
					exit;
					}else{
						while ( $row = mysqli_fetch_assoc($result) ) {
							$rand = rand(1,2);
							echo '<div class="container col-md-4 my-4">
										<div class="card" style="width: 18rem;">
												<img class="card-img-top" src="assets/images/'. strtolower($row['category_title'])."".$rand .'.jpg" alt="Card image cap">
												<div class="card-body">
														<h5 class="card-title">' . $row['category_title'] . '</h5>
														<p class="card-text">'. substr($row['category_description'],0,85) .'....</p>
														<a href="threads.php?tc='.$row['category_id'].'" class="btn btn-success">View threads</a>
												</div>
										</div>
								</div>';
						}
					}
				};
				?>
			</div>
		</div>
	</div>
	<script src="js/jquery.js"></script>
	<!-- <script src="js/bootstrap.min.js"></script> -->
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/index.js"></script>


</body>
</html>