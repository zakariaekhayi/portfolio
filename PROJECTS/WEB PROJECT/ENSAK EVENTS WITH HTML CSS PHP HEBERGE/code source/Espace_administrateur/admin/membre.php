<?php 
    session_start();
    $bdd=new PDO('mysql:host=localhost;dbname=gestion','root','');
    if(!$_SESSION['login']){
        header("Location: index.php");
    }

?>
<style>
    
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher les membres</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
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

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a {
            color: #fff;
            text-decoration: none;
            background-color: #e74c3c;
            padding: 8px 12px;
            border-radius: 5px;
            display: inline-block;
        }

        a:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <header>
        <h1>Afficher les membres</h1>
    </header>

    <?php
        $recp=$bdd->query('select * from sous_admin');
    ?>

    <table>
        <thead>
            <tr>
                <th>Nom du Membre</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($user=$recp->fetch()):  ?>
                <tr>
                    <td><?= $user['LOGIN']; ?></td>
                    <td><a href="baner.php?id=<?=$user['LOGIN']?>">Bannir</a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="ajouter_membre.php" style="margin-left: 40%;background-color: 06d6a0;">Ajouter Membre</a>
    <a href="espace_admin.php" style="margin-left: 20%;background-color: 06d6a0;">Espace Admin</a>
</body>
</html>
