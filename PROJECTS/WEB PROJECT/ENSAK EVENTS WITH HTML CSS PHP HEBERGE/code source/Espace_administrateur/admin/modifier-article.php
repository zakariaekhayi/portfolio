<?php
    session_start();
    $bdd=new PDO('mysql:host=localhost;dbname=gestion','root','');
    if(!$_SESSION['admin']){
        header("Location: index.php");
        exit;
    } else {
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $get=$_GET['id'];
            $sql=$bdd->prepare("select * from article where id=?");
            $sql->execute(array($get));
            if($sql->rowCount()>0){
                $article=$sql->fetch();
                $_titre=$article['titre'];
                $_desc=$article['description'];
                $date=$article['date'];
                $image=$article['photo'];
            } else {
                exit;
            }
            
            if(isset($_POST['envoyer'])){
                $tit=$_POST['titre'];
                $des=$_POST['description'];
                if(isset($_FILES['image']) && $_FILES['image']['error']==0){
                    $dossier='photo/';
                    $temp_name=$_FILES['image']['tmp_name'];
                    if(!is_uploaded_file($temp_name)){
                        exit("le fichier est introuvable");
                    }
                    if($_FILES['image']['size']>=1000000){
                        exit("le fichier est très volumineux");
                    }
                    $info=pathinfo($_FILES['image']['name']);
                    $extension=$info['extension'];
                    $extension=strtolower($extension);
                    $ext=array('jpg','jpeg','png');
                    if(!in_array($extension,$ext)){
                        exit("l'extension doit être jpg, jpeg ou png");
                    }
                    $nom_photo=$get.".".$extension;
                    if(!move_uploaded_file($temp_name,$dossier.$nom_photo)){
                        exit("problème dans le téléchargement de l'image, Réessayez");
                    }
                    $photo_name=$nom_photo;
                } else {
                    $photo_name="$image";
                }
                $res=$bdd->prepare("select * from article where id=?");
                $res->execute(array($get));
                if($res->rowCount()>0){
                    $modi = $bdd->prepare("UPDATE article SET titre=?, description=?,photo=?,date=? WHERE id=?");
                    $modi->execute(array($tit,$des,$photo_name,$get,$date));
                    header("Location:article.php");
                } else {
                    echo 'aucun article trouvé';
                }
            }
        } else {
            echo 'aucun article récupéré';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un article</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ecf0f1; /* Gris clair */
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
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
    </style>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="titre">Nom de l'événement:</label>
        <input type="text" name="titre" id="titre" value="<?=$_titre;?>"><br>

        <label for="description">Description de l'événement:</label>
        <textarea name="description" id="description" cols="30" rows="10"><?=$_desc;?></textarea><br>
        <input type="date" name="date" id=""><br><br>
        <label for="image">Choisir une nouvelle photo:</label>
        <input type="file" name="image" id="image"><br><br>

        <input type="submit" name="envoyer" value="Modifier">
    </form>
</body>
</html>
