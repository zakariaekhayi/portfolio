<?php 
    session_start();
        if(isset($_POST['Proposer'])){
            include("connexion.php");
            $titre=htmlspecialchars($_POST['titre']); //cette fct est juste pour eviter de code html dans titre//
            $contenu=nl2br(htmlspecialchars($_POST['description']));
            $type=$_POST['type'];
            $date=$_POST['date'];
            $organisateurs=$_SESSION['login'];
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {   //je verifie si le fichier est bien choisie sabs aucun probleme
                $dossier = 'photo/';
                $temp_name = $_FILES['photo']['tmp_name'];
                if (!is_uploaded_file($temp_name)) {           //je verifie si le fichier est bien recupere
                    exit("le fichier est introuvable");
                }
                if ($_FILES['photo']['size'] >= 1000000) {
                    exit("le fichier est volumineaux");
                }
                $infosfichier = pathinfo($_FILES['photo']['name']);
                $extension_upl = $infosfichier['extension'];
                $extension_upl = strtolower($extension_upl);
                $ext_autori = array('png', 'jpg', 'jpeg');
                if (!in_array($extension_upl, $ext_autori)) {
                    exit("veuillez insere une svp(extension non autorisé)");
                }
                $nom_photo = $titre . "." . $extension_upl;
                if (!move_uploaded_file($temp_name, $dossier . $nom_photo)) {
                    exit("probleme dans le telechargement de l'image,Ressayer");
                }
                $ph_name = $nom_photo;
            } else    
                $ph_name = "inconnu.jpg";
            $sql="insert into article_proposé(titre,type_event,description,date,photo,organisateur) value('$titre','$type','$contenu','$date','$ph_name','$organisateurs')";
            $res=mysqli_query($link,$sql);
            header("Location: Vos_article.php");
        }
        else
            echo 'veuillez remplir les champs';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposer</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

form {
    max-width: 600px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-top: 10px;
    font-size: 16px;
}

input[type="text"],
input[type="date"],
select,
textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

textarea {
    resize: vertical;
}

input[type="file"] {
    margin-top: 10px;
}

input[type="submit"] {
    background-color: #e8491d;
    color: #fff;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #d3441a;
}

a {
    display: block;
    margin-top: 20px;
    text-align: center;
    color: #e8491d;
    text-decoration: none;
}

    </style>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="titre">Titre</label>
        <input type="text" id="titre" name="titre"><br>
        <label for="type">Type de l'evenement</label>
        <select name="type" class="inp">
        <?php
        include ("connexion.php");
        $sql="select * from type_event";
        $result=mysqli_query($link,$sql);
        while ($event=mysqli_fetch_assoc($result))
        {
        echo '<option value='.$event["id"].'>';
        echo $event["type"];
        echo'</option>';
        }
        ?>
        </select><br><br><br><br><br>
        <label for="descrip">description</label>
        <textarea name="description" id="descrip" cols="30" rows="10"></textarea><br>
        <input type="date" name="date" id=""><br><br>
        <input type="file" name="photo">
        <input type="submit" name="Proposer" value="Proposer">
    </form>
    <a href="panneaux_controle_sous.php">Panneaux de controle</a>
</body>
</html>