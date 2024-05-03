<?php 
    if(isset($_POST['envoyer'])){
        session_start();
        include("connexion.php");
        $email=$_POST["Login"];
        $pass=$_POST["password"];
        $nom=$_POST["Nom"];
        $prenom=$_POST["Prenom"];
        $ville=$_POST["txt_ville"];
        $date_naissance=$_POST["date"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            exit("Adresse e-mail invalide.");
        }
        $_SESSION['email']=$email;
        $_SESSION['pass']=$pass;
        $_SESSION['nom']=$nom;
        $_SESSION['prenom']=$prenom;
        $_SESSION['ville']=$ville;
        $_SESSION['DN']=$date_naissance;
        $verification=uniqid();
        $_SESSION['verification']= $verification;
        $message="Bonjour votre password est: $verification";
        $header ="From: 5254mohamed@gmail.com";
        $subject="Mot de passe";
        if(mail($email,$subject,$message,$header)){
            header("Location: verification.php");
        }
        else
            echo'un probleme';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
   

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
    height: 850px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 60%;
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
#space h6 {
    color: #001F3F;
}
select[name="txt_ville"] {
    background-color: #001F3F; /* Choisis une couleur de fond qui rend le texte plus lisible */
    /* Autres styles que tu pourrais ajouter selon tes préférences */
}


    
    </style>
    
</head>
<body>
    <fieldset style="width: 800px;">

    <form action="" method="post">
        <h2>Créer un compte:</h2>
        <label for="Nom" class="label">Nom</label>
        <input type="text" name="Nom" id="Nom"  class="inp"><br>
        <label for="Prenom" class="label">Prenom</label>
        <input type="text" name="Prenom" id="Prenom"  class="inp"><br>
        <label for="Email" class="label">Email</label>
        <input type="text" name="Login" id="Email" class="inp"><br>
        <label for="pass" class="label">Password</label>
        <input type="password" name="password" id="pass"  class="inp"><br>
        <label for="Ville" class="label">Ville</label>
        <select name="txt_ville" class="inp">
        <?php
        include ("connexion.php");
        $sql="select * from ville";
        $result=mysqli_query($link,$sql);
        while ($liste_ville=mysqli_fetch_assoc($result))
        {
        echo '<option value='.$liste_ville["id_ville"].'>';
        echo $liste_ville["lib_ville"];
        echo'</option>';
        }
        ?>
        </select><br>
        <label for="date" class="label">Date de Naissance</label>
        <input type="text" name="date" id="date"  class="inp" placeholder="exemple:2000-01-01"><br>
        <input type="submit" name="envoyer" value="S'inscrire">
        <div id="space">
            <h6>.</h6>
            <h6>.</h6>
            <h6>.</h6>
            <h6>.</h6>
            <h6>.</h6>
            <h6>.</h6>
            <h6>.</h6>
            <h6>.</h6>
            <h6>.</h6>
        </div>
    </form>
    </fieldset>
</body>
</html>
