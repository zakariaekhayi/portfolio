<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer Membre</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 50%;
            margin: 0 auto;
        }

        .message {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
            border-radius: 4px;
        }

        .message.success {
            color: #4CAF50;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .message.error {
            color: #D9534F;
            background-color: #f2dede;
            border-color: #ebccd1;
        }

        .back-button {
            display: inline-block;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            border: 2px solid #333;
            color: #333;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <?php
        $bdd = new PDO('mysql:host=localhost;dbname=gestion', 'root', '');
        if (isset($_GET['id'])) {
            $get_id = $_GET['id'];
            $res = $bdd->prepare("select * from sous_admin where LOGIN=?");
            $res->execute(array($get_id));

            if ($res->rowCount() > 0) {
                $banirUser = $bdd->prepare("delete  from sous_admin where LOGIN=?");
                $banirUser->execute(array($get_id));
                echo '<div class="container">';
                echo '<div class="message success">Membre supprimé avec succès.</div>';
                echo '<a href="membre.php" class="back-button">Retour à la liste des membres</a>';
                echo '</div>';
            } else {
                echo '<div class="container">';
                echo '<div class="message error">Aucun membre récupéré.</div>';
                echo '<a href="membre.php" class="back-button">Retour à la liste des membres</a>';
                echo '</div>';
            }
        } else {
            echo '<div class="container">';
            echo '<div class="message error">L\'ID n\'est pas bien récupéré.</div>';
            echo '<a href="membre.php" class="back-button">Retour à la liste des membres</a>';
            echo '</div>';
        }
    ?>
</body>
</html>
