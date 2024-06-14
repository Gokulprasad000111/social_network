<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['user_email'])){
	header("location: index.php");
	exit; // Add exit after header redirect
}
?>
<html>
<head>
	<title>User Profile</title> <!-- Changed title to User Profile -->
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
	<style>
		body{
			background-image: url("HD-wallpaper-dark-doodle.jpg");
		}
		
		.list-group {
			position: relative;
			left: 90px;
		}
		#own_posts {
            position: relative;
           bottom: 600px;
		   left: 500px;
            border: 5px solid #e6e6e6;
            padding: 20px;
            margin-bottom: 20px;
            background-image: none; /* Remove background image */
            background-color: #fff; /* Add a white background color */
        }

        #posts-img {
            width: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .post-content {
            margin-top: 20px;
        }
	</style>
</head>
<body>
<div class="row">
<?php
if(isset($_GET['u_id'])){
	$u_id = $_GET['u_id'];
}
if($u_id < 0 || $u_id == ""){
	echo "<script>window.open('home.php', '_self')</script>";
	exit; // Add exit after script execution
}
?>
<div class="col-sm-12">
<?php
if(isset($_GET['u_id'])){
	global $con;

	$user_id =$_GET['u_id'];

	$select ="select * from users where user_id='$user_id'";
	$run = mysqli_query($con,$select);
	$row = mysqli_fetch_array($run);

	$name = $row['user_name'];
}
?>
<?php
if(isset($_GET['u_id'])){
	global $con;
	$user_id =$_GET['u_id'];
	$select ="select * from users where user_id='$user_id'";
	$run = mysqli_query($con,$select);
	$row = mysqli_fetch_array($run);


	$id =$row['user_id'];
	$image= $row['user_image'];
	$name = $row['user_name'];
	$f_name=$row['f_name'];
	$l_name=$row['l_name'];
	$describe_user=$row['describe_user'];
	$country=$row['user_country'];
	$gender=$row['user_gender'];
	$register_date=$row['user_reg_date'];

	echo "
	<div class='row'>
		<div class='col-sm-1'>
		</div>
		<center>
		<div class='col-sm-3'id='information-box'>
			<h2>Information about</h2>
			<img src='users/$user_image' class='img-circle' width='200px' height='200px'>
			<br><br>
			<ul class='list-group'>
				<li class='list-group-item' title='username'><strong>$f_name $l_name</strong></li>
				<li class='list-group-item' title='user status'><strong style='color:grey;'>$describe_user</strong></li>
				<li class='list-group-item' title='Gender'><strong>$gender</strong></li>
				<li class='list-group-item' title='Country'><strong>$country</strong></li>
				<li class='list-group-item' title='user Registration date'><strong>$register_date</strong></li>
			</ul>";
			$user = $_SESSION['user_email'];
			$get_user = "select * from users where user_email='$user'";
			$run_user = mysqli_query($con, $get_user);
			$row = mysqli_fetch_array($run_user);
			$userown_id = $row['user_id'];
			if($user_id == $userown_id){
				echo "<a href='edit_profile.php?u_id=$userown_id' class='btn btn-success'>Edit Profile</a><br><br><br>";
			}
		echo "</div>
		</center>
	</div>";
}
?>
<div class ='col-sm-8'>
	<center><h1><strong><?php echo "$f_name $l_name";?></strong> Posts</h1></center>
	<?php
	global $con;
	if(isset($_GET['u_id'])){
		$u_id = $_GET['u_id'];
	}
	$get_posts = "select * from posts where user_id ='$u_id' ORDER by post_id DESC LIMIT 5";
	$run_posts = mysqli_query($con,$get_posts);
	while($row = mysqli_fetch_array($run_posts)){
		$post_id = $row['post_id'];
		$user_id = $row['user_id'];
		$content = $row['post_content'];
		$upload_image = $row['upload_image'];
		$post_date = $row['post_date'];
		$user = "select * from users where user_id='$user_id' AND posts='yes'";
		$run_user = mysqli_query($con, $user);
		$row_user = mysqli_fetch_array($run_user);
		$user_name = $row_user['user_name'];
		$f_name = $row_user['f_name'];
		$l_name = $row_user['l_name'];
		$user_image = $row_user['user_image'];
		if($content == "No" && strlen($upload_image) >= 1){
			echo "
			<div id='own_posts'>
				<div class='row'>
					<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img_circle' width='100px' height='100px'></p>
					</div>
					<div class='col-sm-6'>
						<h3> <a  style = 'color : black; font-size : 20px; font-weight : bold;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
						<h4><small style='color: black;'>Updated a post on<strong>$post_date</strong></small></h4>
					</div>
					<div class ='col-sm-4'></div>
				</div>
				<div class='row'>
					<div class='col-sm-12'>
						<img id='posts-img' src='imagepost/$upload_image' style='height: 350px'>
					</div>
				</div>
			</div><br><br>";
		}
		else {
			echo "
			<div id='own_posts'>
				<div class='row'>
					<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
					</div>
					<div class='col-sm-6'>
						<h3><a style='text-decoration:none; cursor:pointer; color #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
						<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
					</div>
					<div class='col-sm-4'></div>
				</div>
				<div class='row'>
					<div class='col-sm-12 post-content'>
						<h3><p>$content</p></h3>
					</div>
				</div>
			</div><br><br>";
		}
	}
	?>
</div>
</body>
</html>
