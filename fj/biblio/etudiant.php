
<!DOCTYPE html>
<html>
<head>
	<title>liste etud</title>
	<style>
         table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd; /* Border at the bottom of each cell */
    }

    th {
        background-color: #f2f2f2; /* Background color for header cells */
    }

body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

.menu {
    background-color: blue;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

li {
    float: left;
    margin-right: 90px;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover {
    background-color: #111;
}
h1{
    background-color: gray;
    color: white;
    padding: 30px;
    height: 30px;
}
form{
	
		width: 600px;
			height: 600px;
            
            margin: 60px;
            margin-left: 0px;

		}
		input{
			margin-top: 20px;
			width: 500px;
			margin: 20px;
			height: 40px;
            border: black solid 2px;
			border-radius: 10px;
		}
		.submit{
			background-color: blue;
			border: 2px white solid;
			width: 100px;
			border-radius: 10px;
			color: white;
		
			height: 40px;
			margin-bottom: 0px;
		}
		label{
			margin: 20px;
		}
		h1{
			margin-left: 20px;
		}
		p{
			margin-left: 30px;
			margin-top: 0px;
		}





	</style>
</head>
<body>
    
<div class="menu">
    <ul>
    <li><a href="liste_e.php">Liste etudiant</a></li>
        <li><a href="ll.php">Liste livre</a></li>
        <li><a href="le.php">Liste des empreintes</a></li>
        <li><a href="emprunt.php">Ajouter une emprunt</a></li>
        <li><a href="etudiant.php">Ajouter etudiant</a></li>
        <li><a href="livre.php">Ajouter livre</a></li>
    </ul>
</div>
	<div style="margin: 0 auto; width: 300px; margin-left:500px;">
	
		<form action="" method="post" enctype="multipart/form-data">
	
			<label for="login">Nom:</label><br>
			<input type="text" id="login" name="nom" required><br>
			<label for="password">Prenom:</label><br>
			<input type="text" id="password" name="prenom" required><br>
            <label for="login">num_apogee</label><br>
			<input type="text" id="login" name="numapp" required><br>
			
            <label for="password">Photo</label><br>
			<input type="file" id="password" name="fichier"  required><br>
			<input class="submit" name="submit" type="submit" value="Enrigistrer">
		
		</form>
		
	</div>
</body>
</html>
<?php
if (isset($_POST['submit'])) {
    include("connexion.php");
    $numapp = $_POST["numapp"];

    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
  


    // Check if a file was uploaded


    if (!isset($_POST['numapp'])) {
        exit('<h1 style="color:black; text-align:center; position:absolute; top:0%;">Erreur de saisie<br> de numapp</h1>');

    }



    if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] ==0) {
        $dossier = 'photo/';//on a definit where on va stocker les photos inserees
        $temp_name = $_FILES['fichier']['tmp_name'];//at the FILE tmp_name is the real name of fichier

        if (!is_uploaded_file($temp_name)) {
            exit('<h1 style="color:black; text-align:center;">Erreur, le fichier est introuvable</h1>');//faire attention de ""et \ il fuat les garder dans \
        }

        if ($_FILES['fichier']['size'] >= 10000000) {
            exit('<h1 style="color:black; text-align:center;">Erreur, le fichier est volumineux</h1>');//faire attention de ""et \ il fuat les garder dans \

        }

        $infofichier = pathinfo($_FILES['fichier']['name']);
        $extension_upload = strtolower($infofichier['extension']);
        $extension_autorisees = array('png', 'jpeg', 'jpg');

        if (!in_array($extension_upload, $extension_autorisees)) {
            exit('<h1 style="color:black; text-align:center;">Erreur veuillez saisir l\'extension autorisee</h1>');//faire attention de ""et \ il fuat les garder dans \

        }

        $nom_photo = $numapp. "." .$extension_upload;

        if (!move_uploaded_file($temp_name, $dossier . $nom_photo)) {//her where le fichier par son nom realle quon le met temprairement on le stocke dant phot par son nouvelle nom dans ce cas numapp
            exit('<h1 style="color:black; text-align:center;">Problème dans le téléchargement de l\'image, réessayez</h1>');//faire attention de ""et \ il fuat les garder dans \

        }
    } else {
        $nom_photo = "inconnu.jpg";
    }
    $requete = "INSERT INTO etudiant (num_apogee, nom, prenom, image) VALUES (  '$numapp','$nom', '$prenom','$nom_photo')";

    $res = mysqli_query($link, $requete);
    
   

    if ($res) {
        echo '<div >
        <p style="color: black;">Félicitations! Votre compte a été modifie correctement</p>
        </div>';
        header("Location: liste_e.php");
        exit();
       
    } else {
        echo '<h1 style="color:black; text-align:center;">Erreur de modification de votre compte</h1>';
    }
}
?>
