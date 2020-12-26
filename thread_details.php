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
		$thread_id = $_GET["ti"];
		if(isset($_SESSION["user_id"])){
			$user_id = $_SESSION["user_id"];
		}
?>


<!-- Modal For thread edit -->
<?php
echo	'<div class="modal modal-lg fade mw-100 w-100" id="edit-thread-modal" tabindex="-1" role="dialog" aria-labelledby="				exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Update Thread</h5>
			      </div>
			      <div class="modal-body py-0">
			        <form class="mt-3" action="thread_details.php?ti='. $thread_id .'" method="post">
							<div class="form-group">
								<label for="thread-edit-modal-title" class="font-weight-bold">Title of your Query</label>
								<input type="text" class="form-control" id="thread-edit-modal-title" aria-describedby="emailHelp" name="edit_thread_title" required>
								<small id="emailHelp" class="form-text text-muted">Your title should be short and catchy</small>
							</div>
							<div class="form-group">
								<label for="thread-edit-modal-description" class="font-weight-bold">Description of your Query</label>
								<textarea class="w-100 form-control" name="edit_thread_description" id="thread-edit-modal-description"  rows="6" required></textarea>
								<small id="emailHelp" class="form-text text-muted">Properly describe your Query with codes or examples</small>
							</div>
							<input type="hidden" id="thread-edit-modal-id">
							<button type="submit" class="btn btn-success" name="edit_thread_btn">Update</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Discard</button>
						</form>
			      </div>
			    </div>
			  </div>
			</div>'
?>



<!-- Modal For Comment edit -->
<?php 
echo '
<div class="modal fade" id="edit-comment-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Comment</h5>
      </div>
      <div class="modal-body">
        <form method="post" action="thread_details.php?ti='. $thread_id .'">
					<div class="form-group">
					  <textarea class="w-100 textarea form-control edit-comment-box" name="edit_comment" rows="3" placeholder="Write your Comment here..."></textarea>
				   	<input type="hidden" id="edit-com-id" name="com_edit_id" placeholder="">
					</div>
					<input type="submit" name="edit_comment_btn" class="btn btn-primary edit-comment-btn" value="Update">
				  <input type="button" class="btn btn-danger comment-btn ml-2" data-dismiss="modal" value="Discard">
				</form>
      </div>
    </div>
  </div>
</div>';
?>



<!-- Modal For Answer edit -->
<?php
echo	'<div class="modal modal-lg fade mw-100 w-100" id="edit-answer-modal" tabindex="-1" role="dialog" aria-labelledby="				exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Update Answer</h5>
			      </div>
			      <div class="modal-body py-0">
			        <form method="post" action="thread_details.php?ti='. $thread_id .'">
							  <div class="form-group">
							    <textarea id="answer-edit-modal-description" class="w-100 textarea form-control" name="answer_edit" rows="10" placeholder="Write your answer here..."></textarea>
							    <small id="emailHelp" class="form-text text-muted">Your simple idea or knowledge may be great for others</small>
							</div>
								<input type="hidden" id="answer-edit-modal-id" name="answer_edit_modal_id">
							  <input type="submit" name="answer_edit_btn" class="btn btn-primary" value="Update">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Discard</button>
							</form>
			      </div>
			    </div>
			  </div>
			</div>';
?>


