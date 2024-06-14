<!DOCTYPE html>
<html>
<head>
    <title>media link login and signup</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url("Web_Photo_Editor.jpg");
            background-size: cover;
        }

        .session-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .menu-box {
           
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            position: relative; /* Ensure the popup is positioned relative */
        }

        .menu-box-center {
            border: 1px solid transparent;
            width: 100%; /* Adjusted width */
            margin-top: 40px;
            text-align: center;
        }


        img.center-image {
            width: 200px;
            height: 200px;
            border-radius: 50%; /* Make it circular */
            border: 1px solid transparent;
            margin-bottom: 20px;
            cursor: pointer;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.5);
            object-fit: cover; /* Ensure the image covers the circle */
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        .popup button {
            margin: 10px;
        }

        /* CSS for button-81 */
        .button-81 {
            background-color: #fff;
            border: 0 solid #e2e8f0;
            border-radius: 1.5rem;
            box-sizing: border-box;
            color: #0d172a;
            cursor: pointer;
            display: inline-block;
            font-family: "Basier circle", -apple-system, system-ui, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1.1rem;
            font-weight: 600;
            line-height: 1;
            padding: 1rem 1.6rem;
            text-align: center;
            text-decoration: none #0d172a solid;
            text-decoration-thickness: auto;
            transition: all .1s cubic-bezier(.4, 0, .2, 1);
            box-shadow: 0px 1px 2px rgba(166, 175, 195, 0.25);
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
        }

        .button-81:hover {
            background-color: #1e293b;
            color: #fff;
        }

        @media (min-width: 768px) {
            .button-81 {
                font-size: 1.125rem;
                padding: 1rem 2rem;
            }
        }

        /* CSS for close button */
        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 32px;
            height: 32px;
            opacity: 0.3;
            cursor: pointer;
            z-index: 9999;
        }

        .close:hover {
            opacity: 1;
        }

        .close:before,
        .close:after {
            position: absolute;
            content: ' ';
            height: 2px;
            width: 20px;
            background-color: #333;
            top: 50%;
            left: 50%;
            transform-origin: center;
        }

        .close:before {
            transform: translate(-50%, -50%) rotate(45deg);
        }

        .close:after {
            transform: translate(-50%, -50%) rotate(-45deg);
        }
    </style>
</head>
<body>
    <div class="header"></div>
    <div class="session-container">
        <div class="menu-box">
            <img src="Untitled Project (1).jpg" alt="Center Image" class="center-image" id="center-image">
            <div class="popup" id="popup">
                <form method="post" action="">
                    <button name="signup" class="button-81">Signup</button><br>
                    <?php
                        if(isset($_POST['signup'])){
                            echo "<script>window.open('signup.php','_self')</script>";
                        }
                    ?>
                    <button id="login" name="login" class="button-81">Login</button><br>
                    <?php
                        if(isset($_POST['login'])){
                            echo "<script>window.open('signin.php','_self')</script>";
                        }
                    ?>
                    <div class="close" id="close-popup"></div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#center-image").click(function () {
                $("#popup").css("display", "block");
            });

            $("#close-popup").click(function () {
                $("#popup").css("display", "none");
            });
        });
    </script>
</body>
</html>
