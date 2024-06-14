<!DOCTYPE html>
<html>
<head>
    <title>media link login and signup</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        background-color: #E2E5DE;
        color: white;
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.5);
    }
    
    .media-link {
        display: flex;
        justify-content: center; 
        align-items: center; 
        flex-grow: 1; 
        font-size: 40px;
        color: black;
    }

    .icons {
        display: flex;
    }

    .icons img {
        width: 30px;
        margin-left: 10px;
    }

    .search-container {
        margin-top: 20px;
        display: flex;
        justify-content: center;
        align-items: center; /* Added alignment */
    }

    .search-box {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 40px;
        width: 250px; /* Adjusted width */
        height: 30px;
        background-color: #E2E5DE;
        color: black;
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.5);
        font-size: 20px;
    }

    .search-box:hover{
        color: black;
        background-color: gray;
    }

    .search-box::placeholder {
        color: black; 
        font-size: 20px;
    }

    .search-btn {
        margin-left: 10px;
        padding: 5px 10px;
        background-color: #E2E5DE;
        color: black;
        border: none;
        border-radius: 30px;
        cursor: pointer;
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.5);
    }

    .search-btn:hover{
        color: black;
        background-color: gray;
    }


    .session-container {
        display: flex;
        margin-top: 20px;
        background-color: transparent;
        height: 100vh;
    }

    .menu-box {
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.5);
        width: 20%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

   .menu-box-center{
        border: 1px solid transparent;
        height : auto; /* Adjusted height */
        width : 100%; /* Adjusted width */
        margin-top: 40px;
   }

   .menu-items{
        margin-top: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid transparent;
        border-radius: 30px;
        height : 35px;
        font-size: 20px;
        background-color: #F2F3F4;
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.5);
   }

   .menu-items:hover{
        color: black;
        background-color: gray;
   }

   .session-box {
        width: 80%;
        padding: 1px;
        background-color : white;
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .search-box-center{
        border : 1px solid transparent;
        height: 95%;
        width: 95%;
        background-color: #E2E5DE;
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.5);
    }

    .catagories-text{
        border : 1px solid transparent;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 30px;
        padding-top: 20px;
        font-weight: bold;
        height : 5%;
    }

    .cata-img {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        text-align: center; 
    }

    .circle-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .circle {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        border: 1px solid transparent;
        margin-bottom: 5px; 
        background-size: 100% 100%;
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.5);
    }

    .main{
        height : 80%;
        border : 1px solid transparent;
        display :flex;
        justify-content: center;
        place-items: center;
    }

    .circle-label{
        font-size: 20px;
        font-weight: bold;
    }

    .button-74 {
		position: relative;
		bottom: 150px;
		left: 50px;
        margin-top: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid transparent;
        border-radius: 30px;
        height : 35px;
        font-size: 20px;
        background-color: #F2F3F4;
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.5);
    }

    .button-74:hover {
        color: black;
        background-color: gray;
    }

    .button-74:active {
        box-shadow: #422800 2px 2px 0 0;
        transform: translate(2px, 2px);
    }

    @media (min-width: 768px) {
        .button-74 {
            min-width: 120px;
            padding: 0 25px;
        }
    }
</style>
<body style="background-color: #E2E5DE;">
  <div class="header">
    <div class="media-link">Media Link</div>
  </div>
  <div class="session-container">
    <div class="menu-box">
        <div class="menu-box-center">
            <form method="post" action="">
                <button  name="signup">Sign up</button><br>
                <?php
                    if(isset($_POST['signup'])){
                        echo "<script>window.open('signup.php','_self')</script>";
                    }
                ?>
                <button id="login" name="login">Login</button><br><br>
                <?php
                    if(isset($_POST['login'])){
                        echo "<script>window.open('signin.php','_self')</script>";
                    }
                ?>
            </form>
        </div> 
    </div>
   
</div>
</body>
</html>