<?php
	if($_SERVER["REQUEST_METHOD"] === "POST"){
			//do stuffs of editing comment here
			if(isset($_POST["edit_thread_btn"])){
				$edit_thread_title = $_POST["edit_thread_title"];
				$edit_thread_description = $_POST["edit_thread_description"];

				$sql_edit_thread = "UPDATE `threads` SET `thread_title` = '$edit_thread_title', `thread_description` = '$edit_thread_description' WHERE `threads`.`thread_id` = '$thread_id'";
				$result_edit_thread = mysqli_query($conn, $sql_edit_thread);
				if(!$result_edit_thread){
					// echo "not";
					echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  <strong> ERROR !</strong> Sorry ! an error occured while Updating Please try again later.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>';
				}else{
					// echo "yup";
					echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong> Uppdated !</strong> Your thread has been updated successfully!
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>';
				}
			 }else if( isset($_POST["thread_delete_btn"])){
			 		$sql_delete_thread = "DELETE FROM `threads` WHERE `threads`.`thread_id` = '$thread_id'";
					$result_delete_thread = mysqli_query($conn, $sql_delete_thread);
					if(!$result_delete_thread){
						// echo "not";
						echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
					  <strong> ERROR !</strong> Sorry ! an error occured while deleting the thread.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>';
					}else{
						// echo "yup";
						echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong> Uppdated !</strong> Your thread has been deleted successfully!
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>';
					}
				
				}else if( isset($_POST["answer_edit_btn"]) ){
					 $editAnswer = $_POST["answer_edit"];
					 $ansedit_id = $_POST["answer_edit_modal_id"];

					 $sql_edit_answer = "UPDATE `answers` SET `answer_description` = '$editAnswer' WHERE `answers`.`answer_id` = '$ansedit_id'";
				$result_edit_answer = mysqli_query($conn, $sql_edit_answer);
				if(!$result_edit_answer){
					// echo "not";
					echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  <strong> ERROR !</strong> Sorry ! an error occured while Updating Please try again later.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>';
				}else{
					// echo "yup";
					echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong> Uppdated !</strong> Your answer has been updated successfully!
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>';
				}
	
		}else if( isset($_POST["answer_delete_btn"])){
					$ans_del_id = $_POST["ans_del_ans_id"];
			 		$sql_delete_answer = "DELETE FROM `answers` WHERE `answers`.`answer_id` = '$ans_del_id'";
					$result_delete_answer = mysqli_query($conn, $sql_delete_answer);
					if(!$result_delete_answer){
						// echo "not";
						echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
					  <strong> ERROR !</strong> Sorry ! an error occured while deleting the answer.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>';
					}else{
						// echo "yup";
						echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong> Uppdated !</strong> Your answer has been deleted successfully!
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>';
					}
				
				}else if( isset($_POST["edit_comment_btn"]) ){
					 $editComment = $_POST["edit_comment"];
					 $comedit_id = $_POST["com_edit_id"];

					 $sql_edit_comment = "UPDATE `comments` SET `comment` = '$editComment' WHERE `comments`.`comment_id` = '$comedit_id'";
				$result_edit_comment = mysqli_query($conn, $sql_edit_comment);
				if(!$result_edit_comment){
					// echo "not";
					echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  <strong> ERROR !</strong> Sorry ! an error occured while Updating Please try again later.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>';
				}else{
					// echo "yup";
					echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong> Updated !</strong> Your answer has been updated successfully!
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>';
				}
	
		}else if( isset($_POST["delete_comment_btn"])){
					$comdelete_id = $_POST["com_delete_id"];
			 		$sql_delete_comment = "DELETE FROM `comments` WHERE `comments`.`comment_id` = '$comdelete_id'";
					$result_delete_comment = mysqli_query($conn, $sql_delete_comment);
					if(!$result_delete_comment){
						// echo "not";
						echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
					  <strong> ERROR !</strong> Sorry ! an error occured while deleting the comment.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>';
					}else{
						// echo "yup";
						echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong> Updated !</strong> Your comment has been deleted successfully!
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>';
					}
				
				}
	}

?>




		


