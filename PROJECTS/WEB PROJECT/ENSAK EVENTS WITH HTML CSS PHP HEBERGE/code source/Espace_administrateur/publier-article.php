<?php 
    session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=gestion','root','');
    if (!$_SESSION['admin']) {
        header("Location: index.php");
    }
    if (isset($_POST['envoyer'])) {
        if (!empty($_POST['titre']) && !empty($_POST['description'])) {
            $titre = htmlspecialchars($_POST['titre']); //cettre fct est juste pour eviter de code html dans titer//
            $contenu = nl2br(htmlspecialchars($_POST['description'])); //cette fct est utilise pour n'est pas suprime les saut de lignes lorsque on le recupere au niveau de vbase de donnée//
            $date=$_POST['date'];
            $type=$_POST['type'];
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
            $res = $bdd->prepare("insert into article(titre,type_event,description,photo,date) value (?,?,?,?,?)");
            $res->execute(array($titre,$type, $contenu, $nom_photo,$date));
            echo 'l\'article a bien été envoyer';
        } else
            echo 'veuillez remplir tous les champs';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier un article</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ecf0f1; /* Gris clair */
            margin: 20px; /* Ajout de marge en haut */
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
        }

        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        textarea,
        input[type="file"],
        input[type="submit"] {
            margin-bottom: 10px;
            display: block;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #2ecc71; /* Vert */
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #27ae60; /* Vert plus foncé au survol */
        }
        select[name="type"] {
    background-color:#2ecc71;
    color: #ecf0f1;
     /* Choisis une couleur de fond qui rend le texte plus lisible */
    /* Autres styles que tu pourrais ajouter selon tes préférences */
    }
    </style>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="titre">Nom de l'événement:</label>
        <input type="text" name="titre" id="titre"><br>
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
        <label for="description">Description de l'événement:</label>
        <textarea name="description" id="description" cols="30" rows="10"></textarea><br>
        <input type="date" name="date" id=""><br><br>
        <label for="photo">Choisir une photo:</label>
        <input type="file" name="photo" id="photo"><br><br>

        <input type="submit" name="envoyer">
    </form>
</body>
</html>
