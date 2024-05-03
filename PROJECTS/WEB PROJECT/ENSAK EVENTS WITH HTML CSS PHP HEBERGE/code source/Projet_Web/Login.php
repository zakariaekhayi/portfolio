
<?php 
session_start();//pour interagir session start et faire le choix d'une ligne parmis plusieur ligne du tableau et pour connaitre le profil de l'utilsateur actuelle 
if(isset($_POST['envoyer'])){
    $email = $_POST['Login']; // Utilisation de 'Login' ici
    $pass = $_POST['pass'];
    if ((empty($email) or empty($pass))) {
        $_SESSION['erreur'] = '<div style="position: absolute; top: 76%; left: 70%; transform: translate(-50%, -50%); background: linear-gradient(#6c7182, #6c7182); width: 100px; height: 180px; text-align: center; padding: 10px;">
        <p style="color: black;">Ereur de saisie</p><div>';


        echo  $_SESSION['erreur'];//tableau superglobale SESSION pour session erreur si email ou motde passe faux ne permet pas de faire session c-a-d login as user
        unset( $_SESSION['erreur']);//destroy the error session variable and unset destroy variables and,
    } else {
        $link = mysqli_connect("localhost","root","","gestion");// pour se connecter a la base de donne gestionconnexion.php
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {// filter_var fonction filtre retourne 1 si il peux  filtrer un variable(dans ce cas email) si non il retourne 0 avec le filtre FILTER_VALIDATE_EMAIL est un filtre predefinie de les email qui doivent etere @gmail.com 
            exit("Adresse e-mail invalide.");
        }

        if ($link) {//si la connexion est s'effectue
            // Utilisation de 'LOGIN' ici
            $sql = "SELECT * FROM user WHERE LOGIN='$email'";//
            $result = mysqli_query($link, $sql);

            if (mysqli_num_rows($result) > 0) {//Retourne nombre de colones dans le resulta du l'application de requete $result
                $row = mysqli_fetch_assoc($result);//parcourir ligne par ligne si on a while ou ligne courante si on a pas
                if ($row && $row['PASSWORD'] == $pass) {//si le password est vrai et le login
                    session_start();
                    $_SESSION['prenom'] = $row['PRENOM'];
                    $_SESSION['nom'] = $row['NOM'];
                   $_SESSION['id_user'] = $row['LOGIN'];//Login in db is the email and email is a PK
                    session_write_close();//The session_write_close() function in PHP is used to end the session and store the session data.
                    header("Location: newindex.php");
                    exit(); 
                } else {
                    $_SESSION['error1']='<h1 style="color:white; text-align:center;">Le mot de passe ou Login est incorrecte</h1>';
                    echo $_SESSION['error1'];
                    unset($_SESSION['error1']);
                }
            } else {
                $_SESSION['error2']='<h1 style="color:white; text-align:center;">Le Login est incorrecte</h1>';
                echo $_SESSION['error2'];
                unset($_SESSION['error2']);
            }

            mysqli_close($link);
        } else {
            die("Echec de la connexion:" .mysqli_connect_error());//The die() function in PHP is used to print a message and terminate the script execution. In your specific example, it is used to display an error message if a MySQLi connection fails.
        }
    }
}?>










<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Glassmorphism login Form Tutorial in html css</title>
  

</head>
<body>
<!-- partial:index.partial.html -->
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Glassmorphism login Form Tutorial in html css</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #0e0c20;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    height: 520px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;

}

form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
button{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}





    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    
    <form action="" method="post"><!--j' ai pas fais action car je fait php et html dans la meme page-->
        <h3>Login Here</h3>

        <label for="username" >Username</label>
        <input type="text" name="Login" placeholder="Email or Phone" id="username">

        <label for="password" >Password</label>
        <input type="password" name="pass" placeholder="Password" id="password">



        

       
        <button name="envoyer">Log In</button>
       
        <div class="social">
          <div class="go"><i class="fab fa-google"></i>  Google</div>
          <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
        </div>


    </form>

 

   </body>
 
</html>
<!-- partial -->
  
</body>
</html>


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      /* Default styles for the 'a' element */
a {
    display: inline-block;
    position: absolute;
    left: 39%;
    top: 58%;
    text-decoration: none;
    color: black;
    background-color: white;
    border-radius: 5%;
    padding: 2px;
    box-sizing: border-box;
}

/* Media query for phones (adjust as needed) */
@media only screen and (max-width: 767px) {
    a {
        left: 32%;
        top: 62%;
       
    }
}


    </style>
</head>
<body>
   <h3><a href="forgot_password.php">Mot de passe oublié</a></h3> 
</body>
</html>
