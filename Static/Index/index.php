<?php
session_start();

require_once 'Database/DatabaseConnection.php';

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    $db = DatabaseConnection::getInstance()->getConnection();

    $stmt = $db->prepare("SELECT email, userName, id FROM User WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC); 
} else {
    $user = null; 
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV - Hub</title>
    <link rel="stylesheet" href="styleIndex.css">
</head>
<body>
    <header>
        <?php if ($user) : ?>
            <h2>Bienvenue, <?php echo htmlspecialchars($user['userName']); ?> !</h2>
        <?php else: ?>
        <h1>Accueil</h1>
        <?php endif; ?>
        <nav>
            <ul>
                <li><a href="LoginPage.php">Connexion</a></li>
                <li><a href="Contact.php">Contact</a></li>
                <li><a href="CV.php">Modifier mon CV</a></li>
                <li><a href="Projet.php">Projets</a></li>
                <li><a href="LogoutPage.php">Deconnexion</a></li>
            </ul>
        </nav>
    </header>

    <main>
        
    </main>

    <footer>
        <p>&copy; 2024 Alexandre ECHAZARRETA. Tous droits réservés.</p>
    </footer>
</body>
</html>
