<?php 
    include("connexion.php");
    if(isset($_POST['envoyer'])){
        $login=$_POST['email'];
        if(filter_var($login, FILTER_VALIDATE_EMAIL)){
            $pass=uniqid();
            $sql="insert into sous_admin values('$login','$pass')";
            $res=mysqli_query($link,$sql);
            if($res){
                $message="Bonjour, votre Mot de passe en tant qu'organisateur est : $pass";
                $header ="From: 5254mohamed@gmail.com";
                $subject="Organisation";
                mail($login,$subject,$message,$header);
                header("Location: membre.php");
            }
        }
        else
            $error_message = 'Entrer une adresse email valide.';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Membre</title>
    <style>
        body {
            background-color: #0e0c20;
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }

        form {
            height: 200px;
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
        }

        form * {
            color: #ffffff;
        }

        label {
            display: block;
            margin-top: 8px;
            font-size: 16px;
            font-weight: 500;
        }

        input {
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.07);
            border-radius: 3px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
        }

        ::placeholder {
            color: #e5e5e5;
        }

        button {
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
    </style>
</head>
<body>
    <form action="" method="post">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" required="required" placeholder="Saisir une adresse email">
        <button type="submit" name="envoyer">Envoyer</button>
    </form>
</body>
</html>
