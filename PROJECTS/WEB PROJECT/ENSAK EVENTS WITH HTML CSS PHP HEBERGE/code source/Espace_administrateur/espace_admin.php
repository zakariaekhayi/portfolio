<?php 
    session_start();
    if(!$_SESSION['admin']){
        header("Location: index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ecf0f1; /* Gris clair */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        header {
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            margin-bottom:5%
        }

        h1 {
            margin-bottom: 20px;
        }

        div {
            width: 30%;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        a {
            display: block;
            margin-bottom: 10px;
            color: #3498db;
            text-decoration: none;
            text-align: center;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Espace Admin</h1>
    </header>

    <div>
        <a href="membre.php">Afficher les membres</a>
        <a href="publier-article.php">Publier de nouveaux articles</a>
        <a href="article.php">Afficher tous les articles</a>
        <a href="contenu_proposer.php">Proposition des Clubs</a>
        <a href="HTML.php">Voir en tant qu'utilisateurs</a>
    </div>
</body>
</html>
