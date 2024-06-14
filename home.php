<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['user_email'])){
	header("location: index.php");
}
?>
<html>
<head>
	
	<title>home</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
    <style>
        body {
            background-image: url("HD-wallpaper-dark-doodle.jpg");
        }

        /* Style for the "Find new people" section */
        .find-people {position: relative;
            right: 140px;
          
        }

        .find-people h2 {
            margin-top: 0;
            margin-bottom: 20px;
            color: yellow;
        }

        .search_form {
            margin-bottom: 20px;
        }

        /* Style for the "Upload" button */
        #show_form_btn {
            margin-bottom: 20px;
        }

       /* Style for the posts */
.post-frame {
    background-color: #ffffff;
    border: 6px solid black;
    border-radius: 10px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.post-frame h2 {
    margin-top: 0;
    margin-bottom: 20px;
    color: #ffff00; /* Yellow color for headings */
}

/* Adjust profile picture and username size */
.post-frame-header img {
    width: 40px; /* Adjust the size as needed */
    height: 40px; /* Adjust the size as needed */
    border-radius: 50%;
    margin-right: 10px;
    border: 1px solid #cccccc; /* Add a border */
}

.post-frame-header .user-name {
    font-weight: bold;
    font-size: 16px; /* Adjust the font size as needed */
    line-height: 40px; /* Adjust the line height to match the image size */
    color: #333333; /* Change the color */
}

/* Adjust padding to fit the content */
.post-frame-content {
    padding: 0;
    border-bottom: 1px solid #dddddd; /* Add a border */
}

.post-frame-content img {
    max-width: 100%; /* Ensure images fit within the container */
    height: auto; /* Maintain aspect ratio */
    border-radius: 10px 10px 0 0;
}

.post-frame-content p {
    padding: 10px;
    font-size: 16px;
}

/* Post footer */
.post-frame-footer {
    padding: 10px;
    font-size: 14px;
    color: #777777;
}

.post-frame-footer .likes {
    color: #388e3c; /* Change the color for likes */
}

.post-frame-footer .comments {
    color: #2196f3; /* Change the color for comments */
}

.post-frame-footer .likes,
.post-frame-footer .comments {
    margin-right: 20px;
}

    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="find-people">
                <h2 style = 'color : white'>Find people</h2>
                <form class="search_form" action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search friend" name="search_user">
                        <div class="input-group-btn">
                            <button class="btn btn-info" type="submit" name="search_user_btn">Search</button>
                        </div>
                    </div>
                </form>
                <?php search_user(); ?>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="row">
                <div class="col-sm-12">
                    <center>
                        <button class="btn btn-primary" id="show_form_btn">Upload</button>
                    </center>
                </div>
            </div>
            <div class="row" id="post_form" style="display: none;">
                <div class="col-sm-12">
                    <center>
                        <form action="home.php?id=<?php echo $user_id; ?>" method="post" id="f" enctype="multipart/form-data">
                            <textarea class="form-control" id="content" rows="4" name="content" placeholder="What's in your mind?"></textarea><br>
                            <label class="btn btn-warning" id="upload_image_button">Select Image
                                <input type="file" name="upload_image" size="30">
                            </label>
                            <button id="btn-post" class="btn btn-success" name="sub">Post</button>
                        </form>
                        <?php insertPost(); ?>
                    </center>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="post-frame">
                        <center>
                        <h2 style = 'color : black;  font-family: Oswald, sans-serif;  font-weight:bold;font-size: 24px;s'>POSTS</h2></center>
                        <?php echo get_posts(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#show_form_btn").click(function(){
            $("#post_form").toggle();
        });
    });
</script>

</body>
</html>
