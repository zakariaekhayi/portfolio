<?php 
    session_start();
    if(!$_SESSION['id_user']){
        header("Location: Login.php");
        exit;
    }?>



<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="index.css" />
    <script src="index.js"></script>
    <!-- Meta tags and title -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Details</title>
      <!-- External links -->
    <!-- Javascript library link -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- Icons link -->
    <link rel="icon" type="image/x-icon" href="./images/event_logo.png" />
    <script
      src="https://kit.fontawesome.com/783ddb0a64.js"
      crossorigin="anonymous"
    ></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Karla:wght@200;300;400;500;600;700&family=Poppins:wght@100;200;300;400;500;600&family=Quicksand:wght@300;400;500;600&display=swap"
      rel="stylesheet"
    />

    <!-- CSS styles -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            height: 100vh;
        }

        .photo-container {
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }

        .photo-container img {
            max-width: 220px;
            height: auto;

        }

        .content-container {
            text-align: center;
            margin: 20px;
        }

        h1 {
            margin-bottom: 10px;
            color: #333;
        }

        .paragraph {
            max-width: 600px;
            margin: 0 auto;
            color: #666;
        }

        .footer {
            margin-top: auto;
            text-align: center;
            padding: 0px;
            background-color: #333;
            color: #fff;
            border-radius: 10px;
        }

        .reserve-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .success-message {
            display: none;
            background-color:green;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .a{

        }
    </style>
</head>
<body>
<img
              src="./images/event_logo.png"
              width="200px"
              class="hero-logo"
            />
    <!-- Main container -->
    <div class="container">

        <!-- PHP code for fetching article details -->
        <?php
            include("connexion.php");

            $photo = $_GET['photo'];
            $sql = "SELECT * FROM article WHERE photo='$photo'";
            $res = mysqli_query($link, $sql);

            $ref = mysqli_fetch_assoc($res);
            $titre = $ref['titre'];
            $des = $ref['description'];
            $photo = $ref['photo'];

            // Display article photo
            echo "<div class='photo-container'>";
            if (isset($photo)) {
                echo "<img  src='photo/$photo' alt='Article Photo'>";
            } else {
                echo "<p>No photo available</p>";
            }
            echo "</div>";

            // Display article details
            echo "<div class='content-container'>";
            echo "<h1>" . (isset($titre) ? $titre : 'Title not available') . "</h1>";
            echo "<div class='paragraph'>";
            echo "<p>" . (isset($des) ? $des : 'Description not available') . "</p>";
            echo "</div>";
            echo "</div>";
        ?>

        <!-- Footer with reserve button -->
        <div class="footer ">
            <button  class="third-sec-btn"  class="reserve-button" onclick="showSuccessMessage()">RESERVE</button>
        </div>
    </div>

 

    

    <!-- Success message display -->
    <div class="success-message" id="successMessage">
        Reservation successful &#10004;
    </div>

    <!-- JavaScript script -->
    <script>
        function showSuccessMessage() {
            document.getElementById("successMessage").style.display = "block";

            // You may want to implement logic to hide the message after some time
            setTimeout(function(){
                document.getElementById("successMessage").style.display = "none";
            }, 3000);
        }
    </script>
</body>
</html>

