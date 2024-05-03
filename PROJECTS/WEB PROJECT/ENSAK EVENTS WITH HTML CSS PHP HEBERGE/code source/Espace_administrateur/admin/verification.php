<?php
    session_start();
    include("connexion.php");
    if(isset($_SESSION['email'])){
        if(isset($_POST['envoyer'])){
            if($_SESSION['verification']==$_POST['verification']){
                $email=$_SESSION['email'];
                $pass=$_SESSION['pass'];
                $nom=$_SESSION['nom'];
                $prenom=$_SESSION['prenom'];
                $ville=$_SESSION['ville'];
                $date_naissance=$_SESSION['DN'];
                $sql="insert into user values('$email','$pass','$nom','$prenom',$ville,'$date')";
                $res=mysqli_query($link,$sql);
                if(isset($res)){
                    header("Location: Login.php");
                }
            }
            else
                echo 'Veuillez Entrer un Veification valide';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

div {
    width: 400px;
    margin: auto;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 10px;
    font-size: 16px;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

input[type="submit"] {
    background-color: #d9534f;
    color: #fff;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #c9302c;
}

    </style>
</head>
<body>
    <div>
        <form action="" method="post">
            <label for="veri">Entrer le code reçoie par email</label>
            <input type="text" name="verification"><br>
            <input type="submit" name="envoyer" id="">
        </form>
    </div>
    
</body>
</html>
