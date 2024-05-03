<?php
    session_start();
    include("connexion.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles en attente</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center; /* Ajout de la propriété pour centrer le contenu horizontalement */
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
        }

        nav {
            text-align: center;
            margin-bottom: 20px;
        }

        nav a {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 10px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #ddd;
        }

        .article {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .article h1 {
            color: #333;
        }

        .article p {
            color: #555;
            margin-bottom: 10px;
        }

        .article img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .button-container {
            text-align: center;
        }

        .button-container a {
            text-decoration: none;
        }

        .button-publier, .button-supprimer {
            display: inline-block;
            padding: 8px 16px;
            margin: 4px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            border: 2px solid #d9534f;
            color: #d9534f;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .button-publier:hover, .button-supprimer:hover {
            background-color: #d9534f;
            color: #fff;
        }

        .admin-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #333;
            border: 2px solid #333;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .admin-link:hover {
            background-color: #555;
            border-color: #555;
        }

        .no-articles {
            text-align: center;
            color: #555;
        }
    </style>
</head>
<body>

    <header>
        <h1>Articles en attente de publication</h1>
    </header>
    <?php
        $sql = "select * from article_proposé where etat='en attente'";
        $trou = mysqli_query($link, $sql);

        if (mysqli_num_rows($trou) > 0) {
            while ($article = mysqli_fetch_assoc($trou)) {
    ?>
                <div class="article">
                    <h1><?= $article['titre']; ?></h1>
                    <p><?= $article['description']; ?></p>
                    <img src="photo/<?= $article['photo'] ?>" alt="">
                    <div class="button-container">
                        <a href="publier-article-propose.php?id=<?= $article['id']; ?>" class="button-publier">Publier</a>
                        <a href="supprimer_article_propose.php?id=<?= $article['id']; ?>" class="button-supprimer">Supprimer</a>
                    </div>
                </div>
    <?php
            }
        } else {
            echo '<div class="no-articles">Aucun article en attente.</div>';
        }
        echo '<a href="espace_admin.php" class="admin-link">Espace Admin</a>';
    ?>

</body>
</html>