<?php
		//getting thread with thread id passed through GET method to display  in top
		$sql = "SELECT * from threads where thread_id='$thread_id'";
		$result = mysqli_query($conn, $sql);
		if($result){
			while($row = mysqli_fetch_assoc($result)){
				$user_id = $row['thread_user_id'];
				$cat_id = $row['thread_cat_id'];


				// Getting user name who posted the thread
				$sqlui = "SELECT * FROM users where user_id='$user_id'";
				$resultui = mysqli_query($conn, $sqlui);
				while($rowui = mysqli_fetch_assoc($resultui)){
					$username = $rowui["username"];
				}

				//getting the category of the thread
				$sqlcat = "SELECT * FROM categories where category_id='$cat_id'";
				$resultcat = mysqli_query($conn, $sqlcat);
				while($rowcat = mysqli_fetch_assoc($resultcat)){
					$category_title = $rowcat["category_title"];
				}
				//displaying content of the threads from above fetched 3 data.
				echo '<div class="jumbotron container py-4">
				  <h4 class="display-5">'. $category_title .'</h4>
				  <p class="lead">'. $row["thread_title"] .'</p>
				  <hr class="my-4">
				  <p>'. $row["thread_description"] .'</p>
				  <p><b>posted by: '. $username .'</b></p>
				  <div class="lead d-flex align-items-center">
				    <button class="btn btn-primary answer-btn mr-5">Answer</button>';
				 
				 if(isset($_SESSION['user_id'])){
				 	if($_SESSION["user_id"] === $row["thread_user_id"]){
				 		echo'<div class="my-auto">
						 		<button  data-id="'. $row["thread_id"] .'" class="btn btn-success edit-thread-btn  mr-3 ml-5" onclick="return confirm(\'Are you sure! \nYou want to EDIT the thread?\')" data-toggle="modal" data-target="#edit-thread-modal">Edit</button>
						 		</div>';



						 		$sqldel = "SELECT * from answers where ans_thread_id='$thread_id'";
		$resultdel = mysqli_query($conn, $sqldel);
		if($resultdel){
			if(mysqli_num_rows($resultdel) == 0 ){
					echo'<form class="my-auto" action="thread_details.php?ti='. $thread_id .'" method="post">
						 		<button  data-id="'. $row["thread_id"] .'" name="thread_delete_btn" class="btn btn-danger delete-thread-btn" onclick="return confirm(\'Are you sure!\nYou want to DELETE the thread?\')">Delete</button>
				 			 </form>';

			}
		}

				 	}
				 }

				 echo '</div>
				</div>';
				
			}
		}

		?>





