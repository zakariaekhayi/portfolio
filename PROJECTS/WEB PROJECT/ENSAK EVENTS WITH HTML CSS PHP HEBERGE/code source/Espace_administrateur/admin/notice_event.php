<?php
// Fonction pour envoyer un e-mail
function envoyerEmail($destinataire, $sujet, $message) {
    // Entêtes de l'e-mail
    $entetes = "From: 5254mohamed@gmail.com\r\n";
    $entetes .= "Reply-To: 5254mohamed@gmail.com\r\n";
    $entetes .= "MIME-Version: 1.0\r\n";
    $entetes .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    // Envoyer l'e-mail
    mail($destinataire, $sujet, $message, $entetes);
}

// Récupérer la liste des événements depuis la base de données
// Supposons que $evenements est un tableau d'événements avec des champs comme date, titre, etc.
include("connexion.php");
$date = date('Y-m-d');
$sql = "SELECT * FROM article WHERE date = '$date'";
$res = mysqli_query($link, $sql);

$sql2 = "SELECT * FROM user";
$res2 = mysqli_query($link, $sql2);

// Boucle pour récupérer tous les utilisateurs
while ($destinataire = mysqli_fetch_assoc($res2)) {
    // Boucle pour récupérer tous les événements
    while ($evenement = mysqli_fetch_assoc($res)) {
        // Vérifier si la date de l'événement est aujourd'hui (ou une condition de proximité que vous définissez)
        if ($evenement['date'] == $date) {
            // Construire le message de l'e-mail
            $sujet = 'Rappel d\'événement : ' . $evenement['titre'];
            $message = 'Bonjour,<br><br>Rappel : Vous avez un événement aujourd\'hui.<br>';
            $message .= 'Détails de l\'événement :<br>';
            $message .= 'Date : ' . $evenement['date'] . '<br>';
            $message .= 'Titre : ' . $evenement['titre'] . '<br>';
            $message .= 'Description : ' . $evenement['description'] . '<br><br>';
            $message .= 'Cordialement,<br>Votre site web';

            // Envoyer l'e-mail à l'utilisateur actuel
            envoyerEmail($destinataire['LOGIN'], $sujet, $message);
        }
    }

    // Réinitialiser le pointeur de résultat pour les événements
    mysqli_data_seek($res, 0);
}

// Fermer la connexion à la base de données
mysqli_close($link);
?>
