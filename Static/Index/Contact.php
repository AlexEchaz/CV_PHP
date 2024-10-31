<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $destinataire = "alexandre.echazarreta@icloud.com";
    $sujet = "Nouveau message du site de CV";
    $contenu = "Nom: $nom\nEmail: $email\n\nMessage:\n$message";
    if (mail($destinataire, $sujet, $contenu)) {
        $successMessage = "Votre message a bien été envoyé !";
    } else {
        $errorMessage = "Une erreur est survenue. Veuillez réessayer plus tard.";
        $errorDetails = error_get_last();
        echo "<pre>";
        print_r($errorDetails);
        echo "</pre>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="styleContact.css">
</head>
<body>
    <header>
        <h1>Contactez-nous</h1>
    </header>
    
    <?php if (!empty($successMessage)) : ?>
        <p class="success"><?= $successMessage ?></p>
    <?php elseif (!empty($errorMessage)) : ?>
        <p class="error"><?= $errorMessage ?></p>
    <?php endif; ?>

    <form method="post" action="Contact.php">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Message :</label>
        <textarea id="message" name="message" required></textarea>

        <button type="submit">Envoyer</button>
    </form>
</body>
</html>
