<?php
session_start();
$idg=$_SESSION['idg'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
		input,select{
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
	
			
			<label for="password">livre:</label><br>
            
			<select name="livre" id="livre" required>
    <?php
        include ("connexion.php");
        $sql="select * from livre";
        $result=mysqli_query($link,$sql);
        while ($titre_livre=mysqli_fetch_assoc($result))
        {
        echo '<option value='.$titre_livre["isbn"].'>';/** on peut faire facilment le colonne dans le tableau result */
        echo $titre_livre["titre_livre"];
        echo'</option>';
        }
        ?>
    </select><br>
    <label for="password">Etudiant</label><br>
			<select name="etud" id="etudiant" required>
    <?php
        include ("connexion.php");
        $sql="select * from etudiant";
        $result=mysqli_query($link,$sql);
        while ($liste_etudiant=mysqli_fetch_assoc($result))
        {
        echo '<option value='.$liste_etudiant["num_apogee"].'>';/** on peut faire facilment le colonne dans le tableau result */
        echo $liste_etudiant["nom"]."  ".$liste_etudiant["prenom"];
        echo'</option>';
        }
        ?>
    </select><br>
			
			<label for="password">date debut</label><br>
			<input type="date" id="password" name="db" required><br>
            <label for="password">date retour</label><br>
			<input type="date" id="password" name="dr"  required><br>
         

			<input class="submit" name="submit" type="submit" value="Enrigistrer">
		
		</form>
		
	</div>
</body>
</html>
<?php
if (isset($_POST['submit'])) {
    include("connexion.php");
    $livre = $_POST["livre"];
    $etud = $_POST["etud"];
    $db = $_POST["db"];
    $dr = $_POST["dr"];
   
  


    // Check if a file was uploaded


   



  
    $requete = "INSERT INTO emprunt (id_etudiant, id_livre, dt_debut, dt_retour, id_gestionaire) VALUES (  '$etud',' $livre', '$db',' $dr',' $idg')";

    $res = mysqli_query($link, $requete);
   

    if ($res) {
        echo '<div >
        <p style="color: black;">Félicitations! Votre emprunt a été ajoutee correctement</p>
        </div>';
        header("Location: le.php");
        exit();
       
    } else {
        echo '<h1 style="color:black; text-align:center;">Erreur de ajoutation de votre emprunt</h1>';
    }
}
?>
