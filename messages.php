<?php
// Make sure session is started and header is included
session_start();
include("includes/header.php");

// Redirect to index.php if user is not logged in
if(!isset($_SESSION['user_email'])){
    header("location: index.php");
    exit; // Added exit after header redirect
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Messages</title> 
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
#scroll_messages {
   
    overflow: scroll;
}
#btn-msg {
    width: 20%;
    height: 28px;
    border-radius: 5px;
    margin: 5px;
    border: none;
    color: #fff;
    float: right;
    background-color: #28cc71;
}
#select_user {
    
    overflow: scroll;
}
#green {
    background-color: #2ecc71;
    border-color: #27ae60;
    width: 45%;
    padding: 2.5px;
    font-size: 16px;
    border-radius: 3px;
    float: left;
    margin-bottom: 5px;
}
#blue{
    background-color: #3498db;
    border-color: #2980b9;
    width: 45%;
    padding: 2.5px;
    font-size: 16px;
    border-radius: 3px;
    float: right;
    margin-bottom: 5px;
}
.list{
    position: relative;
    left: 80px;
    bottom: 30px;
}
</style>
</head>
<body>
<div class="row">
<?php
// Check if u_id is set in the URL
if(isset($_GET['u_id'])){
    global $con;
    $get_id = $_GET['u_id'];

    $get_user = "SELECT * FROM users WHERE user_id='$get_id'";

    $run_user = mysqli_query($con, $get_user);
    $row_user = mysqli_fetch_array($run_user);
    
    // Check if user is found
    if($row_user) {
        $user_to_msg = $row_user['user_id'];
        $user_to_name = $row_user['user_name'];
    } else {
        // Redirect or show an error if user is not found
        echo "";
    }
}

// Get user info from session
$user = $_SESSION['user_email'];
$get_user = "SELECT * FROM users WHERE user_email='$user'";
$run_user = mysqli_query($con, $get_user);
$row = mysqli_fetch_array($run_user);

