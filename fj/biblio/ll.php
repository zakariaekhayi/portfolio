


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Menu mon cv</title>
    <style>
        h1{
    background-color: gray;
    color: white;
    padding: 30px;
    height: 22px;
}
                table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd; /* Border at the bottom of each cell */
    }

    th {
        background-color: #f2f2f2; /* Background color for header cells */
    }


body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

.menu {
    background-color: blue;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

li {
    float: left;
   
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover {
    background-color: #111;
}

    </style>
</head>
<body>



<div class="menu">
    <ul>
    <li><a href="liste_e.php">Liste etudiant</a></li>
        <li><a href="ll.php">Liste livre</a></li>
        <li><a href="le.php">Liste des empreintes</a></li>
        <li><a href="emprunt.php">Ajouter une emprunt</a></li>
        <li><a href="etudiant.php">Ajouter etudiant</a></li>
        <li><a href="livre.php">Ajouter livre</a></li>
    </ul>
</div>


</body>
</html>
<?php
include('connexion.php');
$requete1 = "SELECT * FROM livre ";
$result = mysqli_query($link, $requete1);

if ($result) {
    // Check if there are rows in the result set
    if (mysqli_num_rows($result) > 0) {
        ?>
       <table border="1">
    <tr>
        <th>titre_livre</th>
        <th>auteur</th>
        <th>id</th>
        <th>Photo</th>
    </tr>
    <?php
    // Loop through each row in the result set
    while ($data = mysqli_fetch_assoc($result)) {
        // Remplacer les variables avec les nouvelles
        $photo = $data['image_livre'];
        $titre_livre = $data['titre_livre'];
        $auteur = $data['auteur'];
        $isbn = $data['isbn'];
        echo $photo;

        ?>
        <tr>
            <td><?php echo $titre_livre; ?></td>
            <td><?php echo $auteur; ?></td>
            <td><?php echo $isbn; ?></td>
            <td><img style="width: 200px;" src="photo/<?php echo $photo;?>" alt="Photo de profil"></td>

        </tr>
        <?php
    }
    ?>
</table>
<?php
} else {
    echo "Aucune formation trouvée pour cet utilisateur.";
}
} else {
    echo "Erreur dans la requête : " . mysqli_error($link);
}
?>
