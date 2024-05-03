<?php
    if(isset($_POST['envoyer'])){
        session_start();
        $raison=$_POST['raison'];
        include("connexion.php");
        $id=$_GET['id'];
        $sql="update article_proposé set etat='supprime' where id=$id";
        $res=mysqli_query($link,$sql);
        if($res){
            $email=$_SESSION['login'];
            $message="Bonjour votre proposition est refuse:$raison";
            $header ="From: 5254mohamed@gmail.com";
            $subject="Authentification";
            mail($email,$subject,$message,$header);
            header("Location: contenu_proposer.php");


        }
        else
            echo 'il ya un probleme';
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>suppresion</title>
        <style>
            body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

form {
    width: 400px;
    margin: auto;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
}

label {
    display: block;
    margin-bottom: 10px;
    font-size: 16px;
}

textarea {
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
        <form action="" method="post">
            <label for="raison">Pour quelle raison vous refusez ce article</label><br>
            <textarea name="raison" id="raison" cols="30" rows="10"></textarea><br>
            <input type="submit" name="envoyer">
        </form>
    </body>
    </html>