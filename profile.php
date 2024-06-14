<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if (!isset($_SESSION['user_email'])) {
    header("location: index.php");
}
?>
<html>
<head>
    <?php
    $user = $_SESSION['user_email'];
    $get_user = "select * from users where user_email='$user'";
    $run_user = mysqli_query($con, $get_user);
    $row = mysqli_fetch_array($run_user);

    $user_name = $row['user_name'];
    $user_id = $row['user_id'];
    $user_cover = $row['user_cover'];
    $user_image = $row['user_image'];
    $first_name = $row['f_name'];
    $last_name = $row['l_name'];
    $describe_user = $row['describe_user'];
    $Relationship_status = $row['Relationship'];
    $user_country = $row['user_country'];
    $register_date = $row['user_reg_date'];
    $user_gender = $row['user_gender'];
    $user_birthday = $row['user_birthday'];
    ?>
    <title><?php echo "$user_name"; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home_style2.css">
    <style>
        body {
            background-image: url('HD-wallpaper-dark-doodle.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        #cover-img {
            position: relative;
            right: 80px;
            height: 400px;
            width: 100%;
            object-fit: cover;
        }

        #profile-img {
            position: absolute;
            top: 160px;
            left: 40px;
        }

        #update_profile {
            position: relative;
            top: -33px;
            cursor: pointer;
            left: 93px;
            border-radius: 4px;
            background-color: rgba(0, 0, 0, 0.1);
            transform: translate(-50%, -50%);
        }

        #button_profile {
            position: absolute;
            top: 82%;
            left: 50%;
            cursor: pointer;
            transform: translate(-50%, -50%);
        }

        #own_posts {
            position: relative;
            left: 50px;
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

        .user-info p {
            text-align: left;
            margin-left: 10px;
        }

        .user-info h4 {
            text-align: left;
            margin-left: 10px;
        }

        .user-info {
            position: relative;
           right: 90px;
          
            background-color: rgba(255, 255, 255, 0.8); /* Add a semi-transparent white background */
            padding: 20px;
            border-radius: 10px;
            width: 300px; /* Set a width for the user info box */
        }
    </style>
</head>
<body>
<div class="row">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8">
        <?php
        echo "
        <div>
            <div><img id='cover-img' class='img-rounded' src='cover/$user_cover' alt='cover'></div>
            <form action='' method='post' enctype='multipart/form-data'>

            <ul class='nav pull-left' style='position:absolute;top:10px;left:40px;'>
                <li class='dropdown'>
                    <button class='dropdown-toggle btn btn-default' data-toggle='dropdown'>Change Cover</button>
                    <div class='dropdown-menu'>
                        <center>
                        <p>Click <strong>Select Cover</strong> and then click the <br> <strong>Update Cover</strong></p>
                        <label class='btn btn-info'> Select Cover
                            <input type='file' name='u_cover' size='60' />
                        </label><br><br>
                        <button name='submit' class='btn btn-info'>Update Cover</button>
                        </center>
                    </div>
                </li>
            </ul>

            </form>
        </div>
        <div id='profile-img'>
            <img src='users/$user_image' alt='Profile' class='img-circle' width='180px' height='185px'>
            <form action='' method='post' enctype='multipart/form-data'>

            <label id='update_profile'> Select Profile
                <input type='file' name='u_image' size='60' />
            </label><br><br>
            <button id='button_profile' name='update' class='btn btn-info'>Update Profile</button>
            </form>
        </div><br>
        ";
        ?>
        <?php

        if (isset($_POST['submit'])) {

            $u_cover = $_FILES['u_cover']['name'];
            $image_tmp = $_FILES['u_cover']['tmp_name'];
            $random_number = rand(1, 100);

            if ($u_cover == '') {
                echo "<script>alert('Please Select Cover Image')</script>";
                echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
                exit();
            } else {
                move_uploaded_file($image_tmp, "cover/$u_cover.$random_number");
                $update = "update users set user_cover='$u_cover.$random_number' where user_id='$user_id'";

                $run = mysqli_query($con, $update);

                if ($run) {
                    echo "<script>alert('Your Cover Updated')</script>";
                    echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
                }
            }

        }

        if (isset($_POST['update'])) {

            $u_image = $_FILES['u_image']['name'];
            $image_tmp = $_FILES['u_image']['tmp_name'];
            $random_number = rand(1, 100);

            if ($u_image == '') {
                echo "<script>alert('Please Select Profile Image on clicking on your profile image!')</script>";
                echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
                exit();
            } else {
                move_uploaded_file($image_tmp, "users/$u_image.$random_number");
                $update = "update users set user_image='$u_image.$random_number' where user_id='$user_id'";

                $run = mysqli_query($con, $update);

                if ($run) {
                    echo "<script>alert('Your Profile Updated!')</script>";
                    echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
                }
            }

        }

        ?>
    </div>

    <div class="col-sm-2">
        <div class="user-info">
            <h4><strong><?php echo "$first_name $last_name"; ?></strong></h4>
            <p><strong><i style='color:grey;'><?php echo $describe_user; ?></i></strong></p>
            <p><strong>Relationship Status: </strong> <?php echo $Relationship_status; ?></p>
            <p><strong>Lives In: </strong> <?php echo $user_country; ?></p>
            <p><strong>Member Since: </strong> <?php echo $register_date; ?></p>
            <p><strong>Gender: </strong> <?php echo $user_gender; ?></p>
            <p><strong>Date of Birth: </strong> <?php echo $user_birthday; ?></p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-6">
        <?php
        global $con;
        if (isset($_GET['u_id'])) {
            $u_id = $_GET['u_id'];
        }

        $get_posts = "SELECT * FROM posts WHERE user_id='$u_id' ORDER by 1 DESC LIMIT 5";
        $run_posts = mysqli_query($con, $get_posts);

        while ($row_posts = mysqli_fetch_array($run_posts)) {
            $post_id = $row_posts['post_id'];
            $user_id = $row_posts['user_id'];
            $content = $row_posts['post_content'];
            $upload_image = $row_posts['upload_image'];
            $post_date = $row_posts['post_date'];

            $user = "SELECT * FROM users WHERE user_id='$user_id' AND posts='yes'";
            $run_user = mysqli_query($con, $user);
            $row_user = mysqli_fetch_array($run_user);

            $user_name = $row_user['user_name'];
            $user_image = $row_user['user_image'];

            echo "
            <div id='own_posts'>
                <div class='row'>
                    <div class='col-sm-2'>
                        <img src='users/$user_image' class='img-circle' width='100px' height='100px'>
                    </div>
                    <div class='col-sm-6'>
                        <h3><a style='text-decoration:none; cursor:pointer;color #0000ff;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
                        <h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
                    </div>
                    <div class='col-sm-4'>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-sm-12'>
                        <div class='post-content'>
                            <p>$content</p>
                        </div>
                    </div>
                </div>";

            if (!empty($upload_image)) {
                echo "
                <div class='row'>
                    <div class='col-sm-12'>
                        <img id='posts-img' src='imagepost/$upload_image'>
                    </div>
                </div>";
            }
            echo "
                <div class='row'>
                    <div class='col-sm-12'>
                        
                        <a href='functions/delete_post.php?post_id=$post_id' style='float:right;' class='btn btn-danger'>Delete</a>
                    </div>
                </div>
            </div><br><br>";
        }

        ?>
    </div>
    <div class='col-sm-2'>
    </div>
</div>
</body>
</html>
