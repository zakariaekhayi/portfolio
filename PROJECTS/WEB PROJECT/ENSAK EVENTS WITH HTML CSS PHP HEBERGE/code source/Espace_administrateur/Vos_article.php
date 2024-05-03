<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vos Articles</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            margin: auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        a {
            display: block;
            margin-top: 20px;
            text-align: center;
            font-size: 16px;
            color: #333;
            text-decoration: none;
            background-color: #d9534f;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>

<?php 
    session_start();
    include("connexion.php");
    $orga=$_SESSION['login'];
    $sql="select * from article_proposé where organisateur='$orga'";
    $trou=mysqli_query($link,$sql);
?>

<table>
    <tr>
        <th>Titre</th>
        <th>Description</th>
        <th>État</th>
        <th>Photo</th>
    </tr>

<?php
    while($article=mysqli_fetch_assoc($trou)){
?>
    <tr>
        <td><?=$article['titre']; ?></td>
        <td><?=$article['description'];?></td>
        <td><?=$article['etat']; ?></td>
        <td><img src="photo/<?=$article['photo']?>" alt=""></td>
    </tr>
<?php
    }
?>

</table>

<a href="panneaux_controle_sous.php">Panneaux de controle</a>

</body>
</html>