<!--------------- For Discussion stuffs ----------------->
		<?php

		//for displaying answers or discussion
		$sql = "SELECT * from answers where ans_thread_id='$thread_id'";
		$result = mysqli_query($conn, $sql);

		if(!$result){
			// echo "error in fetching answers";
			echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  <strong> ERROR !</strong> Sorry ! an error occured dwhile fetching answers.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>';

		}else{
			// display answer if there is answer available for particulat thread in database
			if(mysqli_num_rows($result) > 0){
				echo '<h1 class="container mt-5 mb-4">Discussions</h1>';
				//loop to loop through all answers and display it
				while ($row = mysqli_fetch_assoc($result)){
					$ans_user_id = $row["ans_user_id"];
					$ans_id = $row["answer_id"];

					// get username for each answer posted
					$sqlu = "SELECT * FROM users WHERE user_id='$ans_user_id'";
					$resultu = mysqli_query($conn, $sqlu);

					$user_row = mysqli_fetch_assoc($resultu);
					$ans_username = $user_row["username"];

					//the actual mean point that displays answers
					echo '<div class="jumbotron container my-5 pt-4">
							<h6 class="mb-3"> Answered By: '. $ans_username .'</h6>
						  	<p class="lead answer-description">'. $row["answer_description"] .'</p>
						  <hr class="my-4">';

					//get comments for each answers posted
					 $sqlcom = "SELECT * FROM comments WHERE com_thread_id='$thread_id' AND com_ans_id='$ans_id'";
					  $resultcom = mysqli_query($conn, $sqlcom);
					  //do these stuffs if result returned false
					  if(!$resultcom){
					  	// echo "error while fetching comments";

					  	//if result for fetching comment is true do following
					  }else{
					  	//checking if comment exists in database
					  	if(mysqli_num_rows($resultcom) > 0){
						  echo '<h6>Comments</h6>';
						  // looping through all the available comments for the particular answer to display
						  while($rowcom = mysqli_fetch_assoc($resultcom)){
						  	$com_user_id = $rowcom["com_user_id"];
						  	$sqluc = "SELECT * FROM users WHERE user_id='$com_user_id'";
							$resultuc = mysqli_query($conn, $sqluc);

							$userc_row = mysqli_fetch_assoc($resultuc);
							$com_username = $userc_row["username"];
						  	echo '<div style="background: rgba(0,0,0,.05)" class="p-1 pb-0 rounded comment m-1">
						  <p class="m-0 px-2">'. $rowcom["comment"] .'</p>
						  <p class="comment-user text-right m-0" style="width: 90%">:- '. $com_username .'</p>';
						  
							if(isset($_SESSION['user_id'])){
								 	if($_SESSION["user_id"] === $rowcom["com_user_id"]){
										  echo '<div class="text-right pr-5 m-0 mt-2 d-flex align-items-center justify-content-end">
										  	<button class="btn btn-link p-0 m-0 text-success mr-3" id="edit-comment-btn" onclick="return confirm(\'Are you sure! \nYou want to EDIT the existing comment?\')"   data-toggle="modal" data-target="#edit-comment-modal" data-id="'. $rowcom["comment_id"] .'">Edit</button>
										  	<form class="p-0 m-0" method="post" action="thread_details.php?ti='. $thread_id .'">
										  		<button class="btn btn-link p-0 m-0 text-danger delete-comment-btn" onclick="return confirm(\'Are you sure! \nYou want to DELETE the existing comment?\')" name="delete_comment_btn">Delete</button>
										  		<input type="hidden" name="com_delete_id" value="'. $rowcom["comment_id"] .'">
										  	</form>
										  </div>
						  </div>';
						  }else{echo "</div>";}
						}else{echo "</div>";}
					}
					  		
					  	}
					  }
					  //Add comment button
						 echo '<p class="lead">
						    <a class="add-comment-btn btn btn-link">Add comment</a>
						  </p>';

						 //comment form
						  echo '<div class="container rounded pt-4 px-5 comment-form-container d-none">
									<h5 class="mb-3">Add your Comment</h5>
									<form method="post" action="thread_details.php?ti='. $thread_id .'">
									  <div class="form-group">
									    <textarea class="w-100 textarea form-control comment-box" name="comment" rows="3" placeholder="Write your Comment here..."></textarea>
									   	<input type="hidden" name="ans_id" value="'. $ans_id .'" placeholder="">
									</div>
									  <input type="submit" name="comment_btn" class="btn btn-primary comment-btn" value="Post">
									  <input type="button" class="btn btn-danger comment-btn ml-2 comment-discard-btn" value="Discard">

									</form>
								</div>';


								if(isset($_SESSION['user_id'])){
								 	if($_SESSION["user_id"] === $ans_user_id){
								 		echo'<div class="d-flex justify-content-end">
										 			<div class="my-auto">
												 		<button  data-id="'. $ans_id .'" class="btn btn-success edit-answer-btn  mr-3 ml-5" onclick="return confirm(\'Are you sure! \nYou want to EDIT the existing answer?\')" data-toggle="modal" data-target="#edit-answer-modal">Edit</button>
												 	</div>';
											 		

											 		$sqlansdel = "SELECT * from comments where com_ans_id='$ans_id'";
												$resultansdel = mysqli_query($conn, $sqlansdel);
												if($resultansdel){
													if(mysqli_num_rows($resultansdel) == 0 ){
											 		echo '<form class="my-auto" action="thread_details.php?ti='. $thread_id .'" method="post">
											 						<input type="hidden" name="ans_del_ans_id" value="'.  $ans_id .'">
																 		<button name="answer_delete_btn" class="btn btn-danger delete-answer-btn" onclick="return confirm(\'Are you sure!\nYou want to DELETE the answer?\')">Delete</button>
													</form>';
													}
												}

												echo '</div>
															</div>';


									}else{
										echo "</div>";
									}
								}else{
									echo '</div>';
								}


						 		$sqldel = "SELECT * from answers where ans_thread_id='$thread_id'";
		$resultdel = mysqli_query($conn, $sqldel);
		if($resultdel){
			if(mysqli_num_rows($resultdel) == 0 ){
					echo'<form class="my-auto" action="thread_details.php?ti='. $thread_id .'" method="post">
						 		<button  data-id="'. $row["thread_id"] .'" name="thread_delete_btn" class="btn btn-danger delete-thread-btn" onclick="return confirm(\'Are you sure!\nYou want to DELETE the thread?\')">Delete</button>
				 			 </form>';

			}
		}





								echo '';


			}
			//if no discussion is available do foollowing
		}else{
			echo '<h2 class="text-center mt-5 pt-5"> No discussions available </h2>
			<h6 class="text-center mb-5 pb-5">Be the first one to answer?<span class="answer-btn  text-primary btn-link btn">Click Here</span style="cursor:pointer"></h6>';

		}
			
		}

		?> 

			

		<?php
		//checking for form submission
		if($_SERVER["REQUEST_METHOD"] === "POST"){
		
			$user_id = $_SESSION["user_id"];
			//do stuffs of submitting answers
			if(isset($_POST["answer_btn"])){
				$answer = $_POST["answer"];
				$sql = "INSERT into answers (answer_description, ans_thread_id, ans_user_id) VALUES('$answer', '$thread_id', '$user_id')";
				$result = mysqli_query($conn, $sql);
				if(!$result){
					echo "error occured while sending ypur answer to database";
				}else{
					// echo "data_sent";
					echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  <strong>Submitted !</strong> Your answer has been posted.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>';
				}


			//do stuffs of commenting
			}else if( isset($_POST["comment_btn"]) ){
				$comment = $_POST["comment"];
				$com_ans_id = $_POST["ans_id"];
				$sql = "INSERT into comments (comment, com_user_id, com_ans_id, com_thread_id) VALUES('$comment', '$user_id', '$com_ans_id', '$thread_id')";
				$result = mysqli_query($conn, $sql);
				if(!$result){
					header("location: thread_details.php?ti=$thread_id");
					// echo "error occured while sending ypur answer to database" . mysqli_error($conn);
					echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  <strong>ERROR !</strong> Sorry! an error ocurred while posting your comment.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>';
				}else{
					// echo "data_sent";
					header("location: thread_details.php?ti=$thread_id");
					echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>Submitted !</strong> Your comment has been posted.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>';
				unset($comment);
				unset($com_ans_id);

				}

			}
		}
			
			
			


		//answer form-------------

		//answer form header to be displayed all time
		echo '<div class="container rounded py-4 px-5 mb-5 mt-5" style="background:rgba(100,100,100,.2);">
				<h3 class="mb-3">Post Your Answer</h3>';

		//actual answer form to be displayed if user has logged in
        if(isset($_SESSION["loggedin"])){
		    if($_SESSION["loggedin"] == false){
		     echo'<h4 class="mt-5">You need to register to post your answer. Click here to <a href="signup.php" mr-2">Sign up</a><h4>';
		        }else{
		          echo	'<form method="post" action="thread_details.php?ti='. $thread_id .'">
				  <div class="form-group">
				    <textarea class="w-100 textarea form-control" name="answer" rows="10" placeholder="Write your answer here..."></textarea>
				    <small id="emailHelp" class="form-text text-muted">Your simple idea or knowledge may be great for others</small>
				</div>
				  <input type="submit" name="answer_btn" class="btn btn-primary" value="Post">
				</form>
			</div>';
		        }
		 //show prompt to login if user hasnot logged in yet           
		}else{
		   echo'<h4 class="mt-5">You need to register to post your answer. Click here to <a href="signup.php" mr-2">Sign up</a><h4>';
		  }

		?>
		

	<script src="js/jquery.js"></script>
	<script src="js/thread_details.js"></script>

	<!-- <script src="js/bootstrap.min.js"></script> -->
	<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>