// Check if user is found in the session
if($row) {
    $user_from_msg = $row['user_id'];
    $user_from_name = $row['user_name'];
} else {
    // Redirect or show an error if user is not found
    echo "User not found";
}
?>
<div class="col-sm-3" id="select_user">
<?php
// Fetch and display all users
$user_query = "SELECT * FROM users"; // Changed variable name
$run_users = mysqli_query($con, $user_query); // Changed variable name
while($row_user = mysqli_fetch_array($run_users)){ // Changed variable name
    $user_id = $row_user['user_id'];
    $user_name = $row_user['user_name'];
    $first_name = $row_user['f_name'];
    $last_name = $row_user['l_name'];
    $user_image = $row_user['user_image'];

    echo "
    <div class='container-fluid'>
        <a style='text-decoration: none; cursor: pointer; color: #3897F0;' href='messages.php?u_id=$user_id'>
            <img src='users/$user_image' width='70px' height='70px' title='$user_name' style='border-radius: 50%; border: 2px solid red; padding: 2px;'/>
            <p style= 'font-size : 20px;  background-color:black; color : white; position:relative; left:80px; bottom:50px;'> $first_name $last_name</p><br><br>
        </a>
    </div>";
}
?>
</div>
<div class="col-sm-6">
<div class="load_msg" id="scroll_messages">
<?php
// Check if user_to_msg and user_from_msg are set
if(isset($user_to_msg) && isset($user_from_msg)) {
    $sel_msg = "SELECT * FROM user_messages WHERE (user_to='$user_to_msg' AND user_from='$user_from_msg') OR (user_from='$user_to_msg' AND user_to='$user_from_msg') ORDER BY date ASC"; // Corrected ORDER BY syntax
    $run_msg = mysqli_query($con, $sel_msg);

    // Check if messages are found
    if(mysqli_num_rows($run_msg) > 0) {
        while($row_msg = mysqli_fetch_array($run_msg)){
            $user_to = $row_msg['user_to'];
            $user_from = $row_msg['user_from'];
            $msg_body = $row_msg['msg_body'];
            $msg_date = $row_msg['date'];
            ?>
            <div id="loaded_msg">
                <p><?php if($user_to == $user_to_msg && $user_from == $user_from_msg) {
                    echo "<div class='message' id='blue' data-toggle='tooltip' title='$msg_date'>$msg_body</div><br><br><br>";}
                 else if($user_from == $user_to_msg && $user_to == $user_from_msg) {
                    echo "<div class='message' id='green' data-toggle='tooltip' title='$msg_date'>$msg_body</div><br><br><br>";
                }?></p>
            </div>
            <?php
        }
    } else {
        echo "";
    }
} else {
    echo "<p</p>";
}
?>
</div>
<?php
if(isset($_GET['u_id'])){
    $u_id = $_GET['u_id'];
    if($u_id == "new"){
        echo '
        <form> 
       <center><h3 style="color: white;">Select someone to start conversation</h3></center>

        <textarea disabled class="form-control" placeholder="Enter your Message"></textarea>
        <input type="submit" class="btn btn-default" disabled value="Send">
        </form><br><br>
        ';
    } else {
        echo '
        <form action="" method="POST"> 
        <textarea class="form-control" placeholder="Enter your Message" name="msg_box" id="message_textarea"></textarea>
        <input type="submit" name="send_msg" id="btn-msg" value="Send">
        </form><br><br>
        ';
    }
}
?>
<?php
if(isset($_POST['send_msg'])){
    $msg = htmlentities($_POST['msg_box']);

    if($msg == ""){
        echo"<h4 style='color:red; text-align: center;'>Message was unable to send!</h4>";
    } else if(strlen($msg) > 37){
        echo"<h4 style='color:red; text-align: center;'>Message is too Long! Use only 37 characters</h4>";
    } else {
        $insert = "INSERT INTO user_messages (user_to, user_from, msg_body, date, msg_seen) VALUES ('$user_to_msg', '$user_from_msg', '$msg', NOW(), 'no')";
        $run_insert = mysqli_query($con, $insert);
        if($run_insert){
            echo "<script>window.open('messages.php?u_id=$user_to_msg', '_self')</script>";
        }
    }
}
?>
</div>
<div class="col-sm-3">
<?php
if(isset($_GET['u_id'])){
    $get_id = $_GET['u_id'];
    if($get_id != "new"){
        $get_user = "SELECT * FROM users WHERE user_id='$get_id'";
        $run_user = mysqli_query($con, $get_user);
        $row = mysqli_fetch_array($run_user);

        if($row) { // Check if $row is not null
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $f_name = $row['f_name'];
            $l_name = $row['l_name'];
            $describe_user = $row['describe_user'];
            $user_country = $row['user_country'];
            $user_image = $row['user_image'];
            $register_date = $row['user_reg_date'];
            $gender = $row['user_gender'];

            echo "
            <div class='row'>
                <div class='col-sm-2'></div>
                <center>
                    <div style='background-color: #e6e6e6;' class='col-sm-9'>
                    <h2 style='font-family:'Roboto Mono',monospace; font-size: 30px; font-weight: 900; color: #333;'>Information About</h2>

                        <img class='img-circle' src='users/$user_image' width='150' height='150'>
                        <br><br>
                        <ul class='list'>
                            <li class='list-group-item' title='Username'><strong> $f_name $l_name</strong></li>
                            <li class='list-group-item' title='Gender'>$gender</li>
                            <li class='list-group-item' title='Country'> $user_country</li>
                            <li class='list-group-item' title='User Registration Date'>$register_date</li>
                        </ul>
                    </div>
                </center>
                <div class='col-sm-1'></div>
            </div>";
        } else {
            echo "<p>User not found</p>";
        }
    }
}
?>
</div>
</div>
<script>
var div = document.getElementById("scroll_messages");
div.scrollTop = div.scrollHeight;
</script>
</body>
</html>
