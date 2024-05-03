












<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="signup.css">
      <!-- Design by foolishdeveloper.com -->
      <title>Glassmorphism login Form Tutorial in html css</title>
 
 <link rel="preconnect" href="https://fonts.gstatic.com">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
 <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
 <!--quelle que soit le device le design va etre comme un pc-->

    <style media="screen">

      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
fieldset {
    height: 1000px; /* Adjust the height as needed */
    margin-top: 20px; /* Add margin for better spacing */
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
    height: 800px;
    width: 800px;
    background-color: rgba(255,255,255,0.13);
    position: relative;
 
    margin-top: 450px;
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
    width: 60%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
.inp{  display: block;
    height: 50px;
    width: 60%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;



}
#sel {
    background-color: #6c7182;
    /* Add other styles as needed */
}

::placeholder{
    color: #e5e5e5;
}
button,.sub{
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
.np{
    display: inline-block;
    width: 300px;
}
.ep{
    position: absolute;
    display: inline-block;
    width: 500px;
    
}
a{
    margin-top: 50px;
    width: 100%;
    
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
}
.lg:hover{
color: #f18953;
text-decoration: none;

}
.lg{
    color: white;
}



    </style>
</head>
<body>
<div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
   

    <form action="" method="post" enctype="multipart/form-data"><!--j'ai pas fait du action car le php est dans la meme page-->
        <h2>Créer un compte:</h2>
        <div class="np"><label for="Nom" class="label">Nom</label>
        <input type="text" name="Nom" id="Nom"  class="inp">
        <label for="Prenom" class="label">Prenom</label>
        <input type="text" name="Prenom" id="Prenom"  class="inp"></div>
        <div class="ep"><label for="Email" class="label">Email</label>
        <input type="text" name="Login" id="Email" class="inp">
        <label for="pass" class="label">Password</label>
        <input type="password" name="password" id="pass"  class="inp"></div>
        <label for="fichier">fichier</label>
        <input type="file"  name="fichier" value="Valider">
        <div class="ville"><label for="Ville" class="label">Ville</label>
        <select name="txt_ville" class="inp" id="sel">
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
        </select></div> 
        <div class="date"> <label for="date" class="label">Date de Naissance</label>
        <input type="text" name="date" id="date"  class="inp" placeholder="exemple:2000-01-01"><br></div>
       <div class="submit"> <input type="submit" name="envoyer" value="S'inscrire"  class="sub"></div>
     
       
        
    </form>
  
</body>
</html>

       

<?php if(isset($_POST['envoyer'])){
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


        if(isset($_FILES['fichier'])and $_FILES['fichier']['error']==0)//si on a insere le ficher
        {
            $dossier='photo/';
            $temp_name=$_FILES['fichier']['tmp_name'];//ce qui est entre crochet tmp_name c'est prdefinie  et fichier c'est le name de fichier
            if(!is_uploaded_file($temp_name)){
                exit(
                    "le fichier est untouvable"
                );}
                
                
                if($_FILES['fichier']['size']>=100000){
                    exit("Erreur , le fichier est volumineux");


                }



                $infofichier=pathinfo($_FILES['fichier']['name']);//je recuper l'extension du fichier pour l'utiliser dans une condition
                $extension_upload=$infofichier['extension'];
                $extension_upload=strtolower($extension_upload);
                $extension_autorisees=array('png','jpeg','jpg');//ce tableau comapre
                if(!in_array($extension_upload,$extension_autorisees)){//retourne 1 si extension_upload est l'un des element de tableau extension_autorises
                    exit("Erreur,Veuiller inser l'extension autorise");
                }




                 $nom_photo=$email.".".$extension_upload;//pour eviter que user avoir le meme nom du photo donc je la nommer par son login@gmail.com.jpg le cle primaire le point represente la concatenantion
                 if(!move_uploaded_file($temp_name,$dossier.$nom_photo))//l'image avec nom temporaire va etre deplacer dans repartoire dossier dans notre cas c'est  fichier photo  par email@gmail.com.png par exemple
                 {
                    exit("Problem dans le telchargemnt de l'image,Ressayer");
                 }


                 $ph_name=$nom_photo;//on a fait ca pour le r'utiliser dans else du cas ou l user n'a pas entre image pour dir ph_name="inconnu.jpg"
                

        }
        else{
            $ph_name="inconnu.jpg";

        }
        $requette="INSERT INTO user  (LOGIN,PASSWORD,NOM,PRENOM,VILLE,DATE_NAISSANCE,image) values('$email','$pass','$nom','$prenom','$ville','$date_naissance','$ph_name')";//ph_name nom de la photo
        $res=mysqli_query($link,$requette);//pour appliquer la demande $link est predefinie
     // si vous voulez un redirection dirctemnt vers page apres login  header('location:newindex.html');


     if ($res==true) {
        echo '<div style="position: absolute; top: 76%; left: 70%; transform: translate(-50%, -50%); background: linear-gradient(#6c7182, #6c7182); width: 100px; height: 180px; text-align: center; padding: 10px;">
        <p style="color: black;">Félicitation Votre compte a été créé correctement</p>
        <br>
        <a href="Login.php" class="lg" >Login Now</a>
      </div>';



        }
    else{
        echo "Erreur lors de la création de votre compte";
        }
}

   ?>