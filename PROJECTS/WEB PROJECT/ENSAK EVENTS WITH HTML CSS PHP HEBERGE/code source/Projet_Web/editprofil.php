<?php 

session_start();
if(!$_SESSION['id_user']){
    header("Location: Login.php");
    exit;
}

$email=$_SESSION['id_user'] ;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <style>
body{
    background-color: wheat;
}
    form {
        height: 620px;
        width: 400px;
        background-color: rgba(255, 255, 255, 0.13);
        position: absolute;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 50%;
        border-radius: 10px;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
        padding: 50px 35px;
        background-color: #f18953;
    }

    label {
       
    }

   

    </style>
</head>
<body>
<div id="navbar">
          <div id="hero--logo">
            <img
              src="./images/event_logo.png"
              width="200px"
              class="hero-logo"
            />
          </div>
<form action="" method="post" enctype="multipart/form-data">
        <h2>Modifier votre profile:</h2>
        <label for="Nom" class="label">Nouveau nom:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="Nom" id="Nom"  class="inp"><br><br>

        <input type="submit" name="e1" value="Modifier"  class="sub"><br><br>
     
        <label for="Prenom" class="label">Nouveau Prenom:</label>&nbsp;&nbsp;&nbsp;
        <input type="text" name="Prenom" id="Prenom"  class="inp"><br><br>

        <input type="submit" name="e2" value="Modifier"  class="sub"><br><br>
     
        <label for="Email" class="label">Nouveau Email:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="Login" id="Email" class="inp"><br><br>

        <input type="submit" name="e3" value="Modifier"  class="sub"><br><br>
     
        <label for="pass" class="label">Nouveau Password:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="password" name="password" id="pass"  class="inp"><br><br>

        <input type="submit" name="e4" value="Modifier"  class="sub"><br><br>

        <label for="fichier">Nouveau Fichier:</label><br><br>
        <input type="file"  name="fichier" ><br><br>

        <input type="submit" name="e5" value="Modifier"  class="sub"><br><br>
     
        <label for="Ville" class="label">Nouveau Ville:</label>
        <select name="txt_ville" class="inp" id="sel"><br><br>
        <?php
        include ("connexion.php");
        $sql="select * from ville";
        $result=mysqli_query($link,$sql);
        while ($liste_ville=mysqli_fetch_assoc($result))
        {
        echo '<option value='.$liste_ville["id_ville"].'>';/** on peut faire facilment le colonne dans le tableau result */
        echo $liste_ville["lib_ville"];
        echo'</option>';
        }
        ?>
        </select> <br><br>
        <input type="submit" name="e6" value="Modifier"  class="sub"><br><br>
     
      <label for="date" class="label">Date de Naissance:</label>
        <input type="date" name="date" id="date"  class="inp" placeholder="exemple:2000-01-01"><br><br>
     <input type="submit" name="e7" value="Modifier"  class="sub">
     
       
        
    </form>
</body>
</html>
<?php
if (isset($_POST['e1'])) {
    $nom = $_POST["Nom"];
    $sqlnom = "UPDATE user SET NOM = '$nom' where LOGIN='$email'";
    $res = mysqli_query($link, $sqlnom);
    if ($res == true) {
        echo 'Modification ont effectue avec succes';
    }
}
if (isset($_POST['e2'])) {
    $prenom = $_POST["Prenom"];
    $sqlprenom = "UPDATE user SET PRENOM = '$prenom' where LOGIN='$email'";
    $res = mysqli_query($link, $sqlprenom);
    if ($res == true) {
        echo 'Modification ont effectue avec succes';
    }
}
if (isset($_POST['e3'])) {
    $email = $_POST["Login"];
    $sqlemail = "UPDATE user SET LOGIN = '$email'   where LOGIN='$email' ";
    $res = mysqli_query($link, $sqlemail);
    if ($res == true) {
        echo 'Modification ont effectue avec succes';
    }
}
if (isset($_POST['e4'])) {
    $pass = $_POST["password"];
    $sqlpass = "UPDATE user SET PASSWORD = '$pass'   where LOGIN='$email' ";
    $res = mysqli_query($link, $sqlpass);
    if ($res == true) {
        echo 'Modification ont effectue avec succes';
    }

}

if (isset($_POST['e6'])) {
    $ville = $_POST["txt_ville"];
    $sqlville = "UPDATE user SET VILLE = '$ville' where LOGIN='$email' ";
    $res = mysqli_query($link, $sqlville);
    if ($res == true) {
        echo 'Modification ont effectue avec succes';
    }
}
if (isset($_POST['e7'])) {
    $date = $_POST["date"];
    $sqldate = "UPDATE user SET DATE_NAISSANCE = '$date'  where LOGIN='$email' ";
    $res = mysqli_query($link, $sqldate);
    if ($res == true) {
        echo 'Modification ont effectue avec succes';
    }
}



?>