<?php 
session_start();//pour interagir session start et faire le choix d'une ligne parmis plusieur ligne du tableau et pour connaitre le profil de l'utilsateur actuelle 
if(isset($_POST['envoyer'])){
    $email = $_POST['login']; // Utilisation de 'Login' ici
    $pass = $_POST['password'];
    if ((empty($email) or empty($pass))) {
        $_SESSION['erreur'] = '<div style="position: absolute; top: 76%; left: 70%; transform: translate(-50%, -50%); background: linear-gradient(#6c7182, #6c7182); width: 100px; height: 180px; text-align: center; padding: 10px;">
        <p style="color: black;">Ereur de saisie</p><div>';


        echo  $_SESSION['erreur'];//tableau superglobale SESSION pour session erreur si email ou motde passe faux ne permet pas de faire session c-a-d login as user
        unset( $_SESSION['erreur']);//destroy the error session variable and unset destroy variables and,
    } else {
        $link = mysqli_connect("localhost","root","","biblio");// pour se connecter a la base de donne gestionconnexion.php
      

        if ($link) {//si la connexion est s'effectue
            // Utilisation de 'LOGIN' ici
            $sql = "SELECT * FROM gestionaire WHERE login='$email'and pass='$pass'";//
            $result = mysqli_query($link, $sql);

            if (mysqli_num_rows($result) > 0) {//Retourne nombre de colones dans le resulta du l'application de requete $result
                $row = mysqli_fetch_assoc($result);//parcourir ligne par ligne si on a while ou ligne courante si on a pas
                if ($row && $row['pass'] == $pass) {//si le password est vrai et le login
                   
                    $_SESSION['prenom'] = $row['prenom'];
                    $_SESSION['nom'] = $row['nom'];
                   $_SESSION['email'] = $row['login'];//Login in db is the email and email is a PK
				   $_SESSION['password']=$row['pass'];
                   $_SESSION['idg']=$row['id_gestionaire'];
               

                    session_write_close();//The session_write_close() function in PHP is used to end the session and store the session data.
          header('Location: menu.php');
		
					  
                } else {
                    $_SESSION['error1']='<h1 style="color:black; text-align:center;">Le mot de passe ou Login est incorrecte</h1>';
                    echo $_SESSION['error1'];
                    unset($_SESSION['error1']);
                }
            } else {
                $_SESSION['error2']='<h1 style="color:black; text-align:center;">Le Login est incorrecte</h1>';
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
<html>
<head>
	<title>Login</title>
	<style>
		div{
			width: 600px;
			height: 600px;
		}

		form{
		border: 2px black solid;
		width: 300px;
			height: 420px;

		}
		input{
			margin-top: 20px;
			width: 250px;
			margin: 20px;
			height: 40px;
			border-radius: 10px;
		}
		.submit{
			background-color: blue;
			border: 2px white solid;
			width: 250px;
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
<>
	<div style="margin: 0 auto; width: 300px; ">
	
		<form action="" method="post">
		<h1>Connexion</h1>
			<label for="login">Login:</label><br>
			<input type="text" id="login" name="login" required><br>
			<label for="password">Password:</label><br>
			<input type="password" id="password" name="password" required><br>
			<input class="submit" type="submit"  value="Se connecter"   name="envoyer">
	
		</form>
		
	</div>
</body>
</html>