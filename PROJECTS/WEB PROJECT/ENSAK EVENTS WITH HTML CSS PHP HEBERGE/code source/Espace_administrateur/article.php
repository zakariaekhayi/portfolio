<?php 
    session_start();
    $bdd=new PDO('mysql:host=localhost;dbname=gestion','root','');
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
    <title>Afficher tous les articles</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }

        .button-container {
            text-align: center;
        }

        .button-container a {
            text-decoration: none;
        }

        .button-supprimer {
            display: inline-block;
            padding: 8px 16px;
            margin: 8px;
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

        .button-supprimer:hover {
            background-color: #d9534f;
            color: #fff;
        }

        .button-modifier {
            display: inline-block;
            padding: 8px 16px;
            margin: 8px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            border: 2px solid #f0ad4e;
            color: #f0ad4e;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .button-modifier:hover {
            background-color: #f0ad4e;
            color: #fff;
        }
    </style>
</head>
<body>

    <?php 
        $date=date('y-m-d');
        $res=$bdd->query("select * from article where date>='$date'");
    ?>

    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($article=$res->fetch()): ?>
                <tr>
                    <td><?=$article['titre']; ?></td>
                    <td><?=$article['description'];?></td>
                    <td><img src="photo/<?=$article['photo']?>" alt="" width="100px" height="100px"></td>
                    <td>
                        <a href="supprimer-article.php?id=<?=$article['id']?>" class="button-supprimer">Supprimer</a>
                        <a href="modifier-article.php?id=<?=$article['id']?>" class="button-modifier">Modifier</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>
