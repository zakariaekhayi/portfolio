<?php 
include ("connexion.php");
session_start();
if(!$_SESSION['id_user']){
    header("Location: Login.php");
    exit;
}

$email = $_SESSION['id_user'];

if (isset($_POST['poster'])) {
    $commentaire = $_POST['comment'];

    $sql = "INSERT INTO commentaire (LOGIN, commentaire) VALUES ('$email','$commentaire')";
    $res = mysqli_query($link, $sql);

    if ($res === true) {
        // Définir une variable JavaScript pour indiquer si le message de succès doit être affiché
        echo '<script>
                var showSuccess = true;
              </script>';
    } else {
        echo 'Error: ' . mysqli_error($link);
    }
}

$sqlfetch = "SELECT * FROM commentaire";
$result = mysqli_query($link, $sqlfetch);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>commentaire</title>
    <style>
        body {
            background-color:  wheat;
        }

        table {
            background-color: orange;
            width: 1200px;
        
            position: relative;
            left: 100px;
        }
    </style>
</head>

<body>
    <img src="./images/event_logo.png" width="200px" class="hero-logo" />

    <?php
    // Afficher le message de succès si la variable JavaScript est définie à true
    if (isset($res) && $res === true) {
        echo 'g';
    }
    ?>

    <div id="successMessage" style="display: none;">Le commentaire a été téléchargé avec succès</div>

    <?php
    // Afficher le tableau HTML
    if ($result) {
        echo '<table border="1">
                <tr>
                    <th>user</th>
                    <th>Commentaire</th>
                </tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                    <td>' . $row['LOGIN'] . '</td>
                    <td>' . $row['commentaire'] . '</td>
                  </tr>';
        }

        echo '</table>';

        // Libération des résultats
        mysqli_free_result($result);
    } else {
        echo "Error: " . mysqli_error($link);
    }
    ?>
</body>
</html>
