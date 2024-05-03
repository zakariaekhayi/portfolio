<?php 
    session_start();
    if(!$_SESSION['id_user']){
        header("Location: Login.php");
        exit;
    }?>


<?php 
include ("connexion.php");
$requette="SELECT * FROM article";
$resultat=mysqli_query($link,$requette);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="index.css" />
    <script src="index.js"></script>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Events</title>

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
    <style>
.imageedit {
    transition-property: transform;
    transition-duration: 0,5s;
    border: 5px solid white; /*on ecrit border et n'est pas border  */
    border-radius: 15px;
}
.imageedit:hover {
  
    border: 5px solid #f18953; /*on ecrit border et n'est pas border  */
    border-radius: 15px;
}



    </style>
  </head>
  <body>
    <!-- Hero Section -->
    <!-- Navbar -->
    <hero id="Home">
      <div id="hero-section">
        <!--Remember to create a navbar and put everything inside  -->
        <div id="navbar" style="position: relative;">
          <div id="hero--logo" style="position: relative">
            <img
              src="./images/event_logo.png"
              width="200px"
              class="hero-logo"
            />
          </div>

          <div class="nav-items">
            <ul id="navlist"    style=" position:relative; right:100%; ;">
   <?php             


include('connexion.php');

if (isset($_SESSION['id_user']) && !empty($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
    $prenom = isset($_SESSION['prenom']) ? $_SESSION['prenom'] : '';
    $nom = isset($_SESSION['nom']) ? $_SESSION['nom'] : '';

    if (!empty($prenom) && !empty($nom)) {
        // Retrieve the image column value for the user
        $requeteImage = "SELECT image FROM user WHERE LOGIN = '$id_user'";
        $resultatImage = mysqli_query($link, $requeteImage);
        $dataImage = mysqli_fetch_assoc($resultatImage);
        $filename = isset($dataImage['image']) ? $dataImage['image'] : '';

        // Construct the full path to the image
        $imagePath = $filename; // Adjust the path accordingly

        // Display the image with border-radius and right positioning
       

        // Display the image and title with a flex container
       
?>
<li >
    <h1 style="margin: 0; color: #f18953;">HI</h1>
       </li>
       <li>
       <span style="background-color:white; color: orange;"><h1 style="margin: 0;"><?=  $nom ?></h1></span>
       </li>
       <li>
       <span style="background-color:white; color: orange;"><h1 style="margin: 0;"><?=  $prenom ?></h1></span>
       </li>
       <li style="position:absolute; right: 100px;  ">
       <img src="photo/<?=$imagePath ?>" alt="" style="background-color:white; border-radius: 50%; width: 60%; display: inline-block; vertical-align: middle;">
       </li>
    <?php    
      
    }
}
?>

                
                
                
              <li>
                <button class="openbtn" onclick="openNav()"    style="text-decoration: none; color:black; " onmouseover="this.style.color=' #f18953'" onmouseout="this.style.color='#000000'">
                  <!-- style="position: absolute; right: 100px" -->
                  &#9776;
                </button>
              </li>
            </ul>

            <div id="mySidepanel" class="sidepanel">
              <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"
                >&times;</a
              >
              <img
                src="./images/event_logo.png"
                width="80px"
                class="side-pan-img"
              />
            
              <a href="#Home">Home</a>
              <a href="#About">About Us</a>
              <a href="#Apps">Apps</a>
              <a href="#Contact">Contact Us</a>
              <a href="editprofil.php">Edit profile</a>
              <a href="deconnexion.php">logout</a>
             
            </div>
          </div>
        </div>
        <!-- Hero section 2 -->
        <div id="hero-sec2">
          <div class="sec2-d1">
            <h1 class="sec2-h1">Now is your <span class="spn1">Time!</span></h1>
            <br />
            <h2 class="sec2-h2-1">Be prepared,live & believe to</h2>
            <br />
            <h2 class="sec2-h2-2">Pursue your interests</h2>
          </div>
          <div class="sec2-d2">
            <img
              src="./images/her_group2.svg"
              width="width: 335px;
        height: 330px;"
              class="hero-diagram"
            />
          </div>
        </div>

        <!-- Hero Section 3 -->
        <div id="hero-sec3">
          <div class="sec3-d1">
            <p class="sec3-p">
              Whatever your interest,with networking entertainment & skill
              sharing you’ll find a community to fit in, Events are happening
              everyday, login to join the fun.
            </p>
            <img
              src="./images/Line 4.png "
              width="3px;"
              height="130px"
              class="sec3-img"
            />
            <button class="sec3-btn">Get Started</button>
          </div>
        </div>
      </div>
    </hero>
    <!-- /////////////////////////////////// -->
    <!-- Second section -->
    <div id="About">
      <div id="second-section">
        <div class="second-sec-headers">
          <h1 class="header-1">How <span class="spn2">Events</span> Works</h1>
          <br />
          <h2 class="header-2">
            Meet new people who share your interest through online and
            in-person<br />
            events. You live the excitement here!
          </h2>
        </div>
        <div class="second-sec-mid">
          <div class="mid-d1">
            <img src="./images/events-meeting-1.png" width="220px" />
            <h2 class="mid1-h1">Join a group</h2>
            <br />
            <p>
              Do what you love,with others who love it,find your community. The
              rest is history!
            </p>
          </div>
          <div class="mid-d2">
            <img src="./images/events-meeting-2.png" width="220px" />
            <h2 class="mid2-h1">Find an event</h2>
            <br />
            <p>
              Events are happening of any topic you can think of, from online
              gaming to many others
            </p>
          </div>
          <div class="mid-d3">
            <img
              src="./images/events-meeting-3.png"
              width="220px"
              class="mid3-img"
            />
            <h2 class="mid3-h1">Start a group</h2>
            <br />
            <p>Gather like-minds just as you and explore shared interests.</p>
          </div>
        </div>
      </div>
    </div>

    <div id="third-section">
  <div class="third-sec-main">
    <div class="third-sec-m1">
      <h2 class="third-sec-header1">Upcoming Online Events</h2>
      <h3 class="third-sec-header2">
        <a href="galerie.php" style="text-decoration: none; color: azure;" onmouseover="this.style.color='#f18953'" onmouseout="this.style.color='white'">
          Explore more events
        </a>
      </h3>
    </div>
    <div class="third-sec-list">
    <?php 
include ("connexion.php");
$requete = "SELECT * FROM article ORDER BY id DESC LIMIT 4";
$resultat=mysqli_query($link,$requete);


$i=1;

while($resultat_tableau=mysqli_fetch_assoc($resultat)){
  $photo=$resultat_tableau['photo'];
  ${"photo" . $i} = $resultat_tableau['photo'];//comme disant  $photo$i=$$resultat_tableau['photo'];  $i++; 
    $i++;//incrementer pour changer le nom de la variable



}

?>
     
     <div >
     <a href="reserver.php?photo=<?= $photo1 ?>">
    <img class="imageedit" src="./photo/<?=$photo1;?>" width="220px" />
  </a>
  <div style="margin-top: 15%; padding:0%; ">
    <a href="reserver.php?photo=<?= $photo1 ?>"><button class="third-sec-btn" style="text-align:center;">RESERVE </button></a>
  </div>
</div>

<div>
  <a href="reserver.php?photo=<?= $photo2 ?>">
    <img class="imageedit" src="./photo/<?=$photo2;?>" width="220px" />
  </a>
  <div style="margin-top: 15%; padding:0%; ">
    <a href="reserver.php?photo=<?= $photo2 ?>"><button class="third-sec-btn">RESERVE </button></a>
  </div>
</div>

<div>
  <a href="reserver.php?photo=<?= $photo3 ?>">
    <img class="imageedit" src="./photo/<?=$photo3;?>" width="220px" />
  </a>
  <div style="margin-top: 15%; padding:0%; ">
    <a href="reserver.php?photo=<?= $photo3 ?>"><button class="third-sec-btn">RESERVE </button></a>
  </div>
</div>

<div>
  <a href="reserver.php?photo=<?= $photo4 ?>">
    <img class="imageedit" src="./photo/<?=$photo4;?>" width="220px" />
  </a>
  <div style="margin-top: 15%; padding:0%; ">
    <a href="reserver.php?photo=<?= $photo4 ?>"><button class="third-sec-btn">RESERVE </button></a>
  </div>
</div>

    </div>
  </div>
</div>
<


        <div class="third-sec-m2">
          <div>
            <h2 class="third-sec-header3">
              Tell Us what you Love
              <br />
              <span class="spn5"
                >We'll find event recommendations just for you</span
              >
            </h2>
          </div>
          <div>
          <a href="mailto:zakariaekhayi2023@gmail.com">
    <button class="third-sec-btn">Tell Us</button>
</a>

          </div>
        </div>
      </div>
    </div>

    <!-- Fourth Section -->
    <div id="fourth-section">
  <div class="fourth-sec-main">
    <div class="fourth-sec-m1">
      <h2 class="fourth-sec-header1">Arts & Entertainment</h2>
      <h3 class="fourth-sec-header2">Explore more events</h3>
    </div>
    
    <div class="fourth-sec-list1">
      <div>
        <a href="autrephoto.html"><img class="imageedit" src="./images/display5.png" width="200px" /></a>
      </div>
      <div>
        <a href="autrephoto.html"><img class="imageedit" src="./images/display6.png" width="200px" /></a>
      </div>
      <div>
        <a href="autrephoto.html"><img class="imageedit" src="./images/display7.png" width="200px" /></a>
      </div>
      <div>
        <a href="autrephoto.html"><img class="imageedit" src="./images/display8.png" width="200px" /></a>
      </div>
    </div>
    
    <!-- Second part -->
    <div class="fourth-sec-list1">
      <div>
        <a href="autrephoto.html"><img class="imageedit" src="./images/display9.png" width="200px" /></a>
      </div>
      <div>
        <a href="autrephoto.html"><img class="imageedit" src="./images/display10.png" width="200px" /></a>
      </div>
      <div>
        <a href="autrephoto.html"><img class="imageedit" src="./images/display11.png" width="200px" /></a>
      </div>
      <div>
        <a href="autrephoto.html"><img class="imageedit" src="./images/display12.png" width="200px" /></a>
      </div>
    </div>
    <a href="galerie.php">
    <button class="fourth-sec-btn">See More</button>
    </a>
  </div>
</div>


    <!-- /////////////////////////////////// -->
    <!-- /////////////////////////////////// -->
    <!-- Fifth section -->
    <div id="fifth-section">
      <h1 class="fifth-h1">
        Get Started with <span class="spn3">Events</span>
      </h1>
      <br />
      <h3 class="fifth-h2">
        Let’s get you started by signing up, receive notifications on events<br />
        of your interest and enjoy a wider range of activities all in a single
        community.
      </h3>
      <br />
      <div class="fifth-main-mid">
        <div class="fifth-mid-1">
          

          <h2 class="fifth-header2">
            Ajouter des commentaire<br />
          </h2>
        </div>
   
          <form action="commentaire.php" method="post">
        <div class="fifth-mid-2">
        
          <h2 class="fifth-header3">
            Ajouter ici des commentaire sur les evenements et vos idees<span class="spn3">Events?</span> <br />
            <input type="text" class="input3" placeholder="Tell us something" name="comment" />
          </h2>
         
        </div>
      </div>
      <button class="sign-btn" name='poster'>Poster</button><br>
 
      </form>
     <button class="sign-btn" > <a href="commentaire.php" style="text-decoration: none; color:black;">Voir les commentaire</a></button>
    
      <br />
    
    </div>

    <!-- Sixth section -->
    <div id="sixth-section">
      <div>
        <img src="./images/mockup1.png" width="250px" />
      </div>
      <div class="sixth-mid">
        <img src="./images/event-bg.png" width="200px " class="sixth-img1" />
        <h2 class="sixth-header">Download the app</h2>
        <h2 class="sixth-header">Stay Connected</h2>
        <img
          src="./images/dw-play-store.png"
          width="170px"
          class="sixth-img2"
        />
        &nbsp;&nbsp;
        <img src="./images/dw-app-store.png" width="170px" class="sixth-img2" />
      </div>
      <div>
        <img src="./images/mockup2.png" width="200px" />
      </div>
    </div>

    <!-- Footer -->
    <div id="Contact">
      <footer id="footer">
        <div class="footer-div-one">
          <div class="footer-div1">
            <h1 class="footer-div-header">Find Events</h1>
            <ul class="footer-ul">
              <li>Virtual Events</li>
              <li>Online Webinars</li>
              <li>In-person concerts</li>
              <li>Educative</li>
              <li>Entertainment Festivities</li>
              <li>Art Exhibitions</li>
            </ul>
          </div>
          <!-- Div 2 -->
          <div class="footer-div2">
            <h1 class="footer-div-header">Discover</h1>
            <ul class="footer-ul">
              <li>Groups</li>
              <li>Topics</li>
              <li>Cities</li>
              <li>Calender</li>
              <li>Community</li>
              <li>Interests</li>
            </ul>
          </div>
          <!-- Div 3 -->
          <div class="footer-div3">
            <h1 class="footer-div-header">Events</h1>
            <ul class="footer-ul">
              <li>Home</li>
              <li>About Us</li>
              <li>Apps</li>
              <li>Contact Us</li>
            </ul>
          </div>
          <!-- Div 4 -->
          <div class="footer-div4">
            <h1 class="footer-div-header">Your Account</h1>
            <ul class="footer-ul">
              <li>Sign Up</li>
              <li>Log In</li>
              <li>Help</li>
            </ul>
          </div>
          <!-- Div 5 -->
          <div class="footer-div5">
            <h1 class="footer-div-header">Legal</h1>
            <ul class="footer-ul">
              <li>Terms of Servce</li>
              <li>Privacy Policy</li>
              <li>Cookie Policy</li>
            </ul>
          </div>
        </div>
        <hr />
        <div class="footer-div-two">
          <div class="footer-div2-1">
            <p class="footer-p">
              <img src="./images/copyright.png" width="20px" class="cp" />
              &nbsp; Designed and developed by Tawiah Peacefill &nbsp;(UI) &
              Kelvin Kumordzi &nbsp;(Development)
            </p>
          </div>
          <div class="footer-div2-2">
            <p class="footer-p">
              Connect with Us - &nbsp;
              <img src="./images/insta.png" width="20px" />
              &nbsp;
              <img src="./images/facebook.png" width="20px" />
              &nbsp;
              <img src="./images/twitter.png" width="20px" />
              &nbsp;
              <img src="./images/linkedin.png" width="20px" />
            </p>
          </div>
        </div>
        <div id="git">
          <h2>
            <a href="https://github.com/Kelvinsgram/Event-SIte#event-site"
              ><i class="fa-brands fa-github"></i
            ></a>
          </h2>
        </div>
      </footer>
    </div>

    <script src="index.js"></script>
    <!-- Script for JS library -->
    <!-- <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init({
        offset: 200,
        duration: 900,
      });
    </script> -->
  </body>
</html>
